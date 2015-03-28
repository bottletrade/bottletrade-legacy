<?php
/* @var $this CrudBreweryController */
/* @var $data BaseBrewery */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address1')); ?>:</b>
	<?php echo CHtml::encode($data->Address1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address2')); ?>:</b>
	<?php echo CHtml::encode($data->Address2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('City')); ?>:</b>
	<?php echo CHtml::encode($data->City); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
	<?php echo CHtml::encode($data->State); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Code')); ?>:</b>
	<?php echo CHtml::encode($data->Code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Country')); ?>:</b>
	<?php echo CHtml::encode($data->Country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Phone')); ?>:</b>
	<?php echo CHtml::encode($data->Phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Established')); ?>:</b>
	<?php echo CHtml::encode($data->Established); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Website')); ?>:</b>
	<?php echo CHtml::encode($data->Website); ?>
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