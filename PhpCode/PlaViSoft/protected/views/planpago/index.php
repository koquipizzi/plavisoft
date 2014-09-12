<?php
$this->breadcrumbs=array(
	'Planpagos',
);

$this->menu=array(
	array('label'=>'Nueva Planpago','url'=>array('create')),
	array('label'=>'Administrar Planpago','url'=>array('admin')),
);
?>

<h1>Planpagos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
