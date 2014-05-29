<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_id')); ?>:</b>
	<?php echo CHtml::encode($data->persona_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago_id')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pago_id')); ?>:</b>
	<?php echo CHtml::encode($data->pago_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adelanto_id')); ?>:</b>
	<?php echo CHtml::encode($data->adelanto_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('importe_imponible')); ?>:</b>
	<?php echo CHtml::encode($data->importe_imponible); ?>
	<br />

	*/ ?>

</div>