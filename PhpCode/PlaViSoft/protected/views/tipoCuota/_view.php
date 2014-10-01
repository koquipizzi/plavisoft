<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->Importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ImporteLetras')); ?>:</b>
	<?php echo CHtml::encode($data->ImporteLetras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financiacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->financiacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Adjudicado')); ?>:</b>
	<?php echo CHtml::encode($data->Adjudicado); ?>
	<br />


</div>