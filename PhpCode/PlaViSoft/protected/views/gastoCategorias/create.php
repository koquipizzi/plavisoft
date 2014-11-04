<?php
/* @var $this GastoCategoriasController */
/* @var $model GastoCategorias */

$this->breadcrumbs=array(
	'Gasto Categoriases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GastoCategorias', 'url'=>array('index')),
	array('label'=>'Manage GastoCategorias', 'url'=>array('admin')),
);
?>

<h1>Create GastoCategorias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>