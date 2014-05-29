<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Persona','url'=>array('index')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>

<h1>Nueva Persona</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>