<?php $this->beginContent('/layouts/mail'); ?>
	Thank you for contacting us.<br /><br />
	Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountForgotPasswordUri, "?email=".$user->Email."&token=".urlencode($user->ForgotPasswordToken)); ?>">here</a> to reset your password.
<?php $this->endContent(); ?>