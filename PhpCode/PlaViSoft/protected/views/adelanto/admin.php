<?php
$this->breadcrumbs=array(
	'Adelantos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'Listar Adelantos','url'=>array('index')),
	array('label'=>'Nuevo Adelanto','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('adelanto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Adelantos</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'fecha',
				'persona.Apellido',
		'persona.Nombre',
		'formaPago.Descripcion',
		'importe',
		'pago_id',
		/*
		'adelanto_id',
		'importe_imponible',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
