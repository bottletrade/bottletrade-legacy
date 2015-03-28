<?php
/* @var $this CrudBeerController */
/* @var $model BaseBeer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'base-beer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'BreweryID'); ?>
		<?php echo $form->textField($model,'BreweryID'); ?>
		<?php echo $form->error($model,'BreweryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID'); ?>
		<?php echo $form->error($model,'StyleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ABV'); ?>
		<?php echo $form->textField($model,'ABV'); ?>
		<?php echo $form->error($model,'ABV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IBU'); ?>
		<?php echo $form->textField($model,'IBU'); ?>
		<?php echo $form->error($model,'IBU'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SRM'); ?>
		<?php echo $form->textField($model,'SRM'); ?>
		<?php echo $form->error($model,'SRM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UPC'); ?>
		<?php echo $form->textField($model,'UPC'); ?>
		<?php echo $form->error($model,'UPC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Availability'); ?>
		<?php echo $form->textField($model,'Availability',array('size'=>60,'maxlength'=>63)); ?>
		<?php echo $form->error($model,'Availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImagePath'); ?>
		<?php echo $form->textField($model,'ImagePath',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ImagePath'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserAdded'); ?>
		<?php echo $form->textField($model,'UserAdded'); ?>
		<?php echo $form->error($model,'UserAdded'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreatedTime'); ?>
		<?php echo $form->textField($model,'CreatedTime'); ?>
		<?php echo $form->error($model,'CreatedTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastUpdateTime'); ?>
		<?php echo $form->textField($model,'LastUpdateTime'); ?>
		<?php echo $form->error($model,'LastUpdateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->