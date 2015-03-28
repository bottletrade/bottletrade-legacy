<div id="title_holder">
	<span class="white-title ti-medium">PENDING OFFER</span>
</div>
<?php 
	$incomingOffer = $offer->UserTo == Yii::app()->user->ID;
?>
<div id="white-area">
	<div class="VST-left-bottles-holder">
		<div class="center">
			<span class=" black bold">Your Bottles Up For Trade</span>
		</div>
	<?php foreach($currUserBottleOffers as $currUserBottleOffer) { ?>
				<div style="width: 354px; height: auto; display: block; overflow: auto; padding: 3px;">	
				<div class="VST-image-holder">
					<img width='70' height='70' src="<?php echo ImageManager::getImageUrlStatic($currUserBottleOffer->bottle); ?>" />
				</div>
				<div class="VST-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($currUserBottleOffer->bottle); ?> | <?php echo Bottle::getBeverageName($currUserBottleOffer->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($currUserBottleOffer->bottle)." (".Bottle::getCompanyCity($currUserBottleOffer->bottle).", ".Bottle::getCompanyState($currUserBottleOffer->bottle).")"; ?>
						<br>
						Quantity: <?php echo $currUserBottleOffer->Quantity; ?>
						<br>
						Style: <?php echo Bottle::getStyleName($currUserBottleOffer->bottle); ?>
						<br>
					</span>
				</div>
			</div>
		<?php } ?>
		</div>
		<div class="VST-right-bottles-holder">
		<div class="center">
			<span class=" black bold"><?php echo $offer->UserTo == Yii::app()->user->ID ? $offer->userFrom->Username : $offer->userTo->Username; ?>'s Bottles Up For Trade</span>
		</div>
		<?php foreach($otherUserBottleOffers as $otherUserBottleOffer) {
			?>	
			<div style="width: 354px; height: auto; display: block; overflow: auto; padding: 3px;">
				<div class="VST-image-holder">
					<img width='70' height='70' src="<?php echo ImageManager::getImageUrlStatic($otherUserBottleOffer->bottle); ?>" />
				</div>
				<div class="VST-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($otherUserBottleOffer->bottle); ?> | <?php echo Bottle::getBeverageName($otherUserBottleOffer->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($otherUserBottleOffer->bottle)." (".Bottle::getCompanyCity($otherUserBottleOffer->bottle).", ".Bottle::getCompanyState($otherUserBottleOffer->bottle).")"; ?>
						<br>
						Quantity: <?php echo $otherUserBottleOffer->Quantity; ?>
						<br>
						Style: <?php echo Bottle::getStyleName($otherUserBottleOffer->bottle); ?>
						<br>
					</span>
				</div>
		</div>
		
		<?php } ?>
		</div>
		<div style="width: 720px">
		<img src="<?php echo UrlUtils::generateImageUrl("propose_trade/trans_divide.png"); ?>" width="720" height="2"/>
	</div>
	<div style="position: relative; width: 730px; height: auto; text-align: center; top: 5px;">
		<?php if ($incomingOffer): ?>
			<button class="medium" onclick="sendOfferResponse('<?php echo OfferResponse::ACCEPT; ?>'); return false;">ACCEPT</button>
			<button class="medium" onclick="sendOfferResponse('<?php echo OfferResponse::DECLINE; ?>'); return false;">DECLINE</button>
			<button class="medium" onclick="window.location = '<?php echo UrlUtils::generateUrl(UrlUtils::TradeCounterUri."/".$offer->ID); ?>'">COUNTER</button>
		<?php else: ?>
			<button class="medium" onclick="sendOfferResponse('<?php echo OfferResponse::REMOVE; ?>'); return false;">REMOVE TRADE</button>
		<?php endif; ?>
	</div>
</div>

<?php 
	/**********************************
	* Javascript
	***********************************/
?>
<script type="text/javascript">
function sendOfferResponse(response) {
	$.ajax({
	    type: 'post',
	    url: "<?php echo UrlUtils::generateUrl(UrlUtils::TradeOfferResponseUri);?>",
	    data: {'offerID': <?php echo $offer->ID; ?>, 'response': response },
	    dataType: 'json',
	    success: function(data){
		    if (data.TradeID) {
    	        window.location= "<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri); ?>" + data.TradeID;
		    } else {
			    <?php if ($incomingOffer): ?>
	        	window.location="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersIncomingUri); ?>";
	        	<?php else: ?>
	        	window.location="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersSentUri); ?>";
	        	<?php endif; ?>
		    }
	    }
	});
}
</script>