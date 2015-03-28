<?php
    $this->pageTitle=Yii::app()->name . ' - Forgot Password';
?>
<?php if ($showChangePassword): ?>
	<?php $forgotPasswordFormWidget=$this->beginWidget('CActiveForm', array(
	    'id'=>'forgotpassword-form',
	    'enableClientValidation'=>true
	)); ?>
	<?php echo $forgotPasswordFormWidget->hiddenField($forgotPasswordForm,'email'); ?>
	
<div class="forgot-password-prompt">
	<table align="center">
		<tr>
			<td align="right" valign="top">
				<?php echo $forgotPasswordFormWidget->labelEx($forgotPasswordForm,'newPassword'); ?>
			</td>
			<td>	
				<?php echo $forgotPasswordFormWidget->passwordField($forgotPasswordForm,'newPassword'); ?>
				<?php echo $forgotPasswordFormWidget->error($forgotPasswordForm,'newPassword'); ?>
			</td>
		</tr>
		<tr>
			<td align="right" valign="top">
				<?php echo $forgotPasswordFormWidget->labelEx($forgotPasswordForm,'confirmPassword'); ?>
			</td>
			<td>
				<?php echo $forgotPasswordFormWidget->passwordField($forgotPasswordForm,'confirmPassword'); ?>
				<?php echo $forgotPasswordFormWidget->error($forgotPasswordForm,'confirmPassword'); ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;
			</td>
			<td>
				<?php echo CHtml::submitButton('Submit', array('class'=>'medium')); ?>
			</td>
		</tr>	
	</table>	
</div>	
		
	<?php $this->endWidget(); ?>
	<!-- form -->
<?php else: ?>
<?php $forgotPasswordFormWidget=$this->beginWidget('CActiveForm', array(
	    'id'=>'forgotpassword-form',
	    'enableClientValidation'=>true
	)); ?>
	
<div class="forgot-password-prompt">
	<table align="center">
		<tr>
			<td colspan="2" align="center" valign="top">
				<span class="black">Forgot your password? Not a problem!<br>Submit your email address below<br>to reset your password.</span>
			</td>
		</tr>
		<tr>
			<td align="right" valign="top">
				<?php echo $forgotPasswordFormWidget->labelEx($forgotPasswordForm,'email'); ?>
			</td>
			<td>
				<?php echo $forgotPasswordFormWidget->textField($forgotPasswordForm,'email'); ?>
				<?php echo $forgotPasswordFormWidget->error($forgotPasswordForm,'email'); ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;
			</td>
			<td>
				<?php echo CHtml::submitButton('Submit', array('class'=>'medium')); ?>
			</td>
		</tr>	
	</table>	
</div>
	<?php $this->endWidget(); ?>
<!-- form -->
<?php endif; ?>


