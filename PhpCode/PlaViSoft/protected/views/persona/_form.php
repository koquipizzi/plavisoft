<?php 
	Yii::app()->clientScript->registerCoreScript('jquery');

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Apellido',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'DNI',array('class'=>'span5','maxlength'=>10)); ?>
        
	<?php echo $form->textFieldRow($model,'CUIT1',array('class'=>'span5','maxlength'=>15)); ?>        
        
	<?php echo $form->textFieldRow($model,'Apellido2',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Nombre2',array('class'=>'span5','maxlength'=>45)); ?>
        
	<?php echo $form->textFieldRow($model,'DNI2',array('class'=>'span5','maxlength'=>10)); ?>        
        
	<?php echo $form->textFieldRow($model,'CUIT2',array('class'=>'span5','maxlength'=>15)); ?>                

	<?php echo $form->textFieldRow($model,'Domicilio',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Mail',array('class'=>'span5','maxlength'=>45, 'prepend'=>'@')); ?>
	
	<?php echo $form->textFieldRow($model,'Telefono',array('class'=>'span5','maxlength'=>45, 'prepend'=>'@')); ?>
	
	<?php echo $form->textFieldRow($model,'TelefonoCelular',array('class'=>'span5','maxlength'=>45, 'prepend'=>'@')); ?>

	<?php echo $form->textFieldRow($model,'IngresosMensuales',array('class'=>'span5', 'prepend'=>'$')); ?>

	<?php echo $form->textFieldRow($model,'CantHijos',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'FechaAlta',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'Borrado',array('class'=>'span5','maxlength'=>45)); ?>

	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'tipo_persona_id'); ?>
		</div>
		<div class="controls">
			
		<?php	
				if ($model->isNewRecord)				
					echo CHtml::activeDropDownList($model,'tipo_persona_id', CHtml::listData(TipoPersona::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Tipo ---'));
				else {echo CHtml::activeDropDownList($model,'tipo_persona_id', CHtml::listData(TipoPersona::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Tipo ---', 'selected'=>$model->tipo_persona_id));
				}
	 ?>	
	 	</div>
	 </div>

	<?php echo $form->textFieldRow($model,'IdSocio',array('class'=>'span5')); ?>
	
	<?php echo $form->textAreaRow($model,'Nota', array('class'=>'span5', 'rows'=>3)); ?>

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

<script>
	$('#Persona_IdSocio').closest('.control-group').hide();
	$('#Persona_tipo_persona_id').change(function() {
		var a = $(this).closest('.control-group').next();
		if (this.selectedIndex == 1)
			$(a).show();
		else $(a).hide();
	});
	
	<?php 
		if ($model->isNewRecord == FALSE)
			{ ?>	<script>
				$('#Persona_IdSocio').closest('.control-group').show();
				</script>		
	<?php	} ?>
</script>
