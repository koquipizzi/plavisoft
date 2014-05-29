<?php
$this->breadcrumbs=array(
	'Adelantos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Adelanto','url'=>array('index')),
	array('label'=>'Nueva Adelanto','url'=>array('create')),
	array('label'=>'Ver Adelanto','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Adelanto','url'=>array('admin')),
);
?>

<h1>Update Adelanto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>