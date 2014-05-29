<?php
$this->breadcrumbs=array(
	'Suscripcions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Suscripcion','url'=>array('index')),
	array('label'=>'Nueva Suscripcion','url'=>array('create')),
	array('label'=>'Ver Suscripcion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Suscripcion','url'=>array('admin')),
);
?>

<h1>Update Suscripcion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>