<?php
$this->breadcrumbs=array(
	'Estado Adjudicacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar EstadoAdjudicacion','url'=>array('index')),
	array('label'=>'Nueva EstadoAdjudicacion','url'=>array('create')),
	array('label'=>'Ver EstadoAdjudicacion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar EstadoAdjudicacion','url'=>array('admin')),
);
?>

<h1>Update EstadoAdjudicacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>