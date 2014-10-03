<?php
$this->breadcrumbs=array(
	'Personas',
);

$this->menu=array(
	array('label'=>'Nueva Persona','url'=>array('create')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>
<style type="text/css">
h1{
    color:red;
    text-align: center;
    width: 700px;
    
}
table{
    margin: auto;     
     border-spacing: 100px 50px;
}
table td,table th{
    border: 1px solid gray;
    border-collapse: collapse;
    
}

.fecha {
	margin: 60px;	


}
</style>

<table width=700>
<tr class="grey size">
    <th colspan=12><?=$key ?></th>
</tr>
<thead>
    <tr>
        <th width="320" height="150">KM Planned</th>
        <th width="50" height="150">Country</th>
        <th width="150" height="150" align="right"></th>
        <th width="150" height="150" align="right"><span class="fecha" >12/09/2014</span></th>
        <th width="30" height="150" align="right"></th>
    </tr>
</thead>
<tbody>
</tbody>
</table>


<table width=700>
<tr class="grey size">
    <th colspan=12><?=$key ?></th>
</tr>
<thead>
	<tr>
		<td width="480" height="40" rowspan="4"><?php echo strtoupper(CHtml::encode($persona->Apellido)).", ". strtoupper(CHtml::encode($persona->Nombre));	 ?></td>
	</tr>
	<tr>
		<td width="80" height="20">Susc</td>
	</tr>
	<tr>
		<td width="80" height="20">kkk</td>
	</tr>
	<tr>
		<td width="80" height="20">CUIT</td>
		<td width="140" height="20" align="center">2023232321</td>
	</tr>
</thead>
<tbody>
</tbody>
</table>


<table width=700>
<tr class="grey size">
    <th colspan=12><?=$key ?></th>
</tr>
<thead>
	<tr>
		<td width="80" height="20"></td>
		<td width="520" height="20"><?php echo strtoupper(CHtml::encode($persona->Apellido)).", ". strtoupper(CHtml::encode($persona->Nombre));	 ?></td>
		<td width="100" height="20"></td>
	</tr>
	<tr>
		<td width="80" height="20"></td>
		<td width="520" height="20"></td>
		<td width="100" height="20"></td>
	</tr>
</thead>
<tbody>
	<tr>
		<td width="80" height="20"></td>
		<td width="520" height="20"><?php echo $model->valorLetras; ?></td>
		<td width="100" height="20" align="left"><?php echo " ($ ".$model->valor. ") "; ?></td>
	</tr>
</tbody>
</table>



<div>





	<hr>
	<h3>
	Pago de Cuota <?php echo $model->nro_cuota; ?>
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
		echo $model->valorLetras. " ($ ".$model->valor. ") ";
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

