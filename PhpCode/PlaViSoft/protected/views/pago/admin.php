<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Ir a Suscripción', 'url'=>array('index')),
//	array('label'=>'Create Pago', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pago-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
/**
 * Personalizando Menu de Creacion de Pago, Si la persona del pago esta seteado entonces actualiza menú
 */
$url = 'admin';
$label = 'Ver Suscripciones';

$this->menu=array(
	array('label'=>$label, 'url'=>array("Persona/view&id=".$persona_id)),
);
?>

<h1>Listado de Pagos</h1>
<?php	

    if(count($records)==0){
        echo "No existen pagos registrados";
    }
    else{
        $this->widget('application.extensions.tablesorter.SorterPago', array(
            'data'=>$records,
            'columns'=>array(
                array(
                    'header' => 'Fecha Pago ',
                    'value' => 'FechaPago',
                ),                
               array(
                    'header' => 'Valor',
                    'value' => 'valorStr',
                ), 
                array(
                    'header' => 'Talonario',
                    'value' => 'nroPagoStr',
                ),  
            
        /*                array(
                    'header' => 'Pagado',
                    'value' => 'valorStr',
                    'style'=>'text-align: right;',
                ),                
                array(
                    'header' => 'Fecha Vto',
                    'value' => 'FechaVencimiento',
                ),                
                array(
                    'header' => 'Banco',
                    'value' => 'banco.Banco',
                ),   */             
            ),
            'filters'=>array(
                '',
                '',
                '', 
                '', 
                'filter-select', 
            ),
            
        )); 
    }    
?>

<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pago-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'FechaPago',
		'valor',
		'ImporteLetras',
		'Descripcion',
		'NroDeposito',
		/*
		'persona_id',
		'talonario',
		'nro_formulario',
		*/
	/*	array(
			'class'=>'CButtonColumn',
		),
	),
)); 
	 * 
	 * /
	 */?>
