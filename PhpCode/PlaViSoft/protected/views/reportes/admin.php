<?php
$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Administrar',
);

?>

<h1>Reportes
<div style="float:right;">
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

