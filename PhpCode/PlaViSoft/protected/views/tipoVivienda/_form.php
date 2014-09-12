<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tipo-vivienda-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Valor',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'MtrosCubiertos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MtrosDescubiertos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CantHabitaciones',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CantPisos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SobreCalle',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Fotos',array('class'=>'span5','maxlength'=>45)); ?>

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
