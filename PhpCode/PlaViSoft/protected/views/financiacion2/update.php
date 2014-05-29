<?php
$this->breadcrumbs=array(
	'Financiacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Financiacion','url'=>array('index')),
	array('label'=>'Nueva Financiacion','url'=>array('create')),
	array('label'=>'Ver Financiacion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Financiacion','url'=>array('admin')),
);
?>

<h1>Update Financiacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>