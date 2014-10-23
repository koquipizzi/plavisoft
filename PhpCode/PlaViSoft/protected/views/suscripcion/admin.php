<?php
$this->breadcrumbs=array(
	'Suscripciones'=>array('index'),
	'Administrar',
);

$this->menu=array(
//	array('label'=>'Listar Suscripcion','url'=>array('index')),
	array('label'=>'Nueva Suscripcion','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('suscripcion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Suscripciones</h1>


<?php	

    if(count($records)==0){
        echo "No existen suscripciones registradas";
    }
    else{
        $this->widget('application.extensions.tablesorter.SorterSuscripcion', array(
            'data'=>$records,
            'columns'=>array(
                array(
                    'header' => 'Nombre',
                    'value' => 'persona.nombreCompleto',
                ),                
                'financiacion.Descripcion',
                'estadoAdjudicacion.Descripcion',	
                array(
                    'header' => 'Pagado',
                    'value' => 'totalPagado',
                    'style'=>'text-align: right;',
                ),                
                array(
                    'header' => 'Adeudado',
                    'value' => 'totalDeuda',
                    'style'=>'text-align: right;',
                ),                
            ),
            'filters'=>array(
                '',
                'filter-select', 
                'filter-select', 
                '', 
                '', 
            ),
            
        ));         
    }
?>
