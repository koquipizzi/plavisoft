<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar TipoCuota','url'=>array('index')),
	array('label'=>'Nueva TipoCuota','url'=>array('create')),
	array('label'=>'Ver TipoCuota','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar TipoCuota','url'=>array('admin')),
);
?>

<h1>Update TipoCuota <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>