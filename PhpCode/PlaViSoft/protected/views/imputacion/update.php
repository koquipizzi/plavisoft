<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->breadcrumbs=array(
	'Imputacions'=>array('index'),
	$model->pago_id=>array('view','id'=>$model->pago_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Imputacion', 'url'=>array('index')),
	array('label'=>'Create Imputacion', 'url'=>array('create')),
	array('label'=>'View Imputacion', 'url'=>array('view', 'id'=>$model->pago_id)),
	array('label'=>'Manage Imputacion', 'url'=>array('admin')),
);
?>

<h1>Update Imputacion <?php echo $model->pago_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>