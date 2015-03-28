<?php
/* @var $this CrudReviewController */
/* @var $model BaseReview */
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
		<?php echo $form->label($model,'TradeID'); ?>
		<?php echo $form->textField($model,'TradeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserTo'); ?>
		<?php echo $form->textField($model,'UserTo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserFrom'); ?>
		<?php echo $form->textField($model,'UserFrom'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rating'); ?>
		<?php echo $form->textField($model,'Rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Message'); ?>
		<?php echo $form->textField($model,'Message',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->