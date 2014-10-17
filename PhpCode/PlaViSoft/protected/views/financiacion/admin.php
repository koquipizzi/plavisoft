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

<h1>Financiaciones</h1>


<?php	$this->widget('application.extensions.tablesorter.SorterFinanciacion', array(
	  'data'=>$records,
	  'columns'=>array(
                array(
                    'header' => 'Financiación ',
                    'value' => 'Descripcion',
                ),                
                array(
                    'header' => 'Tipo de Vivienda',
                    'value' => 'tipoVivienda.Nombre',
                ),                
                array(
                    'header' => 'Tipo Persona',
                    'value' => 'tipoPersona.Descripcion',
                ),                
                array(
                    'header' => 'N° de Cuotas',
                    'value' => 'cant_cuotas',
                ),                
                array(
                    'header' => 'N° Asociados',
                    'value' => 'cantAsociados',
                ),                
              
	),
)); ?>
