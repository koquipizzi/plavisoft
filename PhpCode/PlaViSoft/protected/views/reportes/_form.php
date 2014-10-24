<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cheque-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	    
	<?php echo $form->textFieldRow($model,'Nro_cheque',array('disabled'=>'true','class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Cta_cte',array('disabled'=>'true', 'class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'valor',array('disabled'=>'true','class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'pago_id',array('disabled'=>'true','class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NombreTitular',array('disabled'=>'true','class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'banco_id',array('disabled'=>'true','class'=>'span5')); ?>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'banco_id'); ?>
		</div>
		<div class="controls">
			
		<?php	
				if ($model->isNewRecord)				
					echo CHtml::activeDropDownList($model,'banco_id', CHtml::listData(Banco::model()->findAll(), 'id', 'Banco'), array('empty' => '--- Elegir Tipo ---'));
				else {echo CHtml::activeDropDownList($model,'banco_id', CHtml::listData(Banco::model()->findAll(), 'id', 'Banco'), array('disabled'=>'true','empty' => '--- Elegir Tipo ---', 'selected'=>$model->banco_id));
				}
	 ?>	
	 	</div>
	 </div>

	<?php  echo $form->datepickerRow($model,'FechaVencimiento',array('options'=>array(),'htmlOptions'=>array('class'=>'span5','disabled'=>'true')),array('prepend'=>'<i class="icon-calendar"></i>')); ?>

	<?php echo $form->textFieldRow($model,'dadoA',array('class'=>'span5','maxlength'=>255,'required'=>'true')); ?>

	<?php echo $form->datepickerRow($model,'dadoFecha',array('options'=>array('format' => 'dd/mm/yyyy'),'htmlOptions'=>array('class'=>'span5', 'required'=>'true')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'Cliquee en Mes/Año para seleccionar uno diferente.')); ?>

	<?php echo $form->textFieldRow($model,'descripcion',array('class'=>'span5','maxlength'=>255)); ?>

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
