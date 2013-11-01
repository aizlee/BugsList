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
		<?php
		$currentDate =  new DateTime(date("Y-m-d")); 
		switch($data['status']): // Switch image for status
		 case '0': ?>
		 	<?php 
				$receive_date = new DateTime($data['receive_date']);
				$res = $receive_date->diff($currentDate);
				$color = '';
				if($res->format('%a')>=1)
					$color='yellow';
				if($res->format('%a')>=3)
					$color='red';
				$class = 'fa fa-bug fa-2x '.$color;?>
			<i class= "<?php echo $class ?>"></i>
			<?php break;?>

			<?php case '1': ?>
			<?php 
				$receive_date = new DateTime($data['start_date']);
				$res = $receive_date->diff($currentDate);
				$color = '';
				if($res->format('%a')>=1)
					$color='yellow';
				if($res->format('%a')>=3)
					$color='red';
				$class = 'fa fa-cog fa-2x fa-spin '.$color;?>
			<i class="<?php echo $class ?>"></i>
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
			<i class="fa fa-sign-in" title="Дата поступления"></i> 
			<p><?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd-MM-yyyy", $data['receive_date'])); ?></p>
		</div>

		<div class="item">
			<i class="fa fa-thumb-tack" title="Дата принятия"></i>
			<p><?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd-MM-yyyy", $data['start_date'])); ?></p>
		</div>
		
		<div class="item">
			<i class="fa fa-flag" title="Дата завершения"></i>
			<p><?php echo CHtml::encode(Yii::app()->dateFormatter->format("dd-MM-yyyy", $data['complete_date'])); ?></p>
		</div>
	</div>
</div>

	<div class="item">
		<label>Адрес:</label>
		<p> <?php echo $data['address']; ?> </p>
	</div>
	
	<div class="item post">
		<label>Описание:</label>
		<div class="post-details"> <?php echo $data['post']; ?> </div>
	</div>

	<div class="wrapper man">
		<?php if(!empty($data['id_creator'])):?>
		<div class="item">
			<i class="fa fa-tasks" title="Отправитель"></i>
			<p><?php echo CHtml::encode(Tickets::getUserFullFio($data['id_creator']));?></p>
		</div>
		<?php endif ?> 
		<?php if (!empty($data['id_client'])):?>
			<div class="item">
				<i class="fa fa-male" title="Клиент"></i>
				<p><?php echo CHtml::encode(Tickets::getFullFio($data['id_client']));?></p>
			</div>
		<?php endif ?>
		<div class="item">
			<i class="fa fa-user" title="Сотрудник"></i>
			<p><?php echo CHtml::encode(Tickets::getUserFullFio($data['id_employee']));?></p>
		</div>
	</div>

	<div class="action">
		<div class="item status">
			<label>Статус:</label>
			<p><?php echo CHtml::encode(Tickets::getStatus($data['status'])); ?></p>
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
				    'url'=>array('tickets/getBug', 'id'=>$data['id']),
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
					    'url'=>array('tickets/completeBug', 'id'=>$data['id']),
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
					    'url'=>array('tickets/sendMail', 'id'=>$data['id']),
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
					     'url'=>array('tickets/addToArchive', 'id'=>$data['id']),
					     'htmlOptions'=>array('confirm'=>'Подтвердить?',
					     	'title'=>'Отправить в архив', 'id'=> 'archiveButton'),
					));

					$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Вернуть',
				    	'type'=>'danger', 
				   		 'size'=>'small', 
				   		 'icon'=>'remove white',
					     'url'=>array('tickets/returnToWork', 'id'=>$data['id']),
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