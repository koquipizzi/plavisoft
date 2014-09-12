<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Apellido')); ?>:</b>
	<?php echo CHtml::encode($data->Apellido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nombre')); ?>:</b>
	<?php echo CHtml::encode($data->Nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Domicilio')); ?>:</b>
	<?php echo CHtml::encode($data->Domicilio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DNI')); ?>:</b>
	<?php echo CHtml::encode($data->DNI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Mail')); ?>:</b>
	<?php echo CHtml::encode($data->Mail); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefono')); ?>:</b>
	<?php echo CHtml::encode($data->Telefono); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('TelefonoCelular')); ?>:</b>
	<?php echo CHtml::encode($data->TelefonoCelular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IngresosMensuales')); ?>:</b>
	<?php echo CHtml::encode($data->IngresosMensuales); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CantHijos')); ?>:</b>
	<?php echo CHtml::encode($data->CantHijos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FechaAlta')); ?>:</b>
	<?php echo CHtml::encode($data->FechaAlta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Borrado')); ?>:</b>
	<?php echo CHtml::encode($data->Borrado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Socio')); ?>:</b>
	<?php echo CHtml::encode($data->Socio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nota')); ?>:</b>
	<?php echo CHtml::encode($data->Nota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdSocio')); ?>:</b>
	<?php echo CHtml::encode($data->IdSocio); ?>
	<br />

	*/ ?>

</div>