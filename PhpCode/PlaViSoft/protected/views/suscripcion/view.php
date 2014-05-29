<?php
$this->breadcrumbs=array(
	'Suscripcions'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Suscripcion','url'=>array('index')),
	array('label'=>'Crear Suscripción','url'=>array('create')),
//	array('label'=>'Update Suscripcion','url'=>array('update','id'=>$model->id)),
//	array('label'=>'Delete Suscripcion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Suscripciones','url'=>array('admin')),
);
?>

<h1>Suscripción Nro.<?php echo $model->id." de ".$model->persona->Nombre." ".$model->persona->Apellido;  ?> </h1>


<?php
	//var_dump($records); //die();
	echo "<strong>TOTAL: ".$model->financiacion->Importe;
	$resto = $model->financiacion->Importe - $pagosTotales;
	echo " - <span style:'color:green;'>CANCELADO: ".$pagosTotales."</span>";
	echo " - <span style:'color:red;'>RESTANTE: ".$resto."</span></strong>";
	
	
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
                        'type' => 'pie',
                        'data' => array(
                                array('RESTO: $'.$resto, $resto),
                                array('CANCELADO: $'.$pagosTotales, $pagosTotales)
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
	    'financiacion.Importe',
		'Nota',
		'Adjudicado',
	),
)); ?>

<?php 
		
		$this->widget(
			'bootstrap.widgets.TbButton',
			array(
			'url'=>'index.php?r=pago/create&financiacion='.$model->financiacion_id.'&suscripcion='.$model->id,
			'type' => 'primary',
			'label' => 'Registrar Pago'
			)
		); 
		echo "</br></br>";

                          //      printf('<li>%s</li>', CHtml::link($susc->id, array('suscripcions/view', 'id' => $susc->id)));
    
     
     ?>

<h1>Administrar Pagos</h1>


<?php	$this->widget('application.extensions.tablesorter.Sorter', array(
	  'data'=>$records,
	  'columns'=>array(
	    'NroCuota',
	    'Mes',
		'Anio',
		'Importe',
		'FechaPago',
		'formaPago.Descripcion'
	),
)); ?>