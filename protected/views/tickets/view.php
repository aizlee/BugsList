<?php
/* @var $this BugsController */
/* @var $model Bugs */

$this->breadcrumbs=array(
        'Tickets'=>array('index'),
        $model->id,
);

$this->menu=array(
        array('label'=>'List Bugs', 'url'=>array('index')),
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
<?php
        $this->widget('comments.widgets.ECommentsListWidget', array(
            'model' => $model,
        ));
?>