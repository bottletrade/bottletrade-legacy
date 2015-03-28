<?php if (empty($this->bottle)): ?>
<div class="search-result no-cursor">
	<div class="search-result-image">
		<img data-bind='attr:{src: imgSrc}' width='80' height='80'>
	</div>
	<div class="search-result-copy">
		<span class="bottle_title">
			<!-- ko text: year --><!-- /ko --> | <a class="underline" data-bind="attr: { href: yii.urls.beerInfo + beerId}, text: beverageName"></a>
			<br/>
			<a class="underline" data-bind="attr: { href: yii.urls.breweryInfo + companyId}, text: companyName"></a>
			<br/>
				<span class="center black">
					Posted by <a class="underline" data-bind="attr: { href: yii.urls.profile + username }, text: username"></a>				</span>
		</span>
		<br/>
			<table class="bottle-display-table black">
				<tr>
					<td>Style: <!-- ko text: styleName --><!-- /ko --></td>
					<td>Size: <!-- ko text: fluidAmount --><!-- /ko --></td>
				</tr>
				<tr>
					<td>ABV: 
						<span data-bind="text: abv, visible: abv > 0"></span>
						<span data-bind="visible: abv == 0">N/A</span>
					</td>
					<td>Quantity: <!-- ko text: quantity --><!-- /ko --></td>
				</tr>
			</table>
			<div style="text-align: center; margin: 7px auto 0px auto;">
				<button data-bind="visible: isEditable == true, click: $root.BottleManager().editBottle" class="small" onclick="$('#<?php echo PopupConstants::BottlePopupLinkID; ?>').click();">
					EDIT
				</button>
				<button data-bind="visible: isEditable == true, click: $root.BottleManager().deleteBottle" class="small">
					DELETE
				</button>
				<button data-bind="visible: (isEditable != true && isTradeable == 'Yes'), click: $root.BottleManager().makeOffer" class="small" onclick="return false;">
					MAKE AN OFFER
				</button>
				<button data-bind='click: $root.BottleManager().viewMoreInfo' class="small" onclick="$('#<?php echo PopupConstants::BottleInfoPopupLinkID; ?>').click();">
					VIEW ALL INFO
				</button>
			</div>
	</div>
</div>
<div class="horizontal-divide"></div>
<?php endif; // if (empty($this->bottle)) ?>

<?php if (!empty($this->bottle)): ?>
<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	KnockoutManager.EventManager().addEvent(<?php echo json_encode(KnockoutBottle::MakeDataWithBottle($this->bottle)); ?>);
});
</script>
<?php endif; // if (!empty($this->bottle)) ?>