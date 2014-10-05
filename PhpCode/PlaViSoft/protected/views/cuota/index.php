<?php
/* @var $this CuotaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cuotas',
);


$this->menu=array(
	array('label'=>'Create Cuota', 'url'=>array('create')),
	array('label'=>'Manage Cuota', 'url'=>array('admin')),
);
?>

<h1>Cuotas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
