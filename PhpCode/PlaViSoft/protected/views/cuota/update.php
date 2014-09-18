<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cuota', 'url'=>array('index')),
	array('label'=>'Create Cuota', 'url'=>array('create')),
	array('label'=>'View Cuota', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cuota', 'url'=>array('admin')),
);
?>

<h1>Update Cuota <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>