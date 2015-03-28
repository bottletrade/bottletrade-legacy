<div class="search-result no-cursor">
	<div class="search-result-image">
		<img src="<?php echo ImageUtils::getCompanyImageUrl($this->company); ?>" width='80' height='80'>
	</div>
	<div class="search-result-copy">
		<span class="bottle_title">
			<a href="<?php echo UrlUtils::getCompanyUrl($this->company); ?>"><?php echo $this->company->Name; ?></a>
			<br/>
			(<?php echo $this->company->City; ?>, <?php echo $this->company->State; ?>)
		</span>
	</div>
</div>
<div class="horizontal-divide"></div>