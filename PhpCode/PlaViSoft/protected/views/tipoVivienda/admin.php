<?php
$this->breadcrumbs=array(
	'Tipo Viviendas'=>array('index'),
	'Administrar',
);

$this->menu=array(
//	array('label'=>'Listar Tipo Vivienda','url'=>array('index')),
	array('label'=>'Nuevo Tipo de Vivienda','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-vivienda-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Tipos de Viviendas</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		//'id',
		'Nombre',
		'Valor',
		'Descripcion',
		'MtrosCubiertos',
		'MtrosDescubiertos',
		/*
		'CantHabitaciones',
		'CantPisos',
		'SobreCalle',
		'Fotos',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
