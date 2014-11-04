<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nuevo Gasto', 'url'=>array('create')),
);

?>

<h1>Gastos</h1>

<?php 

    if(count($gastos)<=0){
        echo "No Existen gastos para mostrar. Puede crear uno haciendo click ".CHtml::link('aquí',array('gasto/create'));
    }
    else {
        $this->widget('application.extensions.tablesorter.Sorter', array(
            'id'=>'gasto-grid',
            'data'=>$gastos,
            'columns'=>array(
                    'id',
                    'descripcion',
                    'valor',
                    'fecha',
            ),
            'filters'=>array(
                '',
                '',
                '', 
                'filter-select', 
            ),

        )); 
    }

   
 ?>