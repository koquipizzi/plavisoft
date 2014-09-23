<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pago-form',
	'type'=>'horizontal',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); 
	
	$model->financiacion_id= $_GET['financiacion'];
	$model->suscripcion_id= $_GET['suscripcion'];
	
    echo $form->hiddenField($model,'financiacion_id',array('type'=>"hidden"));
	echo $form->hiddenField($model,'suscripcion_id',array('type'=>"hidden"));	
	
	
//	var_dump($model->suscripcion_id); die();
	$f = $_GET['financiacion'];
	$s = $_GET['suscripcion'];
	
	?>

	<div class="control-group">
		<div class="control-label">
			<?php echo $form->labelEx($model,'Fecha Pago'); ?>
		</div>
		<div class="controls">
		
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model' => $model,
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
			<?php echo $form->labelEx($model,'planpago_id'); ?>
		</div>
		<div class="controls">
		<?php //var_dump( $model->getCuotas($f,$s)); die();	 
		echo CHtml::activeDropDownList($model,'planpago_id', CHtml::listData($model->getCuotas($f,$s), 'id', 'mess'));

	 ?>	
	 	</div>
	 </div>

	<?php echo $form->textFieldRow($model,'NroDeposito',array('class'=>'span5')); ?>

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

	<?php //echo $form->textFieldRow($model,'Importe',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>100)); ?>

	<?php //echo $form->textFieldRow($model,'Anio',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'Mes',array('class'=>'span5')); ?>
	
	<?php  

//$rawData=Yii::app()->db->createCommand('SELECT * FROM adelanto where persona_id ')->queryAll();
// or using: $rawData=User::model()->findAll();
$rawData = $model->adelantos();
if (count($rawData) <> 0 ){
$dataProvider=new CArrayDataProvider($rawData, array(
    'id'=>'id',
    'sort'=>array(
        'attributes'=>array(
             'id', 'perosna_id', 'importe','importe_imputado'
        ),
    ),
    'pagination'=>array(
        'pageSize'=>10,
    ),
)); 	
//var_dump($dataProvider->data[0]["id"]);
	//var_dump($dataProvider);
	//die();
	$this->widget('bootstrap.widgets.TbGridView',array(
            'type'=>'striped bordered condensed',
            'id'=>'user-grid',            
            'dataProvider'=> $dataProvider,
        //    'template'=>"{items}\n{pager}",
       
            'columns'=>array(array(
            'class'=>'CCheckBoxColumn', // И ЭТО ВСЕ ТОЖЕ ВАЖНО
            'id'=>'adelantos', // И ЭТО ВСЕ ТОЖЕ ВАЖНО
        ),        
              //  'id',
           	   'fecha',
           	   'importe',
                'id',
            ),
       ));
	   
	//   $this->endWidget();
	    
}   
	    ?>


	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'url'=>'index.php?r=suscripcion/view&id='.$model->suscripcion->id,
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Guardar' : 'Guardar',
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Limpiar',
		)); ?>
	</div>

<?php    $this->endWidget(); ?>
