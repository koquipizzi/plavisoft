<?php
/* @var $this PagoController */
/* @var $model Pago */

$this->breadcrumbs=array(
	'Pagos'=>array('index'),
	'Create',
);

/**
 * Personalizando Menu de Creacion de Pago, Si la persona del pago esta seteado entonces actualiza menú
 */
$url = 'admin';
$label = 'Listar Pagos';

if(isset($persona)){
    $label = 'Listar Pagos de '.$persona->nombreCompleto;
    $url .= '&persona_id='.$persona->id;
}

$this->menu=array(
	array('label'=>$label, 'url'=>array($url)),
);
?>

<div class="form">

<h1>Creación de Cuota</h1>

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
                data = jQuery.parseJSON( data );

                $("#agregarChequesDiv").html(data.html);
                $("#cheques_agregados").val(data.cheques_agregados);
                
            },
            'data':{
                'id':id,
                'cheques_agregados':$("#cheques_agregados").val()
            },
            'url':'<?php echo Yii::app()->createAbsoluteUrl('Pago/borrarCheque')?>',
            'cache':false
        });
    }
    
    function valorChange(){
        var valor = $('#valorPago').val();
        
        if(valor==0 || valor == ''){
            alert('Debe ingresar un valor a ser calculado');
            return;
        }
        var suscripcion_id = $('#suscripcion_id').val();
        var tipo_imputacion = $('#imputar_saldo_cuota_siguiente').val();
        jQuery.ajax({
            'type':'POST',
            'async':false,
            'success':function( data ) {
                data = jQuery.parseJSON( data );
                $("#div_cuotas").html(data.html);
            },
            'data':{
                'valor':valor,
                'suscripcion_id':suscripcion_id,
                'tipo_imputacion':tipo_imputacion
            },
            'url':'<?php echo Yii::app()->createAbsoluteUrl('Pago/valorChange')?>',
            'cache':false
        });
    }
    
    function nro_formularioChange(){
        var talonario = $('#talonario').val();
        var nro_formulario = $('#nro_formulario').val();
        if(nro_formulario== ''){
            return;
        }
        jQuery.ajax({
            'type':'POST',
            'async':false,
            'success':function( data ) {
                data = jQuery.parseJSON( data );
                $("#div_formulario_ok").html(data.html);
            },
            'data':{
                'talonario':talonario,
                'nro_formulario':nro_formulario
            },
            'url':'<?php echo Yii::app()->createAbsoluteUrl('Pago/nro_formularioChange')?>',
            'cache':false
        });
    }

</script>    

<style>
    .sectionFix {
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 1px solid;        
        background-color:#ddddff;
        padding:10px;
        opacity: 0.5;
        margin-bottom: 5px;
    }
    .sectionEditable {
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 1px solid;        
        background-color:#ffdddd;
        padding:10px;
        margin-bottom: 5px;
    }
</style> 

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'saldar-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php echo $form->errorSummary($pago); ?>
        
        <!-- **************************************** PERSONA ****************************************** -->
        <div class="sectionFix">        
            <?php 
                if(isset($persona)){
                    echo "Persona: <b>".$persona->nombreCompleto."</b>";
                    echo $form->hiddenField($pago, 'persona_id', array('hidden'=>true,'value'=>$persona->id));
                }
                else{
                    echo "Error, se debe determinar la suscripción";
                }
            ?>
        </div>            
        <!-- *************************************** SUSCRIPCION *************************************** -->      
        <div class="sectionFix">
            <?php 
                if(isset($suscripcion)){
                    echo $form->hiddenField($suscripcion, 'suscripcion_id', array('id'=>'suscripcion_id','value'=>$suscripcion->id));                  
                    echo "Suscripción: <b>".$suscripcion->nombreStr."</b>";
                }
                else{
                    echo "Error, se debe determinar la suscripción";
                }
            ?>
        </div>
        
        <!-- ***************************************** IMPORTE ***************************************** --> 
	<?php 
            // Importe
            if(isset($cuota)){
                echo '<div class="sectionFix">';
                echo $form->hiddenField($pago, 'valor', array('hidden'=>true,'value'=>$cuota->valor));
                echo $form->hiddenField($imputacion, 'cuota_id', array('hidden'=>true,'value'=>$cuota->id));                 
                echo $form->hiddenField($pago, 'ImporteLetras', array('hidden'=>true,'value'=>$cuota->valorLetras));
                echo $form->hiddenField($imputacion, 'valor', array('hidden'=>true,'value'=>$cuota->valor));  
                
                echo "Cuota: ".$cuota->cuotaStr."<br>";
                echo "Valor: ".$cuota->valorStr;
                echo '</div>';
            }
            else{
        ?>
                <div class="sectionEditable">
                    <div class="control-group">
                        <div class="control-label">
                                <?php echo $form->labelEx($pago,'valor'); ?>
                        </div>
                        <div class="controls">
        <?php
                        echo $form->textField(
                                $pago,'valor',
                                array(
                                    'id'=>'valorPago',
                                    
                                    'maxlength'=>10,
                                    'onChange'=>'js:valorChange();',
                                )
                        );
        ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
        <?php
                        echo CHtml::activeDropDownList(
                                $pago, 'imputar_saldo_cuota_siguiente', 
                                CHtml::listData(
                                    array(
                                        array('id'=>1,'Descripcion'=>'Asignar Saldo a Ultima Cuota'),
                                        array('id'=>2,'Descripcion'=>'Asignar Saldo a Próxima Cuota'),
                                    ), 
                                    'id', 'Descripcion'
                                ),
                                array(
                                    'id'=>'imputar_saldo_cuota_siguiente',
                                    'onChange'=>'js:valorChange();',
                                )
                        );
        ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
        <?php
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'link',
                            'type'=>'info',
                            'label'=>'Calcular Cuotas a Saldar',
                            'url'=>'#',
                            'htmlOptions' => array(
                                'onClick'=>'js:valorChange();',
                            ),
                        ));                 
        ?>
                        <div id="div_cuotas"></div>                            
                        </div>                        
                    </div>                                                                        
                </div>                                                
        <?php
            }
        ?>
       
        <!-- ******************************** Talonario y Formulario *********************************** --> 
        <div class="sectionEditable">
            <?php
    //var_dump($ultimoPago);
    //die();
                if( isset($ultimoPago) && $ultimoPago){
            ?>
            <div>
                <div>
                    Ultimo Pago Cargado<br>
                    Número: <?php echo $ultimoPago->nroPagoStr ?><br>
                    Persona: <?php echo $ultimoPago->persona->nombreCompleto ?>
                </div>
            </div>    
            <?php        
                }
            ?>

            <div class="control-group">
                <div class="control-label">
                        <?php echo $form->labelEx($pago,'talonario'); ?>
                </div>
                <div class="controls">
                    <?php	 
                        echo $form->textField(
                                $pago,'talonario',
                                array(
                                    'id'=>'talonario',
                                    'maxlength'=>10
                                )
                        ); 
                    ?>	
                </div>
            </div>
            <div class="control-group">
                <div class="control-label">
                        <?php echo $form->labelEx($pago,'nro_formulario'); ?>
                </div>
                <div class="controls">
                    <?php 
                        echo $form->textField(
                                $pago,'nro_formulario',
                                array(
                                    'id'=>'nro_formulario',
                                    'maxlength'=>10,
                                    'onkeyup'=>'js:nro_formularioChange();',
                                )
                        ); 
                    ?>
                </div>
                <div id="div_formulario_ok"></div>                                    
            </div>
        </div>
        
        
        <!-- ******************************** Fecha de Pago y Descripcion *********************************** --> 
        <div class="sectionEditable">
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
                    <?php echo $form->textAreaRow($pago,'Descripcion',array('class'=>'span5','col'=>3)); ?>
            </div>    
        </div>
        
        <!-- ******************************** Forma de Pago *********************************** -->         
        <div class="control-group">
		<div class="controls_2">            
                        <?php echo $form->checkBoxListRow(
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

        <!-- ******************************** Contado *********************************** -->   
        <div id='valor_div' class="control-group" style="display: none;" >
            <div class="sectionEditable">            
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
        </div>    

        <!-- ******************************** Cheque *********************************** -->  
        <div id='cheque_div' class="control-group" style="display: none;" >
            <div class="sectionEditable">            
                    <h3>Cheque</h3>
                    <?php 
                        echo $form->hiddenField($forma_pago_cheque, 'forma_pago_id', array('hidden'=>true,'value'=>$forma_pago_cheque->forma_pago_id));

                        echo $form->textFieldRow($cheque,'Nro_cheque',array('id'=>'Nro_cheque','size'=>45,'maxlength'=>45));
                        echo $form->error($cheque,'Nro_cheque');
                    ?>
                    <div class="control-group">
                        <div class="control-label">
                            <?php echo $form->labelEx($cheque,'FechaVencimiento'); ?>
                        </div>
                        <div class="controls">
                            <?php 
                                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                    'model' => $cheque,
                                    'attribute' => 'FechaVencimiento',
                                    'name'=>'FechaVencimiento',
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
                            'url'=>$this->createUrl('Pago/agregarCheque'),
                            'ajaxOptions'=>array(
                                'type' => 'POST',
                                'success' => 'function( data ) {
                                    data = jQuery.parseJSON( data );

                                    $("#agregarChequesDiv").html(data.html);
                                    $("#cheques_agregados").val(data.cheques_agregados);

                                    $("#Nro_cheque").val("");
                                    $("#Cta_cte").val("");
                                    $("#valor").val("");
                                    $("#NombreTitular").val("")
                                    $("#banco_id").val("");
                                    $("#FechaVencimiento").val("");
                                  }'
                                ,
                                'data' => array( 
                                    'Nro_cheque' => 'js:$("#Nro_cheque").val()',
                                    'Cta_cte' => 'js:$("#Cta_cte").val()',    
                                    'valor' => 'js:$("#valor").val()',    
                                    'NombreTitular' => 'js:$("#NombreTitular").val()',    
                                    'banco_id' => 'js:$("#banco_id").val()',  
                                    'cheques_agregados' => 'js:$("#cheques_agregados").val()',  
                                    'FechaVencimiento' => 'js:$("#FechaVencimiento").val()',  
                                )
                            ),            
                        ));                 
                    ?>
                    <input type="hidden" id="cheques_agregados" name="cheques_agregados" value="">
                    <div id='agregarChequesDiv'>

                    </div>
            </div>
        </div>

        <!-- ******************************** Deposito *********************************** -->          
        <div id='deposito_div' class="control-group" style="display: none;" >
            <div class="sectionEditable">
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
                    );
                ?>
            </div>
        </div>

        <!-- ******************************** Botones *********************************** -->          
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

</div>

<script>
$( ".sectionFix" ).hover(
    function() {
        $( this ).stop().animate({"opacity": 1});
    }, 
    function() {
        $( this ).stop().animate({"opacity": 0.5});
    }
);                
</script>
