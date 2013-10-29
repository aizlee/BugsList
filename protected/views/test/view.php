<?php
/* @var $this TestController */
/* @var $model Test */
?>

<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->id,
);

$this->menu=array(
array('icon' => 'glyphicon glyphicon-home','label'=>'Manage Test', 'url'=>array('admin')),
array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Test', 'url'=>array('create')),
array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Test', 'url'=>array('update', 'id'=>$model->id)),
array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Test', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Test #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
'htmlOptions' => array(
'class' => 'table table-striped table-condensed table-hover',
),
'data'=>$model,
'attributes'=>array(
		'id',
		'test',
),
)); ?>