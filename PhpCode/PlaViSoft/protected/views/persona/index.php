<?php
$this->breadcrumbs=array(
	'Personas',
);

$this->menu=array(
	array('label'=>'Nueva Persona','url'=>array('create')),
	array('label'=>'Administrar Persona','url'=>array('admin')),
);
?>

<h1>Personas</h1>

<?php /**$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
