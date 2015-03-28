<div id="title_holder">
	<span class="white-title ti-medium">MESSAGES</span>
</div>
<div id="white-area">
	<?php 
	if (count($messages) == 0):
	?>
	<span class="black bold">No Messages</span><br/>
	<?php else: ?>
	<?php 
		$viewingSentMessages = $messages[0]->UserFrom == Yii::app()->user->ID; 
		if ($viewingSentMessages) {
			$inboxUrlPrefix = UrlUtils::generateUrl(UrlUtils::InboxMessagesSentUri, "/");
		} else {
			$inboxUrlPrefix = UrlUtils::generateUrl(UrlUtils::InboxUri, "/");
		}
	?>
	<table class="multi-items-table black">
		<tr class="black-underline bold">
			<td></td>
			<?php if ($viewingSentMessages): ?>
				<td>To</td>
			<?php else: ?>
				<td>From</td>
			<?php endif; ?>
			<td>Subject</td>
			<td>Date / Time Sent</td>
		</tr>
		<?php foreach ($messages as $message) { ?>
		<?php 
			$cssClass = "";
			if (!$viewingSentMessages) {
				$cssClass = $message->IsRead ? "message-read" : "message-unread";
			}
		?>
		<tr class='<?php echo $cssClass; ?>' onclick= "window.location = '<?php echo $inboxUrlPrefix.$message->ID; ?>';">
			<td>
				<?php 
				if ($viewingSentMessages) {
					$imgSrc = ImageManager::getImageUrlStatic($message->userTo);
				} else {
					$imgSrc = ImageManager::getImageUrlStatic($message->userFrom);
				} ?>
				<img src='<?php echo $imgSrc; ?>' width='45' height='45' border='1px solid #000;'>
			</td>
			<?php if ($viewingSentMessages): ?>
			<td><?php echo $message->userTo->Username; ?></td>
			<?php else: ?>
			<td><?php echo $message->userFrom->Username; ?></td>
			<?php endif; ?>
			<td><?php echo $message->Subject; ?></td>
			<td><script>localizeTime('<?php echo $message->SentTime; ?>', true);</script></td>
		</tr>
	<?php 
	// $depthTd = CHtml::tag("td", array(), $message->Depth == 0 ? "" : $message->Depth + 1);
	} // end foreach message
	?>
	</table>
	<?php endif; ?>
</div>
