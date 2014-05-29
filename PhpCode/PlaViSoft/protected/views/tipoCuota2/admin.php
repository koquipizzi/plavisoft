<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar TipoCuota','url'=>array('index')),
	array('label'=>'Nueva TipoCuota','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-cuota-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Tipo Cuotas</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Descripcion',
		'Importe',
		'Tipo',
		'Adjudicado',
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
