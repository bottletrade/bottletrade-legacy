<div class="search-result">
	<div class="search-result-image">
		<img src="<?php echo ImageUtils::getStyleImageUrl($this->style); ?>" width='70' height='70'>
	</div>
	<div class="search-result-copy">
	<?php if ($this->style->tableName() == Beerstyle::model()->tableName()): ?>
		<span class="bottle_title">
			<?php echo $this->style->category->Name; ?> - <?php echo $this->style->Name; ?>
		</span>
	<?php elseif ($this->style->tableName() == WineStyle::model()->tableName()): ?>
		<span class="bottle_title">
			<?php echo $this->style->Name; ?>
		</span>
	<?php elseif ($this->style->tableName() == SpiritStyle::model()->tableName()): ?>
		<span class="bottle_title">
			<?php echo $this->style->Name; ?>
		</span>
	<?php endif; ?>
	</div>
</div>
<div class="horizontal-divide"></div>