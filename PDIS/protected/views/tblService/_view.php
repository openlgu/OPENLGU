<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('service')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->service), array('view', 'id'=>$data->service)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('availability')); ?>:</b>
	<?php echo CHtml::encode($data->availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customers')); ?>:</b>
	<?php echo CHtml::encode($data->customers); ?>
	<br />


</div>