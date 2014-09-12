<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Persona','url'=>array('index')),
		array('label'=>'Nueva Persona','url'=>array('create')),
	//array('label'=>'Update Persona','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete Persona','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>

<h1>Detalles de <?php echo $model->Apellido.", ".$model->Nombre; ?></h1>

<?php

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'Apellido',
		'Nombre',
		'Domicilio',
		'DNI',
		'Mail',
		array(
                            'name' => 'CantHijos',
                            'value' => $model->getValoresNulos($model->CantHijos),
               		),
		/*'Borrado',*/
		array(
                            'name' => 'FechaAlta',
                            'value' => Yii::app()->dateFormatter->format("dd-MM-yyyy", strtotime('$data->FechaAlta')),
                    ),
        array(
                            'name' => 'IngresosMensuales',
                            'value' => $model->getValoresNulos($model->IngresosMensuales),
                    ),
        array( 
                            'name' => 'tipo_persona_id',
                            'value' => $model->getTipoPersona($model->tipo_persona_id),
                    ),
        'IdSocio',
        'Nota', 
        
	),
)); ?>

<?php //if  ($model->suscripcions != NULL) { ?>

<h1>Planes Asociados</h1>

<?php 

	 
	
		$this->widget(
			'bootstrap.widgets.TbButton',
			array(
			'url'=>'index.php?r=suscripcion/create&idpersona='.$model->id,
			'type' => 'info',
			'label' => 'Crear Suscripción'
			)
		); 
		
		   echo "<span style='margin-left:20px;float:right;'>";		
		
		$this->widget(
			'bootstrap.widgets.TbButton',
			array(
			'url'=>'index.php?r=adelanto/create&idpersona='.$model->id,
			'type' => 'info',
			'label' => 'Registrar Adelanto'
			)
		); 
		
		echo "</span><br><br>";
  ?>
	<?php foreach($model->suscripcions as $susc) {
		
		$this->widget(
			'bootstrap.widgets.TbButton',
			array(
			'url'=>'index.php?r=suscripcion/view&id='.$susc->id,
			'type' => 'primary',
			'label' => 'Suscripcion: '.$susc->financiacion->Descripcion
			)
		); 
		echo "</br></br>";

                          //      printf('<li>%s</li>', CHtml::link($susc->id, array('suscripcions/view', 'id' => $susc->id)));
     } 
     
     ?>
                                
<?php /*} else  { 
		$this->widget(
			'bootstrap.widgets.TbButton',
			array(
			'url'=>'index.php?r=suscripcion/create',
			'type' => 'info',
			'label' => 'Crear Suscripción'
			)
		); 
 }*/ ?>
 
 
 	