<?php
$this->breadcrumbs=array(
	'Tipo Personas',
);

$this->menu=array(
	array('label'=>'Nueva TipoPersona','url'=>array('create')),
	array('label'=>'Administrar TipoPersona','url'=>array('admin')),
);
?>

<h1>Tipo Personas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
