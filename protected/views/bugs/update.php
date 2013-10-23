<?php
/* @var $this BugsController */
/* @var $model Bugs */

$this->breadcrumbs=array(
	'Bugs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bugs', 'url'=>array('index')),
	array('label'=>'Create Bugs', 'url'=>array('create')),
	array('label'=>'View Bugs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bugs', 'url'=>array('admin')),
);
?>

<h1>Update Bugs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>