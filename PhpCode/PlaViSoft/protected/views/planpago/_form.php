<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'planpago-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'financiacion_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'financiacion_id', CHtml::listData(Financiacion::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Financiación ---'))
	 ?>	
	 	</div>
	 </div>

	<?php echo $form->textFieldRow($model,'nro_cuota',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mes',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'anio',array('class'=>'span5')); ?>

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
