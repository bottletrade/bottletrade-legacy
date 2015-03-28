<?php
$this->pageTitle=Yii::app()->name . ' - Register Your Profile on the BottleTrade Network';
?>
<?php $loginFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'login-form',
                                                    'enableClientValidation'=>true,
                                                    'clientOptions'=>array(
                                                      	'validateOnSubmit'=>true,
														'validateOnType'=>false,
														'validateOnChange'=>false,
														'afterValidate'=>'js:function(form, data, hasError) {
															if (hasError) {
                                                    			$("#loginInProgress").hide();
                                                    		}
                                                    		return !hasError;
														}',
                                                    ),
                                                    )); ?>
<div style="width:942px; background-image:url(<?php echo UrlUtils::generateImageUrl("login/r1_background.png"); ?>); background-repeat:no-repeat; text-align: center;">
	<div style="width: 250px; height: auto; padding-top: 130px; margin-left:auto; margin-right:auto;">
		<table width="220">
  			<tr>
    			<td align="right" valign="top">
    			<span class="text_field_prompt">Username:</span></td>
    			<td><?php echo $loginFormWidget->textField($loginForm,'username'); ?>
    				<?php echo $loginFormWidget->error($loginForm,'username'); ?></td>
  			</tr>
  			<tr>
    			<td align="right" valign="top"><span class="text_field_prompt">Password:</span></td>
    			<td><?php echo $loginFormWidget->passwordField($loginForm,'password'); ?>
    				<?php echo $loginFormWidget->error($loginForm,'password'); ?></td>
  			</tr>
 			<tr>
    			<td colspan="2" align="center"><a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountForgotPasswordUri); ?>">Forgot Password</a></td>
  			</tr>
 			 <tr>
    			<td colspan="2" align="center">
    			<button class="medium" type="submit">LOGIN</button>
  			</tr>
  			<tr>
  				<td colspan="2" align="center"><img id="loginInProgress" style="display: none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img></td>
  			</tr>
		</table>
	</div>
</div>
<?php $this->endWidget(); ?>
<div><img src="<?php echo UrlUtils::generateImageUrl("login/divide.png"); ?>" width="942" height="12"></div>
<div style="width:942px; height: 261px; background-image:url(<?php echo UrlUtils::generateImageUrl("login/r2_background.png"); ?>); background-repeat:no-repeat;">
	<div class="form">
		<div style="width: 335px; float: right; margin-right: 50px;">
			<?php $newUserFormWidget=$this->beginWidget('CActiveForm', array(
    			'id'=>'newuser-form',
    			'enableClientValidation'=>true,
    			'clientOptions'=>array(
        			'validateOnSubmit'=>true,
					'validateOnType'=>false,
					'validateOnChange'=>false,
					'afterValidate'=>'js:function(form, data, hasError) {
										if (hasError) {
                                       		$("#createProfileInProgress").hide();
                                        }
                                        return !hasError;
									}',
   				 ),
				)); 
			?>
<table class="create-profile">
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'firstname'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->textField($newUserForm,'firstname'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'firstname'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'lastname'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->textField($newUserForm,'lastname'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'lastname'); ?>
		</td>
	</tr>	
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'email'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->textField($newUserForm,'email'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'email'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'username'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->textField($newUserForm,'username'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'username'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'password'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->passwordField($newUserForm,'password'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'password'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'confirm_password'); ?>
		</td>
		<td>
			<?php echo $newUserFormWidget->passwordField($newUserForm,'confirm_password'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'confirm_password'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $newUserFormWidget->label($newUserForm,'date_of_birth'); ?>
		</td>
		<td>
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    	'model' => $newUserForm,
		    	'attribute' => 'date_of_birth',
				'options' => array(
				'showAnim'=>'fold',
				'changeMonth' => 'true',
				'changeYear' => 'true',
				'yearRange'=>'-100:+0',
				'dateFormat'=>'yy-mm-dd',
					),
		    	'htmlOptions' => array(
		        'size' => '10',         // textField size
		        'maxlength' => '10'    // textField maxlength
		    		)
				));
			?>
			<?php echo $newUserFormWidget->error($newUserForm,'date_of_birth'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo $newUserFormWidget->label($newUserForm,'acceptRules'); ?>
			<?php echo $newUserFormWidget->checkbox($newUserForm,'acceptRules'); ?>
			<?php echo $newUserFormWidget->error($newUserForm,'acceptRules'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img id="createProfileInProgress" style="display: none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
			<button class="large" type="submit">CLICK HERE TO CREATE ACCOUNT</button>
		</td>
	</tr>
</table>
<?php $this->endWidget(); ?>
</div>
</div>
</div>
<div>
<img src="<?php echo UrlUtils::generateImageUrl("login/divide.png"); ?>" width="942" height="12">
<a href="<?php echo UrlUtils::generateUrl(UrlUtils::HouseRulesUri); ?>"><img src="<?php echo UrlUtils::generateImageUrl("login/r3_background.png"); ?>" width="942" height="201" border="0"></a></div>


<?php $this->widget('application.components.widgets.popups.TermsAndConditionsPopup'); ?>
