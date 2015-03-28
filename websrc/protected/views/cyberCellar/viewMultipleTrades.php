<div id="title_holder">
	<span class="white-title ti-medium">
		<?php if ($completed) { echo "COMPLETED TRADES"; } else { echo "PENDING TRADES"; } ?>
	</span>
</div>
<div id="white-area">
<?php if (count($tradeinfos) == 0): ?>
	<span class="black bold">
		<?php if ($completed) { echo "You have no completed trades"; } else { echo "You have no pending trades"; } ?>
	</span>
<?php else: ?>
	<?php foreach ($tradeinfos as $tradeinfo) { ?>
	<div class="VMT-holder">
			<?php if ($completed): ?>
			<div class="center">
				<span class="black-large bold">Completed Trade with <?php echo Trade::getOtherUser($tradeinfo["trade"])->Username; ?></span><br />
			</div>
			<?php else: ?>
			<div class="center">
				<span class="black-large bold">Open Trade with <?php echo Trade::getOtherUser($tradeinfo["trade"])->Username; ?><br />
				</span>
			
				<span class="black">
				(You are currently trading with this user.)
				</span></div>
			<?php endif; ?>
			<div class="VMT-bottle-holder-L">
			<?php if ($completed): ?>
				<div class="center">
					<span class="black bold">Your Traded Bottles</span>
				</div>
			<?php else: ?>
				<div class="center">
					<span class="black bold">Your Bottles Up For Trade</span>
				</div>
			<?php endif; ?>
				<?php foreach ($tradeinfo["currUserBottleTrades"] as $currUserBottleTrade) { ?>
					<div class="VMT-bottle-holder">
						<div class="VMT-bottle-image">
						<img width='50' height='50' src="<?php echo ImageManager::getImageUrlStatic($currUserBottleTrade->bottle); ?>" />
						</div>
						<div class="VMT-bottle-info">
						<span class="black">
						<?php echo Bottle::getBottledOnYear($currUserBottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($currUserBottleTrade->bottle); ?>
						<br />
						Quantity: <?php echo $currUserBottleTrade->Quantity; ?>
						</span>	
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="vertical-divide">
			</div>
			<div class="VMT-bottle-holder-R">
			<?php if ($completed): ?>
				<div class="center">
				<span class="black bold">Their Traded Bottles</span>
				</div>
			<?php else: ?>
				<div class="center">
				<span class="black bold">Their Bottles Up For Trade</span>
				</div>
			<?php endif; ?>
					<?php foreach ($tradeinfo["otherUserBottleTrades"] as $otherUserBottleTrade) { ?>
					<div class="VMT-bottle-holder">
						<div class="VMT-bottle-image">
						<img width='50' height='50' src="<?php echo ImageManager::getImageUrlStatic($otherUserBottleTrade->bottle); ?>" />
						</div>
						<div class="VMT-bottle-info">
						<span class="black">
						<?php echo Bottle::getBottledOnYear($otherUserBottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($otherUserBottleTrade->bottle); ?>
						<br />
						Quantity: <?php echo $otherUserBottleTrade->Quantity; ?>
						</span>
						</div>
					</div>
					<?php } ?>
			</div>
			<div style="width: 640px">
		<img src="<?php echo UrlUtils::generateImageUrl("propose_trade/trans_divide.png"); ?>" width="640" height="2"/>
	</div>
			<div style="text-align: center;">
				<button class='small' onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $tradeinfo["trade"]->ID); ?>'">VIEW TRADE</button>
			</div>
	</div>
	<?php } ?>
<?php endif; ?>
</div>
	