<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'financiacion-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'tipo_vivienda_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'tipo_vivienda_id', CHtml::listData(TipoVivienda::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Tipo Vivienda ---'))
	 ?>	
	 	</div>
	 </div>
	 
	 <?php echo $form->textFieldRow($model,'Tipo_Financiacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Importe',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'cant_coutas',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'posicion',array('class'=>'span5')); ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'estado_adjudicacion_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'estado_adjudicacion_id', CHtml::listData(EstadoAdjudicacion::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Estado ---'))
	 ?>	
	 	</div>
	 </div>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'tipo_cuota_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'tipo_cuota_id', CHtml::listData(TipoCuota::model()->findAll(), 'Tipo', 'Tipo'), array('empty' => '--- Elegir Tipo Cuota ---'))
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
