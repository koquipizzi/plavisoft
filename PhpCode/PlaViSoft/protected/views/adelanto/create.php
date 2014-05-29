<?php
$this->breadcrumbs=array(
	'Adelantos'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Adelanto','url'=>array('index')),
	array('label'=>'Administrar Adelanto','url'=>array('admin')),
);
?>

<h1>Nueva Adelanto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>