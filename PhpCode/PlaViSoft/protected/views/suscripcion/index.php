<?php
$this->breadcrumbs=array(
	'Suscripcions',
);

$this->menu=array(
	array('label'=>'Nueva Suscripcion','url'=>array('create')),
	array('label'=>'Administrar Suscripcion','url'=>array('admin')),
);
?>

<h1>Suscripcions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
