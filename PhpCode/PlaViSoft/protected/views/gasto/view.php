<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Nuevo Gasto', 'url'=>array('create')),
	array('label'=>'Modificar Gasto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Gasto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Listar Gasto', 'url'=>array('admin')),
);
?>

<h1>View Gasto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fecha',            
		'descripcion',
		'valorStr',
	),
)); ?>
