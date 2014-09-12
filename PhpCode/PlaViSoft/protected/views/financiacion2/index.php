<?php
$this->breadcrumbs=array(
	'Financiacions',
);

$this->menu=array(
	array('label'=>'Nueva Financiacion','url'=>array('create')),
	array('label'=>'Administrar Financiacion','url'=>array('admin')),
);
?>

<h1>Financiacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
