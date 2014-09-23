<?php
/* @var $this ChequeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cheques',
);

$this->menu=array(
	array('label'=>'Create Cheque', 'url'=>array('create')),
	array('label'=>'Manage Cheque', 'url'=>array('admin')),
);
?>

<h1>Cheques</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
