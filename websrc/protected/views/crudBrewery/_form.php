<?php
/* @var $this CrudBreweryController */
/* @var $model BaseBrewery */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'base-brewery-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address1'); ?>
		<?php echo $form->textField($model,'Address1',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Address1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address2'); ?>
		<?php echo $form->textField($model,'Address2',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Address2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'State'); ?>
		<?php echo $form->textField($model,'State',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'State'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Code'); ?>
		<?php echo $form->textField($model,'Code',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'Code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'Country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Phone'); ?>
		<?php echo $form->textField($model,'Phone',array('size'=>48,'maxlength'=>48)); ?>
		<?php echo $form->error($model,'Phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Established'); ?>
		<?php echo $form->textField($model,'Established'); ?>
		<?php echo $form->error($model,'Established'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Website'); ?>
		<?php echo $form->textField($model,'Website',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Website'); ?>
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