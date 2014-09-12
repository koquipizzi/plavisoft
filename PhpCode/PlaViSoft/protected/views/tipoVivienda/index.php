<?php
$this->breadcrumbs=array(
	'Tipo Viviendas',
);

$this->menu=array(
	array('label'=>'Nuevo Tipo de Vivienda','url'=>array('create')),
	array('label'=>'Administrar Tipos de Vivienda','url'=>array('admin')),
);
?>

<h1>Tipo Viviendas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
