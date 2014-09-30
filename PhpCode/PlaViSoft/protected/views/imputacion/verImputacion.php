<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->breadcrumbs=array(
	'Imputacions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Imputacion', 'url'=>array('index')),
	array('label'=>'Create Imputacion', 'url'=>array('create')),
);

?>

<h1>Imputaciones</h1>

<?php 
    
    if(count($imputaciones)==0){
        echo "No existen imputaciones";
    }
    else{
        $this->widget('application.extensions.tablesorter.SorterImputacion', array(
            'id'=>'imputacion-grid',
            'data'=>$imputaciones,
            'columns'=>array(
                array(
                    'header' => 'Pago',
                    'value' => 'pago_field',
                ),
                array(
                    'header' => 'Cuota',
                    'value' => 'cuota_field',
                ),
                array(
                    'header' => 'Valor',
                    'value' => 'valorStr',
                    'style'=>'text-align: right;',
                ),

            ),
        ));        
    }

?>
