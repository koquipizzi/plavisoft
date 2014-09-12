<?php
$this->breadcrumbs=array(
	'Financiaciones',
);

$this->menu=array(
	array('label'=>'Nueva Financiación','url'=>array('create')),
	array('label'=>'Administrar Financiaciones','url'=>array('admin')),
);
?>

<h1>Financiaciones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
