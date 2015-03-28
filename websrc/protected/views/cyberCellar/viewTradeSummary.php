<div id="title_holder">
	<span class="white-title ti-medium">TRADE DETAILS</span>
</div>
<?php 
	$ratingArray = array('zero','one','two','three','four','five');

	$tradeTitle = "Completed trade between ".$user1->Username." and ".$user2->Username;
?>
<div id="white-area">
	<hr class="horizontal-divide">
	<div class="center">
	<span class="black-large bold">Trade Summary</span>
	</div>
	<div class="TD-bottles-up-holder">
		<div class="TD-your-title">
			<span class="black bold"><?php echo $user1->Username; ?>'s Bottles Up For Trade</span><br />
			<?php foreach($user1BottleTrades as $bottleTrade) { ?>
			<div class="TD-bottle-holder">
				<div class="TD-bottle-image-holder">
					<img src='<?php echo ImageManager::getImageUrlStatic($bottleTrade->bottle); ?>' height='100%' width='100%'>
				</div>
				<div class="TD-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($bottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($bottleTrade->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($bottleTrade->bottle); ?> <?php echo Bottle::getCompanyCityStateDisplay($bottleTrade->bottle); ?>
						<br>
						Quantity: <?php echo $bottleTrade->Quantity; ?>
						<br>
						Style: <?php echo Bottle::getStyleName($bottleTrade->bottle); ?>
					</span>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="TD-their-title">
			<span class="black"><b><?php echo $user2->Username; ?>'s Bottles Up For Trade</b></span><br />
			<?php foreach($user2BottleTrades as $bottleTrade) {
			?>
			<div class="TD-bottle-holder">
				<div class="TD-bottle-image-holder">
					<img src='<?php echo ImageManager::getImageUrlStatic($bottleTrade->bottle); ?>' height='100%' width='100%'>
				</div>
				<div class="TD-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($bottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($bottleTrade->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($bottleTrade->bottle); ?> <?php echo Bottle::getCompanyCityStateDisplay($bottleTrade->bottle); ?>
						<br />
						Quantity: <?php echo $bottleTrade->Quantity; ?>
						<br />
						Style: <?php echo Bottle::getStyleName($bottleTrade->bottle); ?>
						</span>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<hr class="horizontal-divide">	
	<div class="center">
		<span class="black-large bold">Trader Reviews</span>
	</div>
	<br/>
	<table>
		<tr>
			<td><span class="black bold"><?php echo $user1->Username; ?>'s Review</span><br />
				<?php if ($user1Review == null): ?>
				<span class="black"><?php echo $user1->Username; ?> has not left a review for this trade.</span><br/>
				<?php else: ?>
				<div class="VST-review-container">
					<div class="VST-review-user-image">
						<img src='<?php echo ImageManager::getImageUrlStatic($user1); ?>'>
					</div>
						<div class="VST-review-rating">
							<img src='<?php echo UrlUtils::generateImageUrl('profile/'.$ratingArray[$user1Review->Rating].'_bottle.png'); ?>'>
						</div>
						<div class="VST-review-message">
							<span class="black">
								<?php echo $user1Review->Message; ?>
							</span>
						</div>
				</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td><span class="black bold"><?php echo $user2->Username; ?>'s Review</span><br />
				<?php if ($user2Review == null):?>
				<span class="black"><?php echo $user2->Username; ?> has not left a review for this trade.</span><br/>
			<?php else:?>
				<div class="VST-review-container">
					<div class="VST-review-user-image">
						<img src='<?php echo ImageManager::getImageUrlStatic($user2); ?>' width='86' height='86'><br/>
					</div>
						<div class="VST-review-rating">
							<img src='<?php echo UrlUtils::generateImageUrl('profile/'.$ratingArray[$user2Review->Rating].'_bottle.png'); ?>'>
						</div>
						<div class="VST-review-message">
							<span class="black">
							<?php echo $user2Review->Message; ?>
							</span>
						</div>
				</div>
			<?php endif; ?>
			</td>
		</tr>
	</table>
</div>