<?php
/* @var $this PagoController */
/* @var $data Pago */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaPago')); ?>:</b>
	<?php echo CHtml::encode($data->FechaPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ImporteLetras')); ?>:</b>
	<?php echo CHtml::encode($data->ImporteLetras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NroDeposito')); ?>:</b>
	<?php echo CHtml::encode($data->NroDeposito); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona_id')); ?>:</b>
	<?php echo CHtml::encode($data->persona_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('talonario')); ?>:</b>
	<?php echo CHtml::encode($data->talonario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_formulario')); ?>:</b>
	<?php echo CHtml::encode($data->nro_formulario); ?>
	<br />

	*/ ?>

</div>