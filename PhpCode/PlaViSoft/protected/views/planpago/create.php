<?php
$this->breadcrumbs=array(
	'Planpagos'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Planpago','url'=>array('index')),
	array('label'=>'Administrar Planpago','url'=>array('admin')),
);
?>

<h1>Nueva Planpago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>