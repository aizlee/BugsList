<?php
/* @var $this BugsController */
/* @var $data Bugs */
?>

<div class="view">
<div class="wrapper">
	<div class="info">
		<div class="item">
			<label>Номер бага:</label>	
			<p><?php echo CHtml::link(CHtml::encode($data['id']), array('view', 'id'=>$data['id'])); ?></p>
		</div>

		<div class="item">
			<label>Клиент:</label>
			<p><?php echo CHtml::encode(Bugs::getFullFio($data['id_client']));?></p>
		</div>

		<div class="item">
			<label>Сотрудник:</label>
			<p><?php echo CHtml::encode(Bugs::getFullFio($data['id_employee']));?></p>
		</div>
	</div>

	<div class = date-block>
		<div class="item">
			<label>Дата поступления:</label>
			<p><?php echo CHtml::encode($data['receive_date']); ?></p>
		</div>

		<div class="item">
			<label>Дата принятия:</label>
			<p><?php echo CHtml::encode($data['start_date']); ?></p>
		</div>
		
		<div class="item">
			<label>Дата завершения:</label>
			<p><?php echo CHtml::encode($data['complete_date']); ?></p>
		</div>
	</div>
</div>
	<div class="item status">
		<label>Статус:</label>
		<p><?php echo CHtml::encode(Bugs::getStatus($data['status'])); ?></p>
	</div>
	
	<div class="item post">
		<label>Описание:</label>
		<p><?php echo CHtml::encode($data['post']); ?></p>
	</div>

	<div class="buttons">
	<?php
	switch ($data['status']) {
		case '0':
			$this->widget('bootstrap.widgets.TbButton', array(
			    //'buttonType'=>'button',
				//'label'=>'Взять баг',
			    //'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			    //'size'=>'small', // null, 'large', 'small' or 'mini'
			    //'name'=>'btnGetBug',
			    //'caption'=>'Взять баг',
			    'url'=>array('bugs/getBug', 'id'=>$data['id']),
			    'htmlOptions'=>array('submit'=>array('getBug','id'=>$data['id']),'confirm'=>'Подтвердить?',
			    		'title'=>'Взять баг', 'id'=> 'getButton'),
			));
			break;		
		case '1':
			if (Yii::app()->controller->getAction()->getId()=='myBugs'){
				$this->widget('bootstrap.widgets.TbButton', array(
				    'url'=>array('bugs/completeBug', 'id'=>$data['id']),
				    'htmlOptions'=>array('submit'=>array('completeBug','id'=>$data['id']),'confirm'=>'Подтвердить?',
				    	'title'=>'Завершить работу с багом', 'id'=> 'completeButton'),
				));
			}
				break;
		case '2':
			if (Yii::app()->controller->getAction()->getId()=='myBugs'){
				$this->widget('bootstrap.widgets.TbButton', array(
				    'url'=>array('bugs/sendMail', 'id'=>$data['id']),
				    'htmlOptions'=>array('submit'=>array('sendMail','id'=>$data['id']),'confirm'=>'Подтвердить?',
				    	'title'=>'Отправить E-mail', 'id'=> 'sendButton'),
				));
			}
			break;
	}
	 ?>
	 </div>
</div>