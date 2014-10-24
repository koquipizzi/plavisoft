<?php
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Manage',
);




?>

<h1>Listado de Cuotas

<span style="float:right;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'info',
                'label'=>'Crear Pago',
                'url'=>Yii::app()->createAbsoluteUrl('pago/create',array('suscripcion_id'=>$suscripcion->id)),
        )); ?>        
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
            array(
                'header'=>'Cancelado',
                'value'=>'canceladoStr',
                'style'=>'text-align: right;',
            ),
            array(
                'header'=>'Saldo',
                'value'=>'saldoStr',
                'style'=>'text-align: right; font-weight: bold;',
            ),
            array(
                'header'=>'Periodo',
                'value'=>'cuotaStr',
            ),
            array(
                'header'=>'Estado',
                'value'=>'estadoStr',
            ),
	),
        'filters'=>array(
            '',
            '',
            '', 
            '',
            '',            
            'filter-select', 
        ),
        
)); ?>
