<?php
$this->breadcrumbs=array(
	'Planpagos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Planpago','url'=>array('index')),
	array('label'=>'Nueva Planpago','url'=>array('create')),
	array('label'=>'Ver Planpago','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Planpago','url'=>array('admin')),
);
?>

<h1>Update Planpago <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>