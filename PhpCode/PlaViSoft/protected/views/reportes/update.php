<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
//	array('label'=>'Listar Cheque','url'=>array('index')),
//	array('label'=>'Nueva Cheque','url'=>array('create')),
	array('label'=>'Ver Cheque','url'=>array('view','id'=>$model->id)),
	array('label'=>'Administrar Cheques','url'=>array('admin')),
);
?>

<h1>Salida de Cheque <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>