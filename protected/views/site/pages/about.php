<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
<?php echo CHtml::link('Отправить заявку на разработку интернет сайта', '#', array(
'onclick'=>'$("#mydialog").dialog("open"); return false;',
'class'=>'g-button g-button-orange',
'title'=>'Отправить заявку на разработку интернет сайта',
));?>

