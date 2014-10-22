<?php
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Manage',
);

?>

<h1>Listado de Cuotas

<span style="float:right;">
	<a href="/plavisoft/index.php?r=suscripcion/view&amp;id=<?php echo $_GET["suscripcion_id"]?>" title="Ver Estado" class="btn btn-small"><i class="icon-info-sign"></i></a>
</span>
</h1>

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
            array(
                'header'=>'Estado',
                'value'=>'estadoStr',
            ),
	),
)); ?>
