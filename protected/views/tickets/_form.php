<?php
/* @var $this BugsController */
/* @var $model Bugs */
/* @var $form CActiveForm */
Yii::import('ext.imperaviRedactorWidget.ImperaviRedactorWidget');
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tickets-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
         'enctype'=>'multipart/form-data',
     ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'id_client'); ?>
		<?php $form->widget('bootstrap.widgets.TbTypeahead', array(
		    'name'=>'typeahead',
		    'model'=>$model,
    		'attribute'=>'id_client',
		    'options'=>array(
		        'source'=>Tickets::getClient(),
		        'items'=>4,
		        'matcher'=>"js:function(item) {
		            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
		        }",
		    ),
		)); ?>
		<?php echo $form->error($model,'id_client'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post'); ?>
		
	</div>


<?php 
	$attribute='post';
	$this->widget('ImperaviRedactorWidget', array(
    'model'=>$model,
    'attribute'=>$attribute,
    'plugins' => array(
        'imperavi' => array(
            'js' => array('extimgupl.js','extfupl.js'),
            'css' => array('redactor_plugins.css'),
        )),
    'options' => array(
    	'lang'=>'ru', 
                'thumbLinkClass'=>'athumbnail', //Класс по-умолчанию для ссылки на полное изображение вокруг thumbnail
                'thumbClass'=>'thumbnail pull-left', //Класс по-умолчанию для  thumbnail
                'defaultUplthumb'=>true, //Вставлять по-умолчанию после загрузки превью? если нет - полное изображение    
      	'fileUpload'=>Yii::app()->createUrl('tickets/fileUpload',array(
            'attr'=>$attribute
        )),
        'fileUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { alert(json.error); }'
        ),
        'imageUpload'=>Yii::app()->createUrl('tickets/imageUpload',array(
            'attr'=>$attribute
        )),
        'imageGetJson'=>Yii::app()->createUrl('tickets/imageList',array(
            'attr'=>$attribute
        )),
        'imageUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { alert(json.error); }'
        ),
                
      ),
));?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


