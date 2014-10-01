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
            array(
                'header'=>'Nro Cuota',
                'value'=>'nro_cuota',
            ),
            array(
                'header'=>'Valor',
                'value'=>'valorStr',
                'style'=>'text-align: right;',
            ),
            'mes.mes',
            'anio',
            'saldada',
	),
)); ?>
