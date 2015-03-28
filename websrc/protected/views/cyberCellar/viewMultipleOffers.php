<div id="title_holder">
	<span class="white-title ti-medium">
		<?php if ($viewingSentOffers) { echo "SENT OFFERS"; } else { echo "INCOMING OFFERS"; } ?>
	</span>
</div>
<div id="white-area">
	<?php if (count($offers) == 0): ?>
		<span class="black bold">
			<?php if ($viewingSentOffers) { echo "You have no sent offers"; } else { echo "You have no incoming offers"; } ?>
		</span>
	<?php else: ?>
	<?php 
		$offerUrlPrefix = UrlUtils::generateUrl(UrlUtils::CyberCellarOffersUri, "/");
	?>
<div>
<table class="multi-items-table black">
	<tr class="black-underline bold">
		<td></td>
		<?php if ($viewingSentOffers): ?>
		<td>To</td>
		<?php else: ?>
		<td>From</td>
		<?php endif; ?>
		<td>Message</td>
		<td>Date / Time Sent</td>
	</tr>
	<?php foreach ($offers as $offer) { ?>
		<?php 
			$cssClass = '';
			if (!$viewingSentOffers) {
				$cssClass = $offer->IsRead ? "offer-read" : "offer-unread";
			}
		?>
		<tr class='<?php echo $cssClass; ?>' onclick="window.location = '<?php echo $offerUrlPrefix.$offer->ID; ?>'">
			<td>
				<?php 
				if ($viewingSentOffers) {
					$imgSrc = ImageManager::getImageUrlStatic($offer->userTo);
				} else {
					$imgSrc = ImageManager::getImageUrlStatic($offer->userFrom);
				} ?>
				<img src='<?php echo $imgSrc; ?>' width='45' height='45' border='1px solid #000'>
			</td>
			<?php if ($viewingSentOffers): ?>
			<td><?php echo $offer->userTo->Username; ?></td>
			<?php else: ?>
			<td><?php echo $offer->userFrom->Username; ?></td>
			<?php endif; ?>
			<td><?php 
				if (empty($offer->Message)) {
					echo "New Offer";
				} else {
					echo $offer->Message;
				}
			?></td>
			<td><script>localizeTimeAgo('<?php echo $offer->SentTime; ?>',true);</script></td>
		</tr>
	<?php } ?>
	</table>
</div>
<?php endif; ?>
</div>