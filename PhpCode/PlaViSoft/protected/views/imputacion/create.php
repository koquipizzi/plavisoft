<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->breadcrumbs=array(
	'Imputacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Imputacion', 'url'=>array('index')),
	array('label'=>'Manage Imputacion', 'url'=>array('admin')),
);
?>

<h1>Create Imputacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>