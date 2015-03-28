<?php
/* @var $this CrudReviewController */
/* @var $data BaseReview */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TradeID')); ?>:</b>
	<?php echo CHtml::encode($data->TradeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserTo')); ?>:</b>
	<?php echo CHtml::encode($data->UserTo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserFrom')); ?>:</b>
	<?php echo CHtml::encode($data->UserFrom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rating')); ?>:</b>
	<?php echo CHtml::encode($data->Rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Message')); ?>:</b>
	<?php echo CHtml::encode($data->Message); ?>
	<br />


</div>