<?php
$this->breadcrumbs=array(
	'Adelantos',
);

$this->menu=array(
	array('label'=>'Nueva Adelanto','url'=>array('create')),
	array('label'=>'Administrar Adelanto','url'=>array('admin')),
);
?>

<h1>Adelantos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
