<?php
/* @var $this GastoCategoriasController */
/* @var $model GastoCategorias */

$this->breadcrumbs=array(
	'Gasto Categoriases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GastoCategorias', 'url'=>array('index')),
	array('label'=>'Create GastoCategorias', 'url'=>array('create')),
	array('label'=>'View GastoCategorias', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GastoCategorias', 'url'=>array('admin')),
);
?>

<h1>Update GastoCategorias <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>