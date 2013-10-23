<?php
/* @var $this TestController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tests',
);

$this->menu=array(
array('label'=>'Create Test','url'=>array('create')),
array('label'=>'Manage Test','url'=>array('admin')),
);
?>

<h1>Tests</h1>

<?php $this->widget('bootstrap.widgets.BsListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>