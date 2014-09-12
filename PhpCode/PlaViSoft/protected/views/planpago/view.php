<?php
$this->breadcrumbs=array(
	'Planpagos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Planpago','url'=>array('index')),
	array('label'=>'Create Planpago','url'=>array('create')),
	array('label'=>'Update Planpago','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Planpago','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Planpago','url'=>array('admin')),
);
?>

<h1>View Planpago #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'financiacion_id',
		'nro_cuota',
		'mes',
		'anio',
	),
)); ?>
