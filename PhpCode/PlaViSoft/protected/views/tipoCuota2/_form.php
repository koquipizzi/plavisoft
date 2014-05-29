<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tipo-cuota-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Importe',array('class'=>'span5')); ?>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'Adjudicado'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'Adjudicado', CHtml::listData(EstadoAdjudicacion::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Estado ---'))
	 ?>	
	 	</div>
	 </div>

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
