<?php
/* @var $this ChequeController */
/* @var $model Cheque */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cheque-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Nro_cheque'); ?>
		<?php echo $form->textField($model,'Nro_cheque',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Nro_cheque'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Cta_cte'); ?>
		<?php echo $form->textField($model,'Cta_cte',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Cta_cte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pago_id'); ?>
		<?php echo $form->textField($model,'pago_id'); ?>
		<?php echo $form->error($model,'pago_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NombreTitular'); ?>
		<?php echo $form->textField($model,'NombreTitular',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'NombreTitular'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'banco_id'); ?>
		<?php echo $form->textField($model,'banco_id'); ?>
		<?php echo $form->error($model,'banco_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->