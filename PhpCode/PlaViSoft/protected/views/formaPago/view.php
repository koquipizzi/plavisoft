<?php
$this->breadcrumbs=array(
	'Forma Pagos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FormaPago','url'=>array('index')),
	array('label'=>'Create FormaPago','url'=>array('create')),
	array('label'=>'Update FormaPago','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FormaPago','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormaPago','url'=>array('admin')),
);
?>

<h1>View FormaPago #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Descripcion',
	),
)); ?>
