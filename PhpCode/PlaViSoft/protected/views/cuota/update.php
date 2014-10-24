<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Suscripción', 'url'=>array('cuota/admin&suscripcion_id='.$model->suscripcion->id)),
);
?>

<h1>Actualizar Cuota <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>