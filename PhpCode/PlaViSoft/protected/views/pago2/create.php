<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Administrar Pagos','url'=>array('admin')),
);
?>

<h1>Registrar Pago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>