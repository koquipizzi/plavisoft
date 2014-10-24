<?php
$this->breadcrumbs=array(
	'Suscripciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Suscripcion','url'=>array('index')),
//	array('label'=>'Crear Suscripción','url'=>array('create')),
//	array('label'=>'Update Suscripcion','url'=>array('update','id'=>$model->id)),
//	array('label'=>'Delete Suscripcion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Suscripciones','url'=>array('admin')),
);
?>

<h1>Suscripción Nro.<?php echo $model->id." de ".$model->persona->Nombre." ".$model->persona->Apellido;  ?> </h1>


<?php
	//var_dump($records); //die();
	echo "<strong>TOTAL: ".$total."</strong><br />";
	$resto = $total - $pagos;
	echo "<strong>CANCELADO: ".$pagos."</strong><br />";
	echo "<strong>RESTANTE: ".$resto."</strong><br />";
	
$this->widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
   			    'title'=> array('text'=> 'Estado de Suscripción') ,
   			     'chart' => array(
			        'plotBackgroundColor' => '#ffffff',
			        'plotBorderWidth' => null,
			        'plotShadow' => false,
			        'width' => 400,
			      ),
                'series' => array(array(
                        'type' => 'pie', 'name' => 'Total',
                        'data' => array(
                               array('RESTO', $resto),
                                array('CANCELADO', $pagos)
                        )
                ))
        )

));
	$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model, 
	'attributes'=>array(
	//	'id',
		'FechaAlta',
	//	'persona.Nombre', 
	//	'Apellido',
	//'persona.Apellido',
	//    'financiacion.Importe',
	//	'Nota',
		'Adjudicado',
	),
)); ?>


