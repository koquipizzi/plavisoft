<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Manage',
);

    if(count($records)==0){
        echo "<h1>Listado de Pagos</h1>";                
        echo "No existen pagos registrados";
    }
    else{
        echo "<h1>Listado de Pagos ".$records[0]->persona->nombreCompleto."</h1>";         
        
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
            ),
            'filters'=>array(
                '',
                '', 
                '', 
                '',                 
            ),
            
        )); 
    }    
?>