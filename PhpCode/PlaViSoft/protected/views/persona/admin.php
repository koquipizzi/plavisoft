<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Persona','url'=>array('index')),
	array('label'=>'Nueva Persona','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('persona-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Personas - Socios y Adherentes</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Apellido',
		'Nombre',
		'Domicilio',
		'DNI',
		'Mail',
		/*
		'IngresosMensules',
		'CantHijos',
		'FechaAlta',
		'Borrado',
		'Socio',
		'Nota',
		'IdSocio',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
