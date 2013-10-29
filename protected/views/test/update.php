<?php
    /* @var $this TestController */
    /* @var $model Test */
?>

<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

    $this->menu=array(
    array('icon' => 'glyphicon glyphicon-home','label'=>'Manage Test', 'url'=>array('admin')),
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Test', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-minus-sign',label'=>'Delete Test', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    );
    ?>

    <h1>Update Test <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>