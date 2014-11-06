<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Nuevo Gasto', 'url'=>array('create')),
	array('label'=>'Ver Gasto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Listar Gastos', 'url'=>array('admin')),
);

?>

<h1>Modificar Gasto</h1>

<?php $this->renderPartial('_form', array(
    'model'=>$model,
    'gastoCategoria'=>$gastoCategoria,
    'categorias_ids'=>$categorias_ids,
    'categorias'=>$categorias,
)); ?>