<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FechaPago',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FormaPago',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'NroCuota',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'suscripcion_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'financiacion_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Pagado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NroDeposito',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'forma_pago_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Importe',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Anio',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Mes',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
