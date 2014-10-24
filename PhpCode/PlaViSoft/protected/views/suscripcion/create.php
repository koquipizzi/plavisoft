<?php
$this->breadcrumbs=array(
	'Suscripcions'=>array('index'),
	'Nueva',
);

?>

<h1>Nueva Suscripcion
    <?php 
        if(isset($persona)){
            echo ' para '.$persona->Apellido.", ".$persona->Nombre;
        }
    ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'persona'=>$persona,'financiacion'=>$financiacion,'anio'=>$anio)); ?>