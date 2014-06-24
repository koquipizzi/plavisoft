<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Apellido',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'Nombre',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Domicilio',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'DNI',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'Mail',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'IngresosMensuales',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CantHijos',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FechaAlta',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Borrado',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'Socio',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nota',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'IdSocio',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
