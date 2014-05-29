<?php
$this->breadcrumbs=array(
	'Tipo Personas'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar TipoPersona','url'=>array('index')),
	array('label'=>'Administrar TipoPersona','url'=>array('admin')),
);
?>

<h1>Nueva TipoPersona</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>