<?php
$this->breadcrumbs=array(
	'Financiacions'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Financiacion','url'=>array('index')),
	array('label'=>'Nueva Financiacion','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('financiacion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Financiaciones</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Descripcion',
		'tipoVivienda.Descripcion',
		'Tipo_Financiacion',
		'Importe',
		'ImporteLetras',
		/*
		'cant_cuotas',
		'posicion',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
