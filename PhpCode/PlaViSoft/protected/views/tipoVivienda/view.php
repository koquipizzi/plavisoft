<?php
$this->breadcrumbs=array(
	'Tipo Viviendas'=>array('index'),
	$model->id,
);

$this->menu=array(
//	array('label'=>'List TipoVivienda','url'=>array('index')),
	array('label'=>'Crear TipoVivienda','url'=>array('create')),
//	array('label'=>'Update TipoVivienda','url'=>array('update','id'=>$model->id)),
//	array('label'=>'Delete TipoVivienda','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Tipos de Vivienda','url'=>array('admin')),
);
?>

<h1>Tipo de Vivienda #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Descripcion',
		'Valor',
		'Nombre',
		'MtrosCubiertos',
		'MtrosDescubiertos',
		'CantHabitaciones',
		'CantPisos',
		'SobreCalle',
		'Fotos',
	),
)); ?>
