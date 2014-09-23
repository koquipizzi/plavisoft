<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cuota', 'url'=>array('index')),
	array('label'=>'Create Cuota', 'url'=>array('create')),
	array('label'=>'Update Cuota', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cuota', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cuota', 'url'=>array('admin')),
);
?>

<h1>View Cuota #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nro_cuota',
		'valor',
		'mes.mes',
		'anio',
		'saldada',
	),
)); ?>
