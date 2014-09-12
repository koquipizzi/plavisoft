<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Descripcion',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'tipo_vivienda_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Tipo_Financiacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Importe',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'cant_coutas',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'posicion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'estado_adjudicacion_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tipo_cuota_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
