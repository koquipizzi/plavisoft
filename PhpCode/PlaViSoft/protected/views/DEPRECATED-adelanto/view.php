<?php
$this->breadcrumbs=array(
	'Adelantos'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List Adelanto','url'=>array('index')),
	array('label'=>'Nuevo Adelanto','url'=>array('create')),
//	array('label'=>'Update Adelanto','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete Adelanto','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Adelantos','url'=>array('admin')),
);
?>

<h1>Adelanto #<?php echo $model->id; ?> de <?php echo $model->persona->Nombre." ".$model->persona->Apellido; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'persona_id',
		'formaPago.Descripcion',
		'importe',
		'pago_id',
		'adelanto_id',
		'importe_imponible',
	),
)); ?>
