<?php
/* @var $this ImputacionController */
/* @var $data Imputacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pago_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pago_id), array('view', 'id'=>$data->pago_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuota_id')); ?>:</b>
	<?php echo CHtml::encode($data->cuota_id); ?>
	<br />


</div>