<?php
$this->breadcrumbs=array(
	'Financiacions'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Nueva Financiación','url'=>array('create')),
	array('label'=>'Administrar Financiaciones','url'=>array('admin')),
);
?>

<h1>Nueva Financiacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>