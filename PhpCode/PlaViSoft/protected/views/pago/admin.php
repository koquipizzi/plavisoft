<?php
$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Pago','url'=>array('index')),
	array('label'=>'Nueva Pago','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pago-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Pagos</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'FechaPago',
		'Importe',
		'suscripcion_id',
		'financiacion_id',
		/*
		'Pagado',
		'NroDeposito',
		'forma_pago_id',
		'Importe',
		'Descripcion',
		'Anio',
		'Mes',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
