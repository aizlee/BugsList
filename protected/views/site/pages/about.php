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


<a class="btn" data-toggle="modal" data-backdrop="true" data-keyboard="true" href="#myModal">Open Modal</a>
 
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>

