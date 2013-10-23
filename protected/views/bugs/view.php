<?php
/* @var $this BugsController */
/* @var $model Bugs */

$this->breadcrumbs=array(
	'Bugs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bugs', 'url'=>array('index')),
	array('label'=>'Create Bugs', 'url'=>array('create')),
	array('label'=>'Update Bugs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bugs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Мои баги', 'url'=>array('myBugs')),
);
?>

<h1>View Bugs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_employee',
		'id_client',
		'receive_date',
		'post',
		'start_date',
		'complete_date',
		'status',
	),
)); ?>

<?php  if($model->id_employee==NULL){
		$this->widget('zii.widgets.jui.CJuiButton', array(
			'buttonType'=>'button',
			'name'=>'btnGo',
			'caption'=>'Оформить',
			'url'=>array('getBug','id'=>$model->id), 
			'htmlOptions'=>array('submit'=>array('getBug','id'=>$model->id),'confirm'=>'Подтвердить?'),
		));
	}
	?>