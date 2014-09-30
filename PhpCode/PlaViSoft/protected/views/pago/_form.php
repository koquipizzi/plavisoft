<?php
/* @var $this PagoController */
/* @var $model Pago */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pago-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FechaPago'); ?>
		<?php echo $form->textField($model,'FechaPago'); ?>
		<?php echo $form->error($model,'FechaPago'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImporteLetras'); ?>
		<?php echo $form->textField($model,'ImporteLetras',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ImporteLetras'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Descripcion'); ?>
		<?php echo $form->textField($model,'Descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NroDeposito'); ?>
		<?php echo $form->textField($model,'NroDeposito',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NroDeposito'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'persona_id'); ?>
		<?php echo $form->textField($model,'persona_id'); ?>
		<?php echo $form->error($model,'persona_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'talonario'); ?>
		<?php echo $form->textField($model,'talonario',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'talonario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nro_formulario'); ?>
		<?php echo $form->textField($model,'nro_formulario',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'nro_formulario'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->