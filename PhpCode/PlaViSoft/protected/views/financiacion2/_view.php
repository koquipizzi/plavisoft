<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_vivienda_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_vivienda_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo_Financiacion')); ?>:</b>
	<?php echo CHtml::encode($data->Tipo_Financiacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Importe')); ?>:</b>
	<?php echo CHtml::encode($data->Importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cant_coutas')); ?>:</b>
	<?php echo CHtml::encode($data->cant_coutas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posicion')); ?>:</b>
	<?php echo CHtml::encode($data->posicion); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('estado_adjudicacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->estado_adjudicacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_cuota_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_cuota_id); ?>
	<br />

	*/ ?>

</div>