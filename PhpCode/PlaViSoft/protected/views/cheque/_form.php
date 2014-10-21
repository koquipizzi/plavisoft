<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cheque-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Nro_cheque',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Cta_cte',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'valor',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'pago_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NombreTitular',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'banco_id',array('class'=>'span5')); ?>

	<?php echo $form->datepickerRow($model,'FechaVencimiento',array('options'=>array(),'htmlOptions'=>array('class'=>'span5')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'Cliquee en Mes/Año para seleccionar mes o año diferente.')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Limpiar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
