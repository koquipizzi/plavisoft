<?php
$this->breadcrumbs=array(
	'Forma Pagos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar FormaPago','url'=>array('index')),
	array('label'=>'Nueva FormaPago','url'=>array('create')),
	array('label'=>'Ver FormaPago','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar FormaPago','url'=>array('admin')),
);
?>

<h1>Update FormaPago <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>