<div id="manage-friend-holder">
	<img class="manage-friend-image" src="<?php echo ImageManager::getImageUrlStatic($this->user); ?>" />
	<div class="manage-friend-info">
		<span class="black-small"><?php echo $this->user->Username; ?><br><span>
		<button style="margin-bottom: 4px;" class="mini" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, $this->user->Username); ?>'; return false;">View Profile</button><br>
		<button class="mini" onclick="
			if (confirm('Are you sure you want to remove <?php echo $this->user->Username; ?> from your friends list')) {
				$.ajax({
				    type: 'post',
				    url: '<?php echo UrlUtils::generateUrl(UrlUtils::FriendDeleteUri, "?id=".$this->user->ID);?>',
				    dataType: 'json',
				    success: function(data){
					    location.reload();
			    	}
			    }); 
			} 
			return false;">Delete Friend</button>
	</div>
</div>