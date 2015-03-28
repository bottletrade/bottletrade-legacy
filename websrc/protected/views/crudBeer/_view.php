<?php
/* @var $this CrudBeerController */
/* @var $data BaseBeer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BreweryID')); ?>:</b>
	<?php echo CHtml::encode($data->BreweryID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StyleID')); ?>:</b>
	<?php echo CHtml::encode($data->StyleID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ABV')); ?>:</b>
	<?php echo CHtml::encode($data->ABV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IBU')); ?>:</b>
	<?php echo CHtml::encode($data->IBU); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SRM')); ?>:</b>
	<?php echo CHtml::encode($data->SRM); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('UPC')); ?>:</b>
	<?php echo CHtml::encode($data->UPC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Availability')); ?>:</b>
	<?php echo CHtml::encode($data->Availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ImagePath')); ?>:</b>
	<?php echo CHtml::encode($data->ImagePath); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserAdded')); ?>:</b>
	<?php echo CHtml::encode($data->UserAdded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastUpdateTime')); ?>:</b>
	<?php echo CHtml::encode($data->LastUpdateTime); ?>
	<br />

	*/ ?>

</div>