<?php
/* @var $this CuotaController */
/* @var $model Cuota */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuota-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'suscripcion_id'); ?>
		<?php echo $form->textField($model,'suscripcion_id'); ?>
		<?php echo $form->error($model,'suscripcion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nro_cuota'); ?>
		<?php echo $form->textField($model,'nro_cuota'); ?>
		<?php echo $form->error($model,'nro_cuota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valorLetras'); ?>
		<?php echo $form->textField($model,'valorLetras',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'valorLetras'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mes_id'); ?>
		<?php echo $form->textField($model,'mes_id'); ?>
		<?php echo $form->error($model,'mes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anio'); ?>
		<?php echo $form->textField($model,'anio'); ?>
		<?php echo $form->error($model,'anio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saldada'); ?>
		<?php echo $form->textField($model,'saldada',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'saldada'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->