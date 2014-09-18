<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->breadcrumbs=array(
	'Imputacions'=>array('index'),
	$model->pago_id,
);

$this->menu=array(
	array('label'=>'List Imputacion', 'url'=>array('index')),
	array('label'=>'Create Imputacion', 'url'=>array('create')),
	array('label'=>'Update Imputacion', 'url'=>array('update', 'id'=>$model->pago_id)),
	array('label'=>'Delete Imputacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pago_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Imputacion', 'url'=>array('admin')),
);
?>

<h1>View Imputacion #<?php echo $model->pago_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pago_id',
		'valor',
		'cuota_id',
	),
)); ?>
