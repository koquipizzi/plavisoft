<?php
/* @var $this GastoController */
/* @var $model Gasto */

$this->breadcrumbs=array(
	'Gastos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Nuevo Gasto', 'url'=>array('create')),
	array('label'=>'Modificar Gasto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Gasto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro en eliminar este gasto?')),
	array('label'=>'Listar Gasto', 'url'=>array('admin')),
);
?>

<h1>Gasto</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fecha',            
		'descripcion',
		'valorStr',
                'nroFormulario',
                'nota',           
	),
)); ?>


<h4>Categorías</h4>
<?php 
    $this->renderPartial(
        'ajaxCategoriaChange',
        array(
            'categorias'=>$categorias,
            'borrarEnabled'=>FALSE,
            'tituloEnabled'=>FALSE,
        )
    );
?>

