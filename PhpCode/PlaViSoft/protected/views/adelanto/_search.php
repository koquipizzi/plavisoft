<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'persona_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'forma_pago_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'importe',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pago_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'adelanto_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'importe_imponible',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
