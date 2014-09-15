<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'suscripcion-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

			
	
	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'Fecha Alta'); ?>
		</div>
		<div class="controls">
		
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $model,
                            'attribute' => 'FechaAlta',
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

	<?php 
            //echo $form->dropDownListRow($model,'Activo', array('0' => 'No','1' => 'Si')); 
        ?>
	
	<?php 
            if (array_key_exists('idpersona',$_GET)&& isset($_GET['idpersona'])) { 
                echo $form->hiddenField($model, 'persona_id', array('hidden'=>true,'value'=>$_GET['idpersona'])); 
            }	
            else { ?>
	<div class="control-group">
		<div class="control-label">
                    <?php echo $form->labelEx($model,'persona_id'); ?>
		</div>
		<div class="controls">
                    <?php echo CHtml::activeDropDownList($model,'persona_id', CHtml::listData(Persona::model()->findAll(), 'id', 'nombreDNI'), array('empty' => '--- Elegir Persona---')); ?>	
	 	</div>
	 </div>
    <?php } ?>
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'financiacion_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'financiacion_id', CHtml::listData(Financiacion::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Financiación ---'))
	 ?>	
	 	</div>
	 </div>
	
	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'estado_adjudicacion_id'); ?>
		</div>
		<div class="controls">
		<?php	 echo CHtml::activeDropDownList($model,'estado_adjudicacion_id', CHtml::listData(EstadoAdjudicacion::model()->findAll(), 'id', 'Descripcion'), array('empty' => '--- Elegir Estado ---'))
	 ?>	
	 	</div>
	 </div>
	
	<?php echo $form->textAreaRow($model,'Nota',array('class'=>'span5','col'=>3)); ?>


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
