<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FechaAlta',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Activo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'persona_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Borrado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'financiacion_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nota',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Adjudicado',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
