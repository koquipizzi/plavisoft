<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gasto', 'url'=>array('index')),
	array('label'=>'Create Gasto', 'url'=>array('create')),
	array('label'=>'View Gasto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gasto', 'url'=>array('admin')),
);
?>

<h1>Update Gasto <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>