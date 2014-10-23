<?php
$this->breadcrumbs=array(
	'Financiacions'=>array('index'),
	'Administrar',
);

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
