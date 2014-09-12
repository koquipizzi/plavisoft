<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List Pago','url'=>array('index')),
	array('label'=>'Nuevo Pago','url'=>array('create')),
//	array('label'=>'Update Pago','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete Pago','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Pagos','url'=>array('admin')),
);
?>

<h1>Detalles de Pago #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'FechaPago',
		array(
        	'name' => 'Nro Cuota',
            'value' => $model->planpago->getDatosCuota(),
              ),
		'suscripcion_id',
		'financiacion_id',
		'Pagado',
		'NroDeposito',
		'forma_pago_id',
		'Importe',
		'Descripcion',
		'Anio',
		'Mes',
	),
)); ?>
