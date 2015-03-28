<?php
/* @var $this CrudUserController */
/* @var $data BaseUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Username')); ?>:</b>
	<?php echo CHtml::encode($data->Username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Birthday')); ?>:</b>
	<?php echo CHtml::encode($data->Birthday); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('City')); ?>:</b>
	<?php echo CHtml::encode($data->City); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DisplayCity')); ?>:</b>
	<?php echo CHtml::encode($data->DisplayCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
	<?php echo CHtml::encode($data->State); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Country')); ?>:</b>
	<?php echo CHtml::encode($data->Country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Zip')); ?>:</b>
	<?php echo CHtml::encode($data->Zip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Links')); ?>:</b>
	<?php echo CHtml::encode($data->Links); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('About')); ?>:</b>
	<?php echo CHtml::encode($data->About); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ImagePath')); ?>:</b>
	<?php echo CHtml::encode($data->ImagePath); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsPrivate')); ?>:</b>
	<?php echo CHtml::encode($data->IsPrivate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailPreferences')); ?>:</b>
	<?php echo CHtml::encode($data->EmailPreferences); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ForgotPasswordToken')); ?>:</b>
	<?php echo CHtml::encode($data->ForgotPasswordToken); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ForgotPasswordTokenExpiration')); ?>:</b>
	<?php echo CHtml::encode($data->ForgotPasswordTokenExpiration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedTime')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedTime); ?>
	<br />

	*/ ?>

</div>