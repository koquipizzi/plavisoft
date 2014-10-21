<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nro_cheque')); ?>:</b>
	<?php echo CHtml::encode($data->Nro_cheque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cta_cte')); ?>:</b>
	<?php echo CHtml::encode($data->Cta_cte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pago_id')); ?>:</b>
	<?php echo CHtml::encode($data->pago_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NombreTitular')); ?>:</b>
	<?php echo CHtml::encode($data->NombreTitular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banco_id')); ?>:</b>
	<?php echo CHtml::encode($data->banco_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaVencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->FechaVencimiento); ?>
	<br />

	*/ ?>

</div>