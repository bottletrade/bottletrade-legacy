<?php
/* @var $this CrudBeerController */
/* @var $model BaseBeer */
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
		<?php echo $form->label($model,'BreweryID'); ?>
		<?php echo $form->textField($model,'BreweryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ABV'); ?>
		<?php echo $form->textField($model,'ABV'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IBU'); ?>
		<?php echo $form->textField($model,'IBU'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SRM'); ?>
		<?php echo $form->textField($model,'SRM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UPC'); ?>
		<?php echo $form->textField($model,'UPC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Availability'); ?>
		<?php echo $form->textField($model,'Availability',array('size'=>60,'maxlength'=>63)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ImagePath'); ?>
		<?php echo $form->textField($model,'ImagePath',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserAdded'); ?>
		<?php echo $form->textField($model,'UserAdded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedTime'); ?>
		<?php echo $form->textField($model,'CreatedTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastUpdateTime'); ?>
		<?php echo $form->textField($model,'LastUpdateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->