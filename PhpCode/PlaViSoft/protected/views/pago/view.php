<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Pagos', 'url'=>array('index')),
	array('label'=>'Crear Nuevo Pago', 'url'=>array('create')),
	array('label'=>'Borrar Pago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro en borrar este pago?')),
);
?>

<h1>Pago: <?php echo $model->talonario." - ".$model->nro_formulario; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'FechaPago',
		'valorStr',
		'ImporteLetras',
		'Descripcion',
                array(
                    'name'=>'Persona',
                    'type'=>'raw',
                    'value'=>CHtml::link($model->personaStr, array('Persona/view&id='.$model->persona->id)),
                ),            

	),
)); ?>


<?php 

    if(isset($formaPagoContado)){
        echo "<h1>Contado</h1>";
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$formaPagoContado,
            'attributes'=>array(
                    'valorStr',
            ),
        ));        
    }

    if(isset($formaPagoCheque)&&isset($cheques)&&(count($cheques)>0)){
        echo "<h1>Cheques</h1>";
        if(!is_array($cheques)){
            $cheques = array($cheques);
        }
        $this->renderPartial(
            'listaChequesEdicion', 
            array(
                'cheques'=>$cheques,
                'borrarEnabled'=>false
            )
        );
    }
    
    if(isset($formaPagoDeposito)){
        echo "<h1>Depósito</h1>";

        $this->renderPartial(
            'listaChequesEdicion', 
            array(
                'cheques'=>$cheques,
                'borrarEnabled'=>false
            )
        );
    }    

 ?>

