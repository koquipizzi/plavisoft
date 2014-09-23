<?php
/* @var $this ChequeController */
/* @var $model Cheque */

$this->breadcrumbs=array(
	'Cheques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cheque', 'url'=>array('index')),
	array('label'=>'Manage Cheque', 'url'=>array('admin')),
);
?>

<h1>Create Cheque</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>