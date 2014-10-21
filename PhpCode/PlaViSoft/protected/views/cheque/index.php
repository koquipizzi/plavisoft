<?php
$this->breadcrumbs=array(
	'Cheques',
);

$this->menu=array(
	array('label'=>'Nueva Cheque','url'=>array('create')),
	array('label'=>'Administrar Cheque','url'=>array('admin')),
);
?>

<h1>Cheques</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
