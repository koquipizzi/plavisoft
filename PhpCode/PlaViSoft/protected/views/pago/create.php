<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pago', 'url'=>array('index')),
	array('label'=>'Manage Pago', 'url'=>array('admin')),
);
?>

<h1>Create Pago</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>