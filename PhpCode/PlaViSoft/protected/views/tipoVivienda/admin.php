<?php
$this->breadcrumbs=array(
	'Tipo Viviendas'=>array('index'),
	'Administrar',
);

?>

<h1>Administrar Tipos de Viviendas</h1>


<?php	$this->widget('application.extensions.tablesorter.SorterVivienda', array(
	  'data'=>$records,
	  'columns'=>array(
		//'id',
		'Nombre',
		'valor',
                'cantidad',
                'Descripcion',
		/*
		'CantHabitaciones',
		'CantPisos',
		'SobreCalle',
		'Fotos',
		*/
	/*	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
