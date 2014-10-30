<?php 

    Yii::app()->clientScript->registerScript('AjaxRequest', "
        function AjaxNroChange(){
            jQuery.ajax({
                'type':'POST',
                'async':false,
                'success':function( data ) {
                    data = jQuery.parseJSON( data );
                    jQuery('#div_nro_suscripcion').html(data.html);
                    if(data.error==true){
                        jQuery('#nro_suscripcion').focus();                            
                    }    
                },
                'data':{
                    'numero':jQuery('#nro_suscripcion').val(),
                    'financiacion':jQuery('#financiacion_id').val(),
                },
                'url':'".Yii::app()->createAbsoluteUrl('Suscripcion/numeroChange')."',
                'cache':false
            });
        }
    ");                    


    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'suscripcion-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($model); ?>
        
	<?php 
            if (isset($model->persona_id)) { 
                echo $form->hiddenField($model, 'persona_id', array('hidden'=>true,'value'=>$model->persona_id)); 
            }	
            else { 
        ?>
	<div class="control-group">
		<div class="control-label">
                    <?php echo $form->labelEx($model,'persona_id'); ?>
		</div>
		<div class="controls">
                    <?php echo CHtml::activeDropDownList($model,'persona_id', CHtml::listData(Persona::model()->findAll(), 'id', 'nombreDNI'), array('empty' => '--- Elegir Persona---')); ?>	
	 	</div>
	 </div>
        <?php 
            } 
        ?>
        

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

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'financiacion_id'); ?>
		</div>
		<div class="controls">
		<?php	 
                    echo CHtml::activeDropDownList(
                        $model,
                        'financiacion_id', 
                        CHtml::listData($financiacion, 'id', 'Descripcion'), 
                        array('empty' => '--- Elegir Financiación ---','id'=>'financiacion_id')
                    );
                    
                    Yii::app()->clientScript->registerScript('financiacion_id', "
                        jQuery('#financiacion_id').change(function(){
                            AjaxNroChange();
                        });
                    ");                    
                    
                ?>	
	 	</div>
	 </div>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'numero'); ?>
		</div>
		<div class="controls">
		<?php	 
                    echo $form->textField($model,'numero',array('id'=>'nro_suscripcion'));
                    Yii::app()->clientScript->registerScript('nro_suscripcion', "
                        jQuery('#nro_suscripcion').keyup(function(event){
                            AjaxNroChange();
                        });
                    ");                    
                ?>	
	 	</div>
                <div id="div_nro_suscripcion"></div>            
	 </div>


	<div class="control-group">
		<div class="control-label">
                    <?php echo 'Mes'; ?>
		</div>
		<div class="controls">
                    <?php echo CHtml::activeDropDownList($model,'mes', CHtml::listData(Mes::model()->findAll(), 'id', 'mes')); ?>	
	 	</div>
	 </div>

	<div class="control-group">
		<div class="control-label">
                    <?php echo 'Año'; ?>
		</div>
		<div class="controls">
                    <?php echo CHtml::activeDropDownList($model,'anio', CHtml::listData($anio, 'id', 'Anio')); ?>	
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
