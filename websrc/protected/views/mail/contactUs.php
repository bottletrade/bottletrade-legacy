<?php $this->beginContent('/layouts/mail'); ?>
	Contact Us - Automated Email
	<br>
	<br>
	Email:
	<br>
	<?php echo $contactUsForm->email; ?>
	<br>
	<br>
	Message:
	<br>
	<?php echo $contactUsForm->message; ?>
<?php $this->endContent(); ?>