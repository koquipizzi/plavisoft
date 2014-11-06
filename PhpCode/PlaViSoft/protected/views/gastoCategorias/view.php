<?php
/* @var $this GastoCategoriasController */
/* @var $model GastoCategorias */

$this->breadcrumbs=array(
	'Gasto Categoriases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GastoCategorias', 'url'=>array('index')),
	array('label'=>'Create GastoCategorias', 'url'=>array('create')),
	array('label'=>'Update GastoCategorias', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GastoCategorias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GastoCategorias', 'url'=>array('admin')),
);
?>

<h1>View GastoCategorias #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'descripcion',
	),
)); ?>
