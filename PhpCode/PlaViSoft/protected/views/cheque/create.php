<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Cheque','url'=>array('index')),
	array('label'=>'Administrar Cheque','url'=>array('admin')),
);
?>

<h1>Nueva Cheque</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>