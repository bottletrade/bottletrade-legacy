<?php
/* @var $this CrudBreweryController */
/* @var $model BaseBrewery */
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
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address1'); ?>
		<?php echo $form->textField($model,'Address1',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address2'); ?>
		<?php echo $form->textField($model,'Address2',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'State'); ?>
		<?php echo $form->textField($model,'State',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Code'); ?>
		<?php echo $form->textField($model,'Code',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Phone'); ?>
		<?php echo $form->textField($model,'Phone',array('size'=>48,'maxlength'=>48)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Established'); ?>
		<?php echo $form->textField($model,'Established'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Website'); ?>
		<?php echo $form->textField($model,'Website',array('size'=>60,'maxlength'=>255)); ?>
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