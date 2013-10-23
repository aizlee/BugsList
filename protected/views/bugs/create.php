<?php
/* @var $this BugsController */
/* @var $model Bugs */

$this->breadcrumbs=array(
	'Bugs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bugs', 'url'=>array('index')),
	array('label'=>'Manage Bugs', 'url'=>array('admin')),
);
?>

<h1>Create Bugs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>