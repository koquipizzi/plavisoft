<?php
/* @var $this CuotaController */
/* @var $data Cuota */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suscripcion_id')); ?>:</b>
	<?php echo CHtml::encode($data->suscripcion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_cuota')); ?>:</b>
	<?php echo CHtml::encode($data->nro_cuota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valorLetras')); ?>:</b>
	<?php echo CHtml::encode($data->valorLetras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mes_id')); ?>:</b>
	<?php echo CHtml::encode($data->mes_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anio')); ?>:</b>
	<?php echo CHtml::encode($data->anio); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('saldada')); ?>:</b>
	<?php echo CHtml::encode($data->saldada); ?>
	<br />

	*/ ?>

</div>