<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Gastos', 'url'=>array('admin')),
);
?>

<h1>Nuevo Gasto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>