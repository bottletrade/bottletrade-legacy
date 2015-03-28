<div style="width: 950px; height: 166px; text-align: center;">
	<img src="<?php echo UrlUtils::generateImageUrl("account_settings/logo.png"); ?>" width="215" height="166"/>
</div>

<?php $settingsWidget=$this->beginWidget('CActiveForm', array(
                                       		'clientOptions'=>array(
                                          		'validateOnSubmit'=>true
                                     		),
                                  		)); ?>
<br />
<div style="width: 950px; height: auto; text-align: center; margin: 0px auto 5px auto;">
	<span class="white-title ti-medium">CHANGE LOGIN INFO</span><br>
	<div style="width: 926px; height: 100px; padding: 5px; border: 2px solid #000; background-color: #FFF;">
	<table class="black-large" style="margin: 0px auto 0px auto;">
		<tr>
			<td style="text-align: right;"><?php echo $settingsWidget->label($settingsForm, 'newPassword'); ?><br /></td>
			<td><?php echo $settingsWidget->passwordField($settingsForm, 'newPassword'); ?>
				<?php echo $settingsWidget->error($settingsForm, 'newPassword'); ?></td>
		</tr>
		<tr>
			<td style="text-align: right;"><?php echo $settingsWidget->label($settingsForm, 'confirmPassword'); ?></td>
			<td><?php echo $settingsWidget->passwordField($settingsForm, 'confirmPassword'); ?>
				<?php echo $settingsWidget->error($settingsForm, 'confirmPassword'); ?></td>
		</tr>
		<tr>
			<td colspan="3">
				<button class="medium">SUBMIT</button>
			</td>
		</tr>
	</table>
	</div>	
</div>
<?php 
	// used in radio button list
	$yesNo = array('0' => 'No', '1' => 'Yes');
?>
<div style="width: 470px; min-height: 400px; float: left; text-align: center;" data-bind="with: $root.AccountSettingsManager()">
	<span class="white-title ti-medium">EMAIL ALERTS</span><br>
	<div style="width: 450px; min-height: 400px; padding: 5px; margin: 0px auto; border: 2px solid #000; background-color: #FFF;">
		<span class="black-medium">Change your email notification settings below.</span><br><br>
		<span class="black">
		<?php
			echo $settingsWidget->labelEx($settingsForm, 'globalEmailNotifications');
			echo $settingsWidget->radioButtonList($settingsForm, 'globalEmailNotifications', $yesNo, array('separator'=>'', 'data-bind'=>'checked: enableEmailSettings'));
			echo $settingsWidget->error($settingsForm, 'globalEmailNotifications');
		?>
		</span>
		<div data-bind="visible: showEmailSettings" style="display: none;">
			<br>
			<span class="black-large">Notify me when:</span>
			<table class="black" style="margin: 0px auto 0px auto;">
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailFriendRequests'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailFriendRequests', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailFriendRequests');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailInboxMessages'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailInboxMessages', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailInboxMessages');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailTradeOffers'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailTradeOffers', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailTradeOffers');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailAcceptedOffers'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailAcceptedOffers', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailAcceptedOffers');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailDeclinedOffer'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailDeclinedOffer', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailDeclinedOffer');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailShippingDates'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailShippingDates', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailShippingDates');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailBottlesReceived'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailBottlesReceived', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailBottlesReceived');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailBottlesShipped'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailBottlesShipped', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailBottlesShipped');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailClosedTrades'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailClosedTrades', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailClosedTrades');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailTraderReviews'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailTraderReviews', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailTraderReviews');
					?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $settingsWidget->labelEx($settingsForm, 'emailTradeMessages'); ?>
					</td>
					<td>
					<?php 
						echo $settingsWidget->radioButtonList($settingsForm, 'emailTradeMessages', $yesNo, array('separator'=>''));
						echo $settingsWidget->error($settingsForm, 'emailTradeMessages');
					?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div style="width: 470px; min-height: 400px; float: left; text-align: center; margin: 0px 0px 0px 4px;">
	<span class="white-title ti-medium">MANAGE FRIENDS</span><br>
	<div style=" overflow-x: hidden; overflow-y: scroll; width: 450px; min-height: 400px; padding: 5px; margin: 0px auto; border: 2px solid #000; background-color: #FFF;">
		<span class="black-medium">View or delete your current friends below.
		</span><br><br>
		<?php if (empty($friends)): ?>	
			<span class="black">Once you add a friend they will show up here</span>
		<?php else: ?>
			<?php 
				foreach ($friends as $friend) {
					$this->widget('application.components.widgets.displays.ManageFriendDisplay', array('user' => $friend));
				}
			?>
		<?php endif; ?>
	</div>
</div>
<div style="clear: both; width: 950px; height: 40px; text-align: center;">
	<button class="large" type="submit">SAVE CHANGES</button>
	<button class="large" onclick="
			if (confirm('Are you sure you want to delete your account')) {
				$.ajax({
				    type: 'post',
				    url: '<?php echo UrlUtils::generateUrl(UrlUtils::AccountDeleteUri);?>',
				    dataType: 'json',
				    success: function(data){
					    window.location='<?php echo UrlUtils::generateUrl(); ?>'
			    	}
			    }); 
			} 
			return false;">DELETE PROFILE</button>
</div>
<?php $this->endWidget(); ?>

<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("ready", function() {
	var AccountSettingsModel = function() {
		var self = this;
		self.enableEmailSettings = ko.observable(<?php echo $settingsForm->globalEmailNotifications; ?>);

		self.showEmailSettings = ko.computed(function() {
			return self.enableEmailSettings() == 1;
		}, this);
	}

	KnockoutManager.AccountSettingsManager(new AccountSettingsModel);
});
</script>