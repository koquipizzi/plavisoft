<?php
/* @var $this ChequeController */
/* @var $model Cheque */

$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cheque', 'url'=>array('index')),
	array('label'=>'Create Cheque', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cheque-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cheques</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cheque-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'Nro_cheque',
		'Cta_cte',
		'valor',
		'pago_id',
		'NombreTitular',
		/*
		'banco_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
