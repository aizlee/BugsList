<?php

class BugsController extends RController
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			 'rights',
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','myBugs','completeBug','getBug','archive','sendMail','admin',
					 'addToArchive', 'returnToWork', 'imageUpload', 'imageList', 'fileUpload', 'addClient'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Bugs;
		$add=new Clients;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->receive_date=date('Y-m-d');
		if(isset($_POST['Bugs']))
		{
			$model->attributes=$_POST['Bugs'];
			if (!empty($model->id_client)){
				$temp=Clients::model()->findByAttributes(array('email'=>$model->id_client));
				$model->id_client=$temp->id;
			}
			$model->id_creator = Yii::app()->user->id;

			if($model->save())
				$this->redirect(array('index'));	
		}
		
		
		$this->render('create',array(
			'model'=>$model
		));
	}

	public function actionAddClient()
	{
		if(isset($_POST['Clients']))
		{
			$add->attributes=$_POST['Clients'];

			if($add->save())
				$this->redirect(array('create'));	
		}

		$this->render('addClient',array(
			'add'=>$add,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bugs']))
		{
			$model->attributes=$_POST['Bugs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionGetBug($id)
	{
		$model=$this->loadModel($id);
		$model->id_employee = Yii::app()->user->id;
		$model->start_date = date("Y-m-d");
		$model->status = 1;
		if ($model->save()) 
			 $this->redirect(array('index'));		
	}

	public function actionCompleteBug($id)
	{
		$model=$this->loadModel($id);
		$model->complete_date = date("Y-m-d");
		$model->status = 2;
		if ($model->save()) 
		 	 $this->redirect(array('myBugs'));
	}

	
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	
	public function actionIndex()
	{
		$model=new Bugs('search');
	
		if(isset($_GET['Bugs']))
			$model->attributes=$_GET['Bugs'];

		$this->render('index',array(
			'dataProvider'=>$model->search('index'),
		));

	}


	public function actionMyBugs()
	{
		$model=new Bugs('search');
	
		if(isset($_GET['Bugs']))
			$model->attributes=$_GET['Bugs'];
			
		$this->render('index',array(
			'dataProvider'=>$model->search('myBugs'),
		));
	}


	public function actionArchive()
	{
		$model=new Bugs('search');

		if(isset($_GET['Bugs']))
			$model->attributes=$_GET['Bugs'];
			
		$this->render('index',array(
			'dataProvider'=>$model->search('archive'),
		));
	}

	public function actionSendMail() { 
		$temp = $_GET['id'];
		$model=$this->loadModel($temp);
		if (!empty($model->id_client)){
			$message='Уважаемый(ая) ' . Bugs::getFullFio($model->id_client) . ', ваша заявка от ' . $model->receive_date  . ' - закрыта. Ошибки устранены.';
		    mail(Bugs::getEmail($model->id_client),'Ошибка исправлена', $message);
		}
		else{
			$message= Bugs::getUserFullFio($model->id_creator) . ', баг от ' . $model->receive_date  . ' - закрыт. Ошибки устранены.';
		    mail(Bugs::getCreatorEmail($model->id_creator),'Ошибка исправлена', $message);
		}
	    $model->status = 3;
	    if ($model->save()) 
			 $this->redirect(array('myBugs'));
	}   

	public function actionAddToArchive($id) { 
		$model=$this->loadModel($id);
	    $model->status = 4;
	    if ($model->save()) 
			 $this->redirect(array('myBugs'));
	}   

	public function actionReturnToWork($id) { 
	
		$model=$this->loadModel($id);
	    $model->status = 1;
	    $model->complete_date = new CDbExpression('NULL');
	    if ($model->save()) 
			 $this->redirect(array('myBugs'));
	}   

	public function loadModel($id)
	{
		$model=Bugs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bugs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

 	public function actions()
    {
        return array(
            'fileUpload'=>array(
                'class'=>'ext.imperaviRedactorWidget.actions.FileUpload',
                'uploadCreate'=>true,
            ),
            'imageUpload'=>array(
                'class'=>'ext.imperaviRedactorWidget.actions.ImageUpload',
                'uploadCreate'=>true,
                 'permissions'=>0777,
            ),
            'imageList'=>array(
                'class'=>'ext.imperaviRedactorWidget.actions.ImageList',
            ),
        );
    }

}
