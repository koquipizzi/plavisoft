<?php
$this->breadcrumbs=array(
	'Suscripciones'=>array('index'),
	'Administrar',
);
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
                array(
                    'header' => 'Tipo',
                    'value' => 'financiacion.Descripcion',
                ),                
                array(
                    'header' => 'Nro',
                    'value' => 'numero',
                ),                
                array(
                    'header' => 'Estado',
                    'value' => 'estadoAdjudicacion.Descripcion',
                ),                
                
                	
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
                '', 
                'filter-select', 
                '', 
                '', 
            ),
            
        ));         
    }
?>
