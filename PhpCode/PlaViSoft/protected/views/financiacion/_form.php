<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'financiacion-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'tipo_vivienda_id',array('class'=>'span5')); ?>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'tipo_vivienda_id'); ?>
		</div>
		<div class="controls">
	<?php	 echo CHtml::activeDropDownList($model,'tipo_vivienda_id', CHtml::listData(TipoViviendA::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Tipo de Vivienda---'))
	 ?>	
	 	</div>
	 </div>

	<?php echo $form->textFieldRow($model,'Tipo_Financiacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cant_cuotas',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'posicion',array('class'=>'span5')); ?>

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
