<?php
/* @var $this BugsController */
/* @var $data Bugs */
?>

<div class="view">
<div class="wrapper">
	<div class="info">
		<div class="item">
			<label>№:</label>	
			<p><?php echo CHtml::encode(CHtml::encode($data['id'])); ?></p>
		</div>

		<div class="item imageStatus">
		<?php switch($data['status']): // Switch image for status
		 case '0': ?>
			<i class="fa fa-bug fa-2x"></i>
			<?php break;?>

			<?php case '1': ?>
			<i class="fa fa-cog fa-2x fa-spin"></i>
			<?php break;?>

			<?php case '2': ?>
			<i class="fa fa-envelope fa-2x"></i>
			<?php break;?>

			<?php case '3': ?>
			<i class="fa fa-exclamation-circle fa-2x"></i>
			<?php break;?>

			<?php case '4': ?>
			<i class="fa fa-archive fa-2x"></i>
			<?php endswitch; ?>
	</div>		
		
	</div>

	<div class = date-block>
		<div class="item">
			<i class="fa fa-sign-in"></i> 
			<p><?php echo CHtml::encode($data['receive_date']); ?></p>
		</div>

		<div class="item">
			<i class="fa fa-thumb-tack"></i>
			<p><?php echo CHtml::encode($data['start_date']); ?></p>
		</div>
		
		<div class="item">
			<i class="fa fa-flag"></i>
			<p><?php echo CHtml::encode($data['complete_date']); ?></p>
		</div>
	</div>
</div>
	

	<div class="item post">
		<label>Описание:</label>
		<?php echo $data['post']; ?>
	</div>

	<div class="wrapper man">
		<div class="item">
			<i class="fa fa-male"></i>
			<p><?php echo CHtml::encode(Bugs::getFullFio($data['id_client']));?></p>
		</div>

		<div class="item">
			<i class="fa fa-user"></i>
			<p><?php echo CHtml::encode(Bugs::getFullFio($data['id_employee']));?></p>
		</div>
	</div>

	<div class="action">
		<div class="item status">
			<label>Статус:</label>
			<p><?php echo CHtml::encode(Bugs::getStatus($data['status'])); ?></p>
		</div>

		<div class="buttons">
		<?php
		switch ($data['status']) {
			case '0':
				$this->widget('bootstrap.widgets.TbButton', array(
				    //'buttonType'=>'button',
					'label'=>'Взять баг',
				    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				    'size'=>'small', // null, 'large', 'small' or 'mini'
				    //'name'=>'btnGetBug',
				    //'caption'=>'Взять баг',
				     'icon'=>'wrench white',
				    'url'=>array('bugs/getBug', 'id'=>$data['id']),
				    'htmlOptions'=>array('confirm'=>'Подтвердить?',
				    		'title'=>'Взять баг', 'id'=> 'getButton'),
				));
				break;		
			case '1':
				if (Yii::app()->controller->getAction()->getId()=='myBugs'){
					$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Завершить работу с багом',
					    'type'=>'primary', 
					    'size'=>'small', 
					     'icon'=>'check white',
					    'url'=>array('bugs/completeBug', 'id'=>$data['id']),
					    'htmlOptions'=>array('confirm'=>'Подтвердить?',
					    	'title'=>'Завершить работу с багом', 'id'=> 'completeButton'),
					));
				}
					break;
			case '2':
				if (Yii::app()->controller->getAction()->getId()=='myBugs'){
					$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Отправить E-mail',
					    'type'=>'primary', 
					    'size'=>'small', 
					     'icon'=>'share-alt white',
					    'url'=>array('bugs/sendMail', 'id'=>$data['id']),
					    'htmlOptions'=>array('confirm'=>'Подтвердить?',
					    	'title'=>'Отправить E-mail', 'id'=> 'sendButton'),
					));
				}
				break;

			case '3':
				if (Yii::app()->controller->getAction()->getId()=='myBugs'){
					$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Исправлено',
				   		 'size'=>'small', 
				   		 'type'=>'primary', 
				   		  'icon'=>'ok white',
					     'url'=>array('bugs/addToArchive', 'id'=>$data['id']),
					     'htmlOptions'=>array('confirm'=>'Подтвердить?',
					     	'title'=>'Отправить в архив', 'id'=> 'archiveButton'),
					));

					$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Вернуть',
				    	'type'=>'danger', 
				   		 'size'=>'small', 
				   		 'icon'=>'remove white',
					     'url'=>array('bugs/returnToWork', 'id'=>$data['id']),
					     'htmlOptions'=>array('confirm'=>'Подтвердить?',
					    	'title'=>'Вернуть на доработку', 'id'=> 'returnButton'),
					));
				}
				break;
		}
		 ?>
		 </div>
		</div>
</div>