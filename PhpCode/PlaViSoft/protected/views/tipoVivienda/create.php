<?php
$this->breadcrumbs=array(
	'Tipos de Viviendas'=>array('index'),
	'Nuevo Tipo de Vivienda',
);

$this->menu=array(
	//array('label'=>'Listar TipoVivienda','url'=>array('index')),
	array('label'=>'Administrar Tipos de Vivienda','url'=>array('admin')),
);
?>

<h1>Nuevo Tipo de Vivienda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>