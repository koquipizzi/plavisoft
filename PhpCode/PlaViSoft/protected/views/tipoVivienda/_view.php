<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Valor')); ?>:</b>
	<?php echo CHtml::encode($data->Valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MtrosCubiertos')); ?>:</b>
	<?php echo CHtml::encode($data->MtrosCubiertos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MtrosDescubiertos')); ?>:</b>
	<?php echo CHtml::encode($data->MtrosDescubiertos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CantHabitaciones')); ?>:</b>
	<?php echo CHtml::encode($data->CantHabitaciones); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CantPisos')); ?>:</b>
	<?php echo CHtml::encode($data->CantPisos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SobreCalle')); ?>:</b>
	<?php echo CHtml::encode($data->SobreCalle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fotos')); ?>:</b>
	<?php echo CHtml::encode($data->Fotos); ?>
	<br />

	*/ ?>

</div>