<?php
$this->breadcrumbs=array(
	'Financiaciones'=>array('index'),
	$model->id,
);
/*
$this->menu=array(
	array('label'=>'List Financiacion','url'=>array('index')),
	array('label'=>'Create Financiacion','url'=>array('create')),
	array('label'=>'Update Financiacion','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Financiacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Financiacion','url'=>array('admin')),
); */
?>

<h1>Financiación Nro.<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Descripcion',
		'tipo_vivienda_id',
		'Tipo_Financiacion',
		'cant_cuotas',
		'posicion',
	),
)); ?>
