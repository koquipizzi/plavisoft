<?php
/* @var $this GastoController */
/* @var $model Gasto */
/* @var $form CActiveForm */


    Yii::app()->clientScript->registerScript('AjaxRequest', "
        function AjaxCategoriaChange(){
            jQuery('#div_error_categorias_grid').html(' ');
            jQuery.ajax({
                'type':'POST',
                'async':false,
                'dataType':'JSON',
                'success':function( data ) {
                    //data = jQuery.parseJSON( data );
                    if(data.error == false){
                        jQuery('#div_categorias_grid').html(data.html);
                        jQuery('#categorias_ids').val(data.categorias_ids);  
                        jQuery('#categoria_id').val('');
                    }
                    else{
                        jQuery('#div_error_categorias_grid').html(data.html);
                    }
                },
                'data':{
                    'id':jQuery('#categoria_id').val(),
                    'categorias_ids':jQuery('#categorias_ids').val(),
                },
                'url':'".Yii::app()->createAbsoluteUrl('Gasto/ajaxCategoriaChange')."',
                'cache':false
            });
        }
    ",CClientScript::POS_HEAD);               

    Yii::app()->clientScript->registerScript('AjaxRequestDelete', "
        jQuery('#div_error_categorias_grid').html(' ');
        function AjaxCategoriaDelete(id){
            jQuery.ajax({
                'type':'POST',
                'async':false,
                'dataType':'JSON',
                'success':function( data ) {
                    //data = jQuery.parseJSON( data );
                    if(data.error == false){
                        jQuery('#div_categorias_grid').html(data.html);
                        jQuery('#categorias_ids').val(data.categorias_ids);                    
                    }
                    else{
                        jQuery('#div_error_categorias_grid').html(data.html);
                    }
                },
                'data':{
                    'id':id,
                    'categorias_ids':jQuery('#categorias_ids').val(),
                },
                'url':'".Yii::app()->createAbsoluteUrl('Gasto/ajaxCategoriaDelete')."',
                'cache':false
            });
        }
    ",CClientScript::POS_HEAD);               

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
                                'id'=>'valor',
                                'maxlength'=>20,
                            )
                    ); 
                ?>
            </div>
        </div>
    
        <div class="control-group">
            <div class="control-label">
                    <?php echo $form->labelEx($model,'nroFormulario'); ?>
            </div>
            <div class="controls">
                <?php 
                    echo $form->textField(
                            $model,'nroFormulario',
                            array(
                                'id'=>'nroFormulario',
                                'maxlength'=>45,
                            )
                    ); 
                ?>
            </div>
        </div>
    
        <div class="control-group">
                <?php echo $form->textAreaRow($model,'nota',array('class'=>'span5','col'=>3)); ?>
        </div>    

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($gastoCategoria,'descripcion'); ?>
		</div>
		<div class="controls">
		<?php	 
                    echo CHtml::hiddenField('categorias_ids', $categorias_ids, array ( 'id'=>'categorias_ids' ));
                    
                    echo CHtml::activeDropDownList(
                        $gastoCategoria,
                        'id', 
                        CHtml::listData(GastoCategorias::model()->findAll(), 'id', 'descripcion'), 
                        array('empty' => '--- Elegir Categoría ---','id'=>'categoria_id')
                    );
                    
                    Yii::app()->clientScript->registerScript('categoria_id', "
                        jQuery('#categoria_id').change(function(){
                            AjaxCategoriaChange();
                        });
                    ");                    
                ?>	
	 	</div>
                <div id="div_error_categorias_grid"></div>
        </div>    
        <div id="div_categorias_grid">
            <?php
                $this->renderPartial(
                    'ajaxCategoriaChange',
                    array(
                        'categorias'=>$categorias,
                        'borrarEnabled'=>TRUE,
                    )
                );
            ?>
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