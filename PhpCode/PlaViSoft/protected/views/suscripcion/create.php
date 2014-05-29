<?php
$this->breadcrumbs=array(
	'Suscripcions'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Suscripcion','url'=>array('index')),
	array('label'=>'Administrar Suscripcion','url'=>array('admin')),
);
?>

<h1>Nueva Suscripcion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>