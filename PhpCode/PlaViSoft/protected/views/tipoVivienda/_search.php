<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Valor',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'MtrosCubiertos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MtrosDescubiertos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CantHabitaciones',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CantPisos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SobreCalle',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Fotos',array('class'=>'span5','maxlength'=>45)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
