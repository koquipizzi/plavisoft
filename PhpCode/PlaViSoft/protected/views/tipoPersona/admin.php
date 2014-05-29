<?php
$this->breadcrumbs=array(
	'Tipo Personas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar TipoPersona','url'=>array('index')),
	array('label'=>'Nueva TipoPersona','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-persona-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Tipo Personas</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Descripcion',
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
