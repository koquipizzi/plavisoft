<?php
$this->breadcrumbs=array(
	'Forma Pagos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar FormaPago','url'=>array('index')),
	array('label'=>'Nueva FormaPago','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('forma-pago-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Forma Pagos</h1>


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
