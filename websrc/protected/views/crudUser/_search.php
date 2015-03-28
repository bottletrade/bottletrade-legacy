<?php
/* @var $this CrudUserController */
/* @var $model BaseUser */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Username'); ?>
		<?php echo $form->textField($model,'Username',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Birthday'); ?>
		<?php echo $form->textField($model,'Birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DisplayCity'); ?>
		<?php echo $form->textField($model,'DisplayCity',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'State'); ?>
		<?php echo $form->textField($model,'State',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Zip'); ?>
		<?php echo $form->textField($model,'Zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Links'); ?>
		<?php echo $form->textField($model,'Links',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'About'); ?>
		<?php echo $form->textField($model,'About',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ImagePath'); ?>
		<?php echo $form->textField($model,'ImagePath',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsActive'); ?>
		<?php echo $form->textField($model,'IsActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsPrivate'); ?>
		<?php echo $form->textField($model,'IsPrivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailPreferences'); ?>
		<?php echo $form->textField($model,'EmailPreferences'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ForgotPasswordToken'); ?>
		<?php echo $form->textField($model,'ForgotPasswordToken',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ForgotPasswordTokenExpiration'); ?>
		<?php echo $form->textField($model,'ForgotPasswordTokenExpiration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedTime'); ?>
		<?php echo $form->textField($model,'CreatedTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->