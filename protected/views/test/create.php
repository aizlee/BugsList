<?php
    /* @var $this TestController */
    /* @var $model Test */
?>

<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	'Create',
);

    $this->menu=array(
        array('icon' => 'glyphicon glyphicon-home','label'=>'Manage Test', 'url'=>array('admin')),
    );
    ?>

    <h1>Create Test</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>