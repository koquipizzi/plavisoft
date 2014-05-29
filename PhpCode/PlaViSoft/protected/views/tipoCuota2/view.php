<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoCuota','url'=>array('index')),
	array('label'=>'Create TipoCuota','url'=>array('create')),
	array('label'=>'Update TipoCuota','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TipoCuota','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoCuota','url'=>array('admin')),
);
?>

<h1>View TipoCuota #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Descripcion',
		'Importe',
		'Tipo',
		'Adjudicado',
	),
)); ?>
