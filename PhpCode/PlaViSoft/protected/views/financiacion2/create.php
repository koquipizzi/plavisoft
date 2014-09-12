<?php
$this->breadcrumbs=array(
	'Financiacions'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Financiacion','url'=>array('index')),
	array('label'=>'Administrar Financiacion','url'=>array('admin')),
);
?>

<h1>Nueva Financiacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>