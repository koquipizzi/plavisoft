<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'financiacion_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'nro_cuota',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mes',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'anio',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
