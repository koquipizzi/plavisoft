<?php
$this->breadcrumbs=array(
	'Tipo Personas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar TipoPersona','url'=>array('index')),
	array('label'=>'Nueva TipoPersona','url'=>array('create')),
	array('label'=>'Ver TipoPersona','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar TipoPersona','url'=>array('admin')),
);
?>

<h1>Update TipoPersona <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>