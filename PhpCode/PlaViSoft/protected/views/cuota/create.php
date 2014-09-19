<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuota', 'url'=>array('index')),
	array('label'=>'Manage Cuota', 'url'=>array('admin')),
);
?>

<h1>Create Cuota</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>