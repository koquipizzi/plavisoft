<?php
$this->breadcrumbs=array(
	'Planpagos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Planpago','url'=>array('index')),
	array('label'=>'Nueva Planpago','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('planpago-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Planpagos</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'financiacion_id',
		'nro_cuota',
		'mes',
		'anio',
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
