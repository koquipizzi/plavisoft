<?php
/* @var $this GastoController */
/* @var $model Gasto */
/* @var $form CActiveForm */
?>

<div class="form">
    

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gasto-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

        <div class="control-group">
            <div class="control-label">
                    <?php echo $form->labelEx($model,'fecha'); ?>
            </div>
            <div class="controls">
                <?php 
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $model,
                            'attribute' => 'fecha',
                            'name'=>'Fecha',
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
                    <?php echo $form->labelEx($model,'descripcion'); ?>
            </div>
            <div class="controls">
                <?php 
                    echo $form->textField(
                            $model,'descripcion',
                            array(
                                'id'=>'descripcion',
                                'maxlength'=>100,
                            )
                    ); 
                ?>
            </div>
        </div>
    
        <div class="control-group">
            <div class="control-label">
                    <?php echo $form->labelEx($model,'valor'); ?>
            </div>
            <div class="controls">
                <?php 
                    echo $form->textField(
                            $model,'valor',
                            array(
                                'id'=>'descripcion',
                                'maxlength'=>10,
                            )
                    ); 
                ?>
            </div>
        </div>

        <!-- ******************************** Botones *********************************** -->          
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

</div><!-- form -->