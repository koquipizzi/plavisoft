<?php
/* @var $this GastoCategoriasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gasto Categoriases',
);

$this->menu=array(
	array('label'=>'Create GastoCategorias', 'url'=>array('create')),
	array('label'=>'Manage GastoCategorias', 'url'=>array('admin')),
);
?>

<h1>Gasto Categoriases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
