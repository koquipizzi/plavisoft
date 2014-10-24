<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Administrar',
);

?>

<h1>Cheques</h1>
<div style="float: right; position: relative; margin-top: -65px;">
<?php                 
    $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type' => 'primary',
        'toggle' => 'radio', // 'checkbox' or 'radio'
        'buttons' => array(
            array('label'=>'Listar Todos', 'url'=>'index.php?r=cheque/admin', 'active'=>$activo[0]),
            array('label'=>'Listar sin Entregar', 'url'=>'index.php?r=cheque/admin&tipo=0', 'active'=>$activo[1]),
            array('label'=>'Listar Entregados', 'url'=>'index.php?r=cheque/admin&tipo=1', 'active'=>$activo[2]),
        ),
    ));    
?></div>
</h1>
<?php	

    if(count($records)==0){
        echo "No existen cheques registrados";
    }
    else{
        $this->widget('application.extensions.tablesorter.SorterCheque', array(
            'data'=>$records,
            'columns'=>array(
                array(
                    'header' => 'Nro. Cheque',
                    'value' => 'Nro_cheque',
                ),                
                array(
                    'header' => 'Cta. Cte.',
                    'value' => 'Cta_cte',
                ),                
                array(
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
                ),                
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
