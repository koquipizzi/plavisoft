<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->breadcrumbs=array(
	'Imputacions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Imputacion', 'url'=>array('index')),
	array('label'=>'Create Imputacion', 'url'=>array('create')),
);

?>

<h1>Imputaciones</h1>

<?php $this->widget('application.extensions.tablesorter.Sorter', array(
	'id'=>'imputacion-grid',
	'data'=>$imputaciones,
	'columns'=>array(
            array(
                'header' => 'Pago',
                'value' => 'pago_field',
            ),
            array(
                'header' => 'Cuota',
                'value' => 'cuota_field',
            ),
            array(
                'header' => 'Valor',
                'value' => 'valor',
                'style'=>'text-align: right;',
            ),

	),
)); ?>
