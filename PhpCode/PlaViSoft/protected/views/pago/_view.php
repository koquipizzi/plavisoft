<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaPago')); ?>:</b>
	<?php echo CHtml::encode($data->FechaPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FormaPago')); ?>:</b>
	<?php echo CHtml::encode($data->FormaPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suscripcion_id')); ?>:</b>
	<?php echo CHtml::encode($data->suscripcion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financiacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->financiacion_id); ?>
	<br />


	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('NroDeposito')); ?>:</b>
	<?php echo CHtml::encode($data->NroDeposito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pago_id')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pago_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Importe')); ?>:</b>
	<?php echo CHtml::encode($data->Importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Anio')); ?>:</b>
	<?php echo CHtml::encode($data->Anio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Mes')); ?>:</b>
	<?php echo CHtml::encode($data->Mes); ?>
	<br />

	*/ ?>

</div>