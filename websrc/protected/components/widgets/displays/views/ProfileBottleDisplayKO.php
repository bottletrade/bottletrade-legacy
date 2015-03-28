<div class="bottle-display">
	<div class="bottle-display-image">
		<img data-bind='attr:{src: imgSrc }' width='115' height='115'>
	</div>
	<div class="bottle-display-info">
		<span class="bottle_title">
			<!-- ko text: year --><!-- /ko --> | <a data-bind="attr: { href: yii.urls.beerInfo + beerId}, text: beverageName"></a>
			<br/>
			<a data-bind="attr: { href: yii.urls.breweryInfo + companyId}, text: companyName"></a>
		</span>
		<br/>
			<table class="bottle-display-table black">
				<tr>
					<td>
						Style: 
						<span data-bind="text: styleName, visible: styleName.length > 0"></span>
						<span data-bind="visible: styleName.length == 0">N/A</span>
					</td>
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
			<div class="bottle-display-buttons">
				<button data-bind="visible: isEditable == true, click: $root.BottleManager().editBottle" class="small" onclick="$('#<?php echo PopupConstants::BottlePopupLinkID; ?>').click();">
					EDIT
				</button>
				<button data-bind="visible: isEditable == true, click: $root.BottleManager().deleteBottle" class="small">
					DELETE
				</button>
				<button data-bind="visible: (isEditable != true && isTradeable == 'Yes' && quantity > 0), click: $root.BottleManager().makeOffer" class="small">
					MAKE AN OFFER
				</button>
				<button data-bind='click: $root.BottleManager().viewMoreInfo' class="small" onclick="$('#<?php echo PopupConstants::BottleInfoPopupLinkID; ?>').click();">
					VIEW ALL INFO
				</button>
			</div>
	</div>
</div>
<div class="horizontal-divide"></div>