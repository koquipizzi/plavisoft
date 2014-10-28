<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Nueva Persona','url'=>array('create')),
);

?>

<h1>Personas - Socios y Adherentes</h1>


<?php	$this->widget('application.extensions.tablesorter.SorterPersona', array(
        'id'=>'idPersonaTableSorter',
	'data'=>$records,
	'columns'=>array(
		//'id',
                array(
                    'header' => 'Tipo',
                    'value' => 'tipoPersona.Descripcion',
                ),                
		'nombreCompleto',
                'Telefono',
		'TelefonoCelular',
		'DNI',
	),
        
        'filters'=>array(
            'filter-select', // filter as select box
            '',
            '',
            '', 
            '', 
        ),
)); ?>
