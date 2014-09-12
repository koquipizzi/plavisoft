<?php
$this->breadcrumbs=array(
	'Estado Adjudicacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EstadoAdjudicacion','url'=>array('index')),
	array('label'=>'Create EstadoAdjudicacion','url'=>array('create')),
	array('label'=>'Update EstadoAdjudicacion','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete EstadoAdjudicacion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EstadoAdjudicacion','url'=>array('admin')),
);
?>

<h1>View EstadoAdjudicacion #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Descripcion',
	),
)); ?>
