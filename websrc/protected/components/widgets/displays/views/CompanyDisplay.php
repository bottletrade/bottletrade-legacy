<div style="width: 610px; height: 125px; padding: 5px; margin: 5px 5px 5px 5px; text-align: left; border-bottom: 1px solid #000;">
	<div style="width: 140px; height: 115px; background-color: #FFF; border: solid 2px #000; float: left; overflow: hidden;">
		<img src="<?php echo ImageUtils::getCompanyImageUrl($this->company); ?>" width='140' height='115'>
	</div>

	<div style="width: 460px; height: 130px; float: left; text-align: center;">
		<span class="bottle_title">
			<?php echo $this->company->Name." (".$this->company->City.", ".$this->company->State.")"; ?>
		</span>
	</div>
</div>