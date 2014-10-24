<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Suscripción', 'url'=>array('cuota/admin&suscripcion_id='.$model->suscripcion->id)),
);
?>

<h1>Cuota <?php echo $model->nro_cuota; ?>: <?php echo $model->mes->mes." "; ?><?php echo $model->anio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nro_cuota',
		'valor',
		'mes.mes',
		'anio',
		'saldada',
                array(
                    'name'=>'Persona',
                    'type'=>'raw',
                    'value'=>CHtml::link($model->personaStr, array('Persona/view&id='.$model->suscripcion->persona->id)),
                ),            
                            
	),
)); ?>

<?php 
    if($model->saldada == 'No'){
        $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                'url'=>'index.php?r=Cuota/saldar&id='.$model->id,
                'type' => 'info',
                'label' => 'Saldar Cuota'
                )
        ); 
    }
    echo " ";
    $this->widget(
            'bootstrap.widgets.TbButton',
            array(
            'url'=>'index.php?r=cuota/admin&suscripcion_id='.$model->suscripcion->id,
            'type' => 'info',
            'label' => 'Suscripción'
            )
    ); 


?>