<?php
/* @var $this BugsController */
/* @var $model Bugs */


$this->menu=array(
        array('label'=>'Список всех заявок', 'url'=>array('index')),
        array('label'=>'Мои заявки', 'url'=>array('myBugs')),
);
?>

<h1>Ticket </h1>

<?php
 $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'summaryText'=>'', 
)); ?>
<?php
        $this->widget('comments.widgets.ECommentsListWidget', array(
            'model' => $model,
        ));
?>