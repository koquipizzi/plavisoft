<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Pago','url'=>array('index')),
	array('label'=>'Nueva Pago','url'=>array('create')),
	array('label'=>'Ver Pago','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Pago','url'=>array('admin')),
);
?>

<h1>Update Pago <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>