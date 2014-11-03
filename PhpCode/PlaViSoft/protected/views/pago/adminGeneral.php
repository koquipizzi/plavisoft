<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Manage',
);

    echo "<h1>Listado de Pagos</h1>";        

    if(count($records)==0){
        echo "No existen pagos registrados";
    }
    else{
        $this->widget('application.extensions.tablesorter.SorterPago', array(
            'data'=>$records,
            'columns'=>array(
                array(
                    'header' => 'Fecha Pago ',
                    'value' => 'FechaPago',
                ),                
               array(
                    'header' => 'Valor',
                    'value' => 'valorStr',
                ), 
                array(
                    'header' => 'Talonario',
                    'value' => 'nroPagoStr',
                ),  
                array(
                    'header' => 'Suscripción',
                    'value' => 'cuotasNombreSuscripcion',
                ),  
                array(
                    'header' => 'Persona',
                    'value' => 'persona.nombreCompleto',
                ),  
            ),
            'filters'=>array(
                '',
                '',
                '', 
                '', 
                '',                 
            ),
            
        )); 
    }    
?>