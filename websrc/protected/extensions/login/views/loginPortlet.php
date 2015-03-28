
<div class="form">
<?php echo CHtml::form(); ?>
<p class="pad">
Username:<br>
<?php echo CHtml::activeTextField($user,'username'); echo CHtml::error($user,'username');?><br>
Password:<br>
<?php echo CHtml::activePasswordField($user,'password'); echo CHtml::error($user,'password'); ?><br>
<?php /*if($this->enableRememberMe)
	{
		echo CHtml::activeCheckBox($user,'rememberMe')." Remember me next time<br>";
	}
<a href="<?php echo UrlUtils::generateUrl("account/forgotPassword"); ?>">Forgot Password (No Beta)</a><br>
*/ 
?>
<?php echo CHtml::submitButton('Login', array('class'=>'small')); ?>
</p>
<?php echo CHtml::endForm(); ?>
</div>