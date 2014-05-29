<?php
$this->breadcrumbs=array(
	'Forma Pagos'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar FormaPago','url'=>array('index')),
	array('label'=>'Administrar FormaPago','url'=>array('admin')),
);
?>

<h1>Nueva FormaPago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>