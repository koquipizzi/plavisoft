<?php
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Manage',
);

?>

<h1>Listado de Cuotas</h1>

<?php echo $suscripcion->persona->Apellido; ?>

<?php $this->widget('application.extensions.tablesorter.SorterCuota', array(
	'id'=>'cuota-grid',
	'data'=>$records,
	'columns'=>array(
            'nro_cuota',
            'valor',
            'mes.mes',
            'anio',
            'saldada',
	),
)); ?>
