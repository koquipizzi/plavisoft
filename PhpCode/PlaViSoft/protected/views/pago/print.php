<?php
$this->breadcrumbs=array(
	'Personas',
);

$this->menu=array(
	array('label'=>'Nueva Persona','url'=>array('create')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>
<div style="margin-left: 50px;">
	<h2>Barrio ADAMUCHOCA</h2>
	<hr>
	<h3>
	Pago de Cuota <?php echo $model->NroCuota; ?>
	<br>
	Adherente <?php echo CHtml::encode($persona->Apellido).", ". CHtml::encode($persona->Nombre); ?></h3>
</div>

<div class="view" style="margin: 50px; font-size:18px; text-align:justify; line-height: 130%;">

	<?php 
		echo "Recibí de "; 
		echo strtoupper(CHtml::encode($persona->Apellido)).", ". strtoupper(CHtml::encode($persona->Nombre));	
		echo " quien acredita su identidad con el DNI N°".CHtml::encode($persona->DNI);
		echo " domiciliado en la calle ".strtoupper(CHtml::encode($persona->Domicilio));
		echo ", Tandil, provincia de Buenos Aires quien comparece en calidad de “Parte Oferente” y/o “futuro Comprador” la suma de ";
		echo $model->ImporteLetras. " ($ ".$model->Importe. ") ";
		echo " para aplicar a la compra de una parte indivisa del lote de terreno que se deslinda a continuación y que se relaciona en un todo con la construcción en P.H.  a realizar por la Asociación de Ayuda Mutua de Choferes de Camiones de Tandil en dicho lote, el que se efectuará por el sistema de autofinanciación al costo, por cuenta y cargo de los compradores del lote.-------------------------------";
		echo "<br>Leído y en prueba de conformidad, se firman dos (02) ejemplares de un mismo tenor y a un solo efecto en la ciudad de Tandil, partido del mismo nombre, Provincia de Bs As., a los ";
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 		echo  date("d")." días del mes de ".$meses[date('n')-1]." de ". date("Y").".---";   
	?>


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

