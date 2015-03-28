<?php
/* @var $this CrudBeerCategoryController */
/* @var $data BaseBeerCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastUpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->LastUpdateTime); ?>
	<br />


</div>