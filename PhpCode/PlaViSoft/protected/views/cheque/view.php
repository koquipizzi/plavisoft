<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Cheque','url'=>array('index')),
	//array('label'=>'Create Cheque','url'=>array('create')),
//	array('label'=>'Update Cheque','url'=>array('update','id'=>$model->id)),
//	array('label'=>'Delete Cheque','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Cheques','url'=>array('admin')),
);
?>

<h1>View Cheque #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Nro_cheque',
		'Cta_cte',
		'valor',
		'pago_id',
		'NombreTitular',
		'banco_id',
		'FechaVencimiento',
		'dadoA',
		'dadoFecha',
		'descripcion',
	),
)); ?>
