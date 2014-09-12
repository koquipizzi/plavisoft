<?php
$this->breadcrumbs=array(
	'Estado Adjudicacions'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar EstadoAdjudicacion','url'=>array('index')),
	array('label'=>'Administrar EstadoAdjudicacion','url'=>array('admin')),
);
?>

<h1>Nueva EstadoAdjudicacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>