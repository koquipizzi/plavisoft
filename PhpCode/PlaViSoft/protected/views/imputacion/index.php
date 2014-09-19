<?php
/* @var $this ImputacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Imputacions',
);

$this->menu=array(
	array('label'=>'Create Imputacion', 'url'=>array('create')),
	array('label'=>'Manage Imputacion', 'url'=>array('admin')),
);
?>

<h1>Imputacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
