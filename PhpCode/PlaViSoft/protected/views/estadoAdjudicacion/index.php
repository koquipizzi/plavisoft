<?php
$this->breadcrumbs=array(
	'Estado Adjudicacions',
);

$this->menu=array(
	array('label'=>'Nueva EstadoAdjudicacion','url'=>array('create')),
	array('label'=>'Administrar EstadoAdjudicacion','url'=>array('admin')),
);
?>

<h1>Estado Adjudicacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
