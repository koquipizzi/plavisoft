<?php
$this->breadcrumbs=array(
	'Suscripcions'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Suscripcion','url'=>array('index')),
	array('label'=>'Administrar Suscripcion','url'=>array('admin')),
);
?>

<h1>Nueva Suscripcion
    <?php 
        if(isset($persona)){
            echo ' para '.$persona->Apellido.", ".$persona->Nombre;
        }
    ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'persona'=>$persona,'financiacion'=>$financiacion,)); ?>