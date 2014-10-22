<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	//array('label'=>'Listar Cheque','url'=>array('index')),
	array('label'=>'Administrar Cheques','url'=>array('admin')),
);
?>

<h1>Nuevo Cheque</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>