<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Cheque','url'=>array('index')),
	array('label'=>'Nueva Cheque','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cheque-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Cheques</h1>


<?php	$this->widget('application.extensions.tablesorter.SorterCheque', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Nro_cheque',
		'Cta_cte',
		'valor',
		'pago_id',
		'NombreTitular',
		/*
		'banco_id',
		'FechaVencimiento',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
