<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Manage',
);


if(isset($persona_id)){
    $this->menu=array(
            array('label'=>'Ver Suscripciones', 'url'=>array("Persona/view&id=".$persona_id)),
    );
}
elseif(isset($suscripcion_id)){
    $this->menu=array(
            array('label'=>'Ir a Suscripción', 'url'=>array("cuota/admin&suscripcion_id=".$suscripcion_id)),
    );
} 
    if(count($records)==0){
        echo "<h1>Listado de Pagos</h1>";        
        echo "No existen pagos registrados";
    }
    else{
        echo "<h1>Listado de Pagos ".$records[0]->persona->nombreCompleto.". Suscripción: ".$records[0]->cuotasNombreSuscripcion."</h1>";        
        
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
            ),
            'filters'=>array(
                '',
                '',
                '', 
                '', 
                'filter-select', 
            ),
            
        )); 
    }    
?>
