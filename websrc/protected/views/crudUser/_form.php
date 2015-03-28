<?php
/* @var $this CrudUserController */
/* @var $model BaseUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'base-user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'Password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'FirstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'LastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Birthday'); ?>
		<?php echo $form->textField($model,'Birthday'); ?>
		<?php echo $form->error($model,'Birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DisplayCity'); ?>
		<?php echo $form->textField($model,'DisplayCity',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'DisplayCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'State'); ?>
		<?php echo $form->textField($model,'State',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'State'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Zip'); ?>
		<?php echo $form->textField($model,'Zip'); ?>
		<?php echo $form->error($model,'Zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Links'); ?>
		<?php echo $form->textField($model,'Links',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'Links'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'About'); ?>
		<?php echo $form->textField($model,'About',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'About'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ImagePath'); ?>
		<?php echo $form->textField($model,'ImagePath',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ImagePath'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsActive'); ?>
		<?php echo $form->textField($model,'IsActive'); ?>
		<?php echo $form->error($model,'IsActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsPrivate'); ?>
		<?php echo $form->textField($model,'IsPrivate'); ?>
		<?php echo $form->error($model,'IsPrivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EmailPreferences'); ?>
		<?php echo $form->textField($model,'EmailPreferences'); ?>
		<?php echo $form->error($model,'EmailPreferences'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ForgotPasswordToken'); ?>
		<?php echo $form->textField($model,'ForgotPasswordToken',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'ForgotPasswordToken'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ForgotPasswordTokenExpiration'); ?>
		<?php echo $form->textField($model,'ForgotPasswordTokenExpiration'); ?>
		<?php echo $form->error($model,'ForgotPasswordTokenExpiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreatedTime'); ?>
		<?php echo $form->textField($model,'CreatedTime'); ?>
		<?php echo $form->error($model,'CreatedTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->