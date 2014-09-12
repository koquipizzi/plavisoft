<?php
$this->breadcrumbs=array(
	'Tipo Viviendas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
//	array('label'=>'Listar TipoVivienda','url'=>array('index')),
	array('label'=>'Nueva Tipo de Vivienda','url'=>array('create')),
//	array('label'=>'Ver TipoVivienda','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar TipoVivienda','url'=>array('admin')),
);
?>

<h1>Actualiazar TipoVivienda <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>