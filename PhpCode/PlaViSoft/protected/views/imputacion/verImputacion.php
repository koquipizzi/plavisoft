<?php
/* @var $this ImputacionController */
/* @var $model Imputacion */

$this->menu=array(
	array('label'=>'Listar Imputaciones', 'url'=>array('index')),
	//array('label'=>'Create Imputacion', 'url'=>array('create')),
);

$this->menu=array(
	array('label'=>'Suscripción', 'url'=>array('cuota/admin&suscripcion_id='.$susc)),
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
