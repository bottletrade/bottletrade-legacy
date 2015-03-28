<?php
/* @var $this CrudReviewController */
/* @var $model BaseReview */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'base-review-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TradeID'); ?>
		<?php echo $form->textField($model,'TradeID'); ?>
		<?php echo $form->error($model,'TradeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserTo'); ?>
		<?php echo $form->textField($model,'UserTo'); ?>
		<?php echo $form->error($model,'UserTo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserFrom'); ?>
		<?php echo $form->textField($model,'UserFrom'); ?>
		<?php echo $form->error($model,'UserFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating'); ?>
		<?php echo $form->error($model,'Rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Message'); ?>
		<?php echo $form->textField($model,'Message',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'Message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->