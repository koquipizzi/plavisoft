<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaAlta')); ?>:</b>
	<?php echo CHtml::encode($data->FechaAlta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Activo')); ?>:</b>
	<?php echo CHtml::encode($data->Activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_id')); ?>:</b>
	<?php echo CHtml::encode($data->persona_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Borrado')); ?>:</b>
	<?php echo CHtml::encode($data->Borrado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financiacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->financiacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nota')); ?>:</b>
	<?php echo CHtml::encode($data->Nota); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Adjudicado')); ?>:</b>
	<?php echo CHtml::encode($data->Adjudicado); ?>
	<br />

	*/ ?>

</div>