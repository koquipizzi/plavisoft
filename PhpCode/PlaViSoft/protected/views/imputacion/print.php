<?php
$this->breadcrumbs=array(
	'Personas',
);

$this->menu=array(
	array('label'=>'Nueva Persona','url'=>array('create')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>
<?php var_dump($model->imputacions); die();?>
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
        <th width="320" height="150"> </th>
        <th width="50" height="150"></th>
        <th width="150" height="150" align="right"></th>
        <th width="150" height="150" align="right"><span class="fecha" ><?php echo $model->imputacions->pago->FechaPago; ?></span></th>
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
		<td width="80" height="20"><?php echo $model->suscripcion->id; ?></td>
	</tr>
	<tr>
		<td width="80" height="20">CUIT</td>
		<td width="140" height="20" align="center"><?php echo $persona->DNI; ?></td>
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



