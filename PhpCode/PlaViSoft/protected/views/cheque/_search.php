<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nro_cheque',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Cta_cte',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'valor',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'pago_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'NombreTitular',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'banco_id',array('class'=>'span5')); ?>

	<?php echo $form->datepickerRow($model,'FechaVencimiento',array('options'=>array(),'htmlOptions'=>array('class'=>'span5')),array('prepend'=>'<i class="icon-calendar"></i>','append'=>'Click on Month/Year at top to select a different year or type in (mm/dd/yyyy).')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
