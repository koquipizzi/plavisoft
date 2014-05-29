<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financiacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->financiacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_cuota')); ?>:</b>
	<?php echo CHtml::encode($data->nro_cuota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mes')); ?>:</b>
	<?php echo CHtml::encode($data->mes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anio')); ?>:</b>
	<?php echo CHtml::encode($data->anio); ?>
	<br />


</div>