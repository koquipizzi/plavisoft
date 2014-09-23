<?php
/* @var $this CuotaController */
/* @var $model Cuota */

$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuota', 'url'=>array('index')),
	array('label'=>'Manage Cuota', 'url'=>array('admin')),
);
?>

<h1>Create Cuota</h1>

<script>
    function formaPagoChange(check){
        //alert(check.checked);
        var div_comp = null;
        switch(check.value) {
            case "1":
                div_comp = $('#valor_div');
                break;
            case "2":
                div_comp = $('#cheque_div');            
                break;
            case "3":
                div_comp = $('#deposito_div');
                break;
        } 
        
        if(check.checked)
            div_comp.show();
        else{
            div_comp.hide();
            div_comp.value = null;
        }
            
        
    }
    
    function borrarCheque(id){
        jQuery.ajax({
            'type':'POST',
            'success':function( data ) {
                $("#agregarChequesDiv").html(data);
            },
            'data':{
                'id':id,
                'cheques_agregados':$("#cheques_agregados").val()
            },
            'url':'/index.php?r=Cuota/borrarCheque',
            'cache':false
        });
    }
</script>    

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'saldar-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($pago); ?>
        
	<?php 
            echo $form->hiddenField($pago, 'persona_id', array('hidden'=>true,'value'=>$cuota->suscripcion->persona_id)); 
            echo $form->hiddenField($pago, 'valor', array('hidden'=>true,'value'=>$cuota->valor));
            echo $form->hiddenField($pago, 'ImporteLetras', array('hidden'=>true,'value'=>$cuota->valorLetras));
            echo $form->hiddenField($imputacion, 'cuota_id', array('hidden'=>true,'value'=>$cuota->id)); 
            echo $form->hiddenField($imputacion, 'valor', array('hidden'=>true,'value'=>$cuota->valor));  
        ?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($pago,'Fecha Pago'); ?>
		</div>
		<div class="controls">
		
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'model' => $pago,
                            'attribute' => 'FechaPago',
                            'name'=>'Fecha Pago',
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
			<?php echo $form->labelEx($forma_pago_pago,'forma_pago_id'); ?>
		</div>
		<div class="controls">            
                        <?php echo $form->checkBoxList(
                                $forma_pago_pago,
                                'forma_pago_id', 
                                CHtml::listData(FormaPago::model()->findAll(), 'id', 'Descripcion'), 
                                array(
                                    'multiple' => 'true',
                                    'onChange' => 'formaPagoChange(this)',
                                )); 
                        ?>	
		</div>                    
        </div>    

	<div id='valor_div' class="control-group" style="display: none;" >
       		<?php 
                    echo "<h3>Contado</h3>";
                    echo $form->hiddenField($forma_pago_contado, 'forma_pago_id', array('hidden'=>true,'value'=>$forma_pago_contado->forma_pago_id));  
                    echo $form->textFieldRow(
                        $forma_pago_contado,
                        'valor',
                        array('class'=>'span5','maxlength'=>45)
                    );
                ?>
	</div>

	<div id='cheque_div' class="control-group" style="display: none;" >
                <h3>Cheque</h3>
       		<?php 
                    echo $form->hiddenField($forma_pago_cheque, 'forma_pago_id', array('hidden'=>true,'value'=>$forma_pago_cheque->forma_pago_id));

                    echo $form->textFieldRow($cheque,'Nro_cheque',array('id'=>'Nro_cheque','size'=>45,'maxlength'=>45));
                    echo $form->error($cheque,'Nro_cheque');

                    echo $form->textFieldRow($cheque,'Cta_cte',array('id'=>'Cta_cte', 'size'=>45,'maxlength'=>45));
                    echo $form->error($cheque,'Cta_cte');

                    echo $form->textFieldRow($cheque,'valor',array('id'=>'valor', 'size'=>15,'maxlength'=>15));
                    echo $form->error($cheque,'valor');

                    echo $form->textFieldRow($cheque,'NombreTitular',array('id'=>'NombreTitular', 'size'=>60,'maxlength'=>100)); 
                    echo $form->error($cheque,'NombreTitular'); 

                ?>
                <div class="control-group">
                        <div class="control-label">
                                <?php echo $form->labelEx($cheque,'banco_id'); ?>
                        </div>
                        <div class="controls">
                                <?php
                                    echo CHtml::activeDropDownList($cheque,'banco_id', CHtml::listData(Banco::model()->findAll(), 'id', 'Banco'),array('id'=>'banco_id'));
                                    echo $form->error($cheque,'banco_id'); 
                                ?>                            
                        </div>
                 </div>
                
                <?php 
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'ajaxButton',
                        'type'=>'primary',
                        'label'=>'Agregar Cheque',
                        'url'=>$this->createUrl('Cuota/agregarCheque'),
                        'ajaxOptions'=>array(
                            'type' => 'POST',
                            'success' => 'function( data ) {
                                $("#agregarChequesDiv").html(data);
                              }'
                            ,
                            'data' => array( 
                                'Nro_cheque' => 'js:$("#Nro_cheque").val()',
                                'Cta_cte' => 'js:$("#Cta_cte").val()',    
                                'valor' => 'js:$("#valor").val()',    
                                'NombreTitular' => 'js:$("#NombreTitular").val()',    
                                'banco_id' => 'js:$("#banco_id").val()',  
                                'cheques_agregados' => 'js:$("#cheques_agregados").val()',  
                            )
                        ),            
                    ));                 
                ?>
                
                <div id='agregarChequesDiv'>
                    <input type="hidden" id="cheques_agregados" value="">
                </div>
	</div>

	<div id='deposito_div' class="control-group" style="display: none;" >
       		<?php 
                    echo "<h3>Deposito</h3>";
                    echo $form->hiddenField($forma_pago_deposito, 'forma_pago_id', array('hidden'=>true,'value'=>$forma_pago_deposito->forma_pago_id));  
                    echo $form->textFieldRow(
                        $forma_pago_deposito,
                        'valor',
                        array('class'=>'span5','maxlength'=>45)
                    );
                    echo $form->textFieldRow(
                        $pago,
                        'NroDeposito',
                        array('class'=>'span5','maxlength'=>45)
                    );?>
	</div>
            

        <div class="control-group">
                <?php echo $form->textAreaRow($pago,'Descripcion',array('class'=>'span5','col'=>3)); ?>
        </div>    


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Crear',
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Limpiar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
