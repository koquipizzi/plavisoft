<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'adelanto-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'fecha',array('class'=>'span5')); ?>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'Fecha'); ?>
		</div>
		<div class="controls">
		
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model' => $model,
				'attribute' => 'fecha',
			    'name'=>'Fecha Alta',
			    'language' => 'es',
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
			        'dateFormat'=>'dd/mm/yy',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;'
			    ),				
			));
		?>
		</div>
	</div>

	<?php //echo $form->textFieldRow($model,'persona_id',array('class'=>'span5')); ?>
	
	<?php if ($_GET['idpersona']) { ?>
		<?php echo $form->hiddenField($model, 'persona_id', array('hidden'=>true,'value'=>$_GET['idpersona'])); ?>
	<?php }	else { ?>
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'persona_id'); ?>
		</div>
		<div class="controls">
			
		<?php echo CHtml::activeDropDownList($model,'persona_id', CHtml::listData(Persona::model()->findAll(), 'id', 'concate'), array('empty' => '--- Elegir Persona---')); ?>	
	 	</div>
	 </div>
    <?php } ?>

	<?php //echo $form->textFieldRow($model,'forma_pago_id',array('class'=>'span5')); ?>
	
		<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'forma_pago_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'forma_pago_id', CHtml::listData(FormaPago::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Forma de Pago ---'))
	 ?>	
	 	</div>
	</div>

	<?php echo $form->textFieldRow($model,'importe',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'pago_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'adelanto_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'importe_imponible',array('class'=>'span5')); ?>
	

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
