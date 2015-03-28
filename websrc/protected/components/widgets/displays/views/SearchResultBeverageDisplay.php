<div class="search-result no-cursor">
	<div class="search-result-image">
		<img src="<?php echo ImageUtils::getBeverageImageUrl($this->beverage); ?>" width='80' height='80'>
	</div>

	<div class="search-result-copy">
	<?php if (ModelTypeUtils::isBeer($this->beverage)): ?>
		<span class="bottle_title">
			<a href="<?php echo UrlUtils::getBeverageUrl($this->beverage); ?>"><?php echo $this->beverage->Name; ?></a>
			<br/>
			<a href="<?php echo UrlUtils::getCompanyUrl($this->beverage->brewery); ?>"><?php echo $this->beverage->brewery->Name; ?></a>
		</span>
		<br />
		<button onclick="KnockoutManager.IsoManager().addBeer(<?php echo $this->beverage->ID; ?>); return false;" class="medium">ADD TO ISO</button>
		<button onclick="KnockoutManager.BottleManager().addBottle();
						KnockoutManager.BottleManager().openPopup();
						KnockoutManager.BottleManager().setCompany(<?php echo $this->beverage->brewery->ID; ?>, '<?php echo $this->beverage->brewery->Name; ?>');
						KnockoutManager.BottleManager().setBeverage(<?php echo $this->beverage->ID; ?>);" class="medium">ADD TO CELLAR</button>
	<?php elseif (ModelTypeUtils::isWine($this->beverage)): ?>
		<span class="bottle_title">
		</span>
	<?php elseif (ModelTypeUtils::isSpirit($this->beverage)): ?>
		<span class="bottle_title">
		</span>
	<?php endif; ?>
	</div>
</div>
<div class="horizontal-divide"></div>