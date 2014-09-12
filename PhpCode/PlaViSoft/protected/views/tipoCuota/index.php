<?php
$this->breadcrumbs=array(
	'Tipo Cuotas',
);

$this->menu=array(
	array('label'=>'Nueva TipoCuota','url'=>array('create')),
	array('label'=>'Administrar TipoCuota','url'=>array('admin')),
);
?>

<h1>Tipo Cuotas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
