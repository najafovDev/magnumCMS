<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'colors-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->textFieldGroup($model,'rgb',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>6)))); ?>
	<?php echo $form->textFieldGroup($model,'rgb_border',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>6)))); ?>

	<?php // echo $form->textFieldGroup($model,'pic_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
