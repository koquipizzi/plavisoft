<?php
$this->breadcrumbs=array(
	'Estado Adjudicacions'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar EstadoAdjudicacion','url'=>array('index')),
	array('label'=>'Nueva EstadoAdjudicacion','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('estado-adjudicacion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Estado Adjudicacions</h1>


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
