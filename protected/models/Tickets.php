<?php

/**
 * This is the model class for table "bugs".
 *
 * The followings are the available columns in table 'bugs':
 * @property integer $id
 * @property integer $id_employee
 * @property integer $id_client
 * @property string $address
 * @property string $receive_date
 * @property string $post
 * @property string $start_date
 * @property string $complete_date
 * @property integer $status
 */
class Tickets extends CActiveRecord
{
	public function tableName()
	{
		return 'bugs';
	}

	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, receive_date, post', 'required'),
			array('id_employee, status', 'numerical', 'integerOnly'=>true),
			array('address', 'length', 'max'=>128),
			array('post', 'length', 'max'=>256),
			array('id_client', 'length', 'max'=>256),
			array('start_date, complete_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_employee, id_client, address, receive_date, post, start_date, complete_date, status', 'safe', 'on'=>'search'),
		);
	}


	public function search($currentAction)
	{
		$condition = '';
		$ord = '';
		if ($currentAction != 'archive'){
		 	$condition = 'status < 4';
		 	$ord = 'status asc ,receive_date asc';
		 	if($currentAction == 'myBugs'){
		 		if(Yii::app()->authManager->isAssigned('Employee',Yii::app()->user->id)){
					$condition .= ' and id_employee =' . Yii::app()->user->id;
					$ord = 'status desc ,receive_date asc'; 
				}	
			}
		}
		else{
			$condition = 'status = 4';
			$ord = 'receive_date desc';
		}


		$query = Yii::app()->db->createCommand()
		    ->select('*')
		    ->from('bugs')
		    ->where($condition)
		    ->order($ord)
		    ->text;

		$count=count(Yii::app()->db->createCommand($query)->queryAll());
		$dataProvider = new CSqlDataProvider($query, array(
			'totalItemCount'=>$count,
			'keyField'=>'id',
			'pagination'=>array(
				'pageSize'=>7,
			 ),
		));
			 return $dataProvider;
	}

	
	public static function model($className=__CLASS__)
	 {
	 	return parent::model($className);
	 }

	public function getStatus($status)
	{
	    $data = array(0=>"Ожидание", 1=>"В процессе", 2=>"Завершено", 3=>"Проверка", 4=>"Архив");
	    return $data[$status];
	}

	public static function getFullFio($id){
		if (!is_null($id)){
			$query = Yii::app()->db->createCommand()
		    ->select('first_name, last_name')
		    ->from('clients')
			->where('id = ' . $id)
		    ->queryRow();
		    $output = $query['last_name'] . ' ' . $query['first_name'];
			return $output;
	    }
	    return 'Исполнитель не назначен';
	}

	public static function getUserFullFio($id){
		if (!is_null($id)){
			$query = Yii::app()->db->createCommand()
		    ->select('first_name, last_name')
		    ->from('tbl_profiles')
			->where('user_id = ' . $id)
		    ->queryRow();
		    $output = $query['last_name'] . ' ' . $query['first_name'];
			return $output;
	    }
	    return 'Исполнитель не назначен';
	}

	public function getEmail($id)
	{
	   $query = Yii::app()->db->createCommand()
		    ->select('email')
		    ->from('clients')
			->where('id = ' . $id)
		    ->queryRow();
			return $query['email'];
	}

	public function getCreatorEmail($id)
	{
	   $query = Yii::app()->db->createCommand()
		    ->select('email')
		    ->from('tbl_users')
			->where('id = ' . $id)
		    ->queryRow();
			return $query['email'];
	}

	public function getClient()
	{
	   $query = Yii::app()->db->createCommand()
		    ->select('email')
		    ->from('clients')
		    ->queryColumn();
			return $query;
	}
}
