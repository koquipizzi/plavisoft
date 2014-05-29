<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	'Nueva',
);

$this->menu=array(
//	array('label'=>'Listar Tipo de Cuotas','url'=>array('index')),
	array('label'=>'Administrar Tipos de Cuota','url'=>array('admin')),
);
?>

<h1>Nuevo Tipo de Cuota</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>