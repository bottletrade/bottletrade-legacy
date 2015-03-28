<div id="manage-friend-holder">
	<img class="manage-friend-image" src="<?php echo ImageManager::getImageUrlStatic($this->user); ?>" />
	<div class="manage-friend-info">
		<span class="black"><?php echo $this->user->Username; ?></span><br>
		<button style="margin-bottom: 4px;" class="mini" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, $this->user->Username); ?>'; return false;">View Profile</button><br>
		<button class="mini" onclick="
							KnockoutManager.MessageSenderManager().setUserTo('<?php echo $this->user->ID; ?>', '<?php echo $this->user->Username; if (!empty($formalName)) echo " (".$formalName.")"; ?>');
							$('<?php echo '#'.PopupConstants::MessagePopupLinkID; ?>').click();">Message User</button>
	</div>
</div>