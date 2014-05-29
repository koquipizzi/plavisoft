<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar TipoCuota','url'=>array('index')),
	array('label'=>'Administrar TipoCuota','url'=>array('admin')),
);
?>

<h1>Nueva TipoCuota</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>