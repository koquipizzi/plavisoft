<?php
$this->breadcrumbs=array(
	'Forma Pagos',
);

$this->menu=array(
	array('label'=>'Nueva FormaPago','url'=>array('create')),
	array('label'=>'Administrar FormaPago','url'=>array('admin')),
);
?>

<h1>Forma Pagos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
