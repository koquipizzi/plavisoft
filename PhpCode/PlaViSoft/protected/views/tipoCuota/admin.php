<?php
$this->breadcrumbs=array(
	'Tipo Cuotas'=>array('index'),
	'Administrar',
);

$this->menu=array(
//	array('label'=>'Listar TipoCuota','url'=>array('index')),
	array('label'=>'Nuevo Tipo de Cuota','url'=>array('create')),
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

<h1>Administrar Tipos de Cuotas</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
		'id',
		'Descripcion',
		'valor',
		'ImporteLetras',
		'financiacion.Descripcion',
	//	'Adjudicado',
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
