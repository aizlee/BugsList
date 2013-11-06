<?php
/* @var $this BugsController */
/* @var $dataProvider CActiveDataProvider */


if (Yii::app()->controller->getAction()->getId()=='index'){ 
	$this->menu=array(
		array('label'=>'Оформить заявк', 'url'=>array('create', 'addClient')),
		array('label'=>'Мои заявки', 'url'=>array('myBugs')),
		array('label'=>'Архив', 'url'=>array('archive')),
	);
}

if (Yii::app()->controller->getAction()->getId()=='myBugs'){
	$this->menu=array(
		array('label'=>'Оформить заявку', 'url'=>array('create', 'addClient')),
		array('label'=>'Список всех заявок', 'url'=>array('index')),
	);
}

if (Yii::app()->controller->getAction()->getId()=='archive'){
	$this->menu=array(
		array('label'=>'Список активных заявок', 'url'=>array('index')),
		array('label'=>'Мои заявки', 'url'=>array('myBugs')),
	);
}
?>

<?php switch(Yii::app()->controller->getAction()->getId()): 
 case 'index': ?>
	<h1>Bugs</h1>
	<?php break;?>

	<?php case 'myBugs': ?>
	<h1>My Bugs</h1>
	<?php break;?>

	<?php case 'archive': ?>
	<h1>Архив</h1>
	<?php break;?>

	<?php endswitch; ?>

<?php
	//var_dump($dataProvider);
	$this->widget('bootstrap.widgets.TbListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		 'ajaxUpdate'=>false,
		 'emptyText'=>'<i> Здесь рыбы нет!!!</i>',
	    'template'=>'{pager}{summary}{items}{pager}',
		'pager'=>array(
	        'maxButtonCount'=>'7',
	    ),
	
));?>
