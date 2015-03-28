<div class="search-result" onclick="window.location='<?php echo UrlUtils::generateProfileUrl($this->user); ?>';">
	<div class="search-result-image">
		<img src="<?php echo ImageManager::getImageUrlStatic($this->user); ?>" width='80' height='80' />
	</div>

	<div class="search-result-copy">
		<span class="bottle_title">
			<?php echo User::getUserNameAndFormalName($this->user); ?>
		</span>
	</div>
</div>
<div class="horizontal-divide"></div>