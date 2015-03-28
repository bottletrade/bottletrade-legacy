<?php if ($this->isIncomingRequest): ?>
<table class="friend-request-table">
	<tr>
		<td>
			<span class="black bold">Request from <?php echo LinkUtils::createProfileLink($this->friendRequest->userFrom->Username); ?> waiting your approval</span>
		</td>
		<td>
			<button class='small' onclick="<?php echo $this->onAcceptClick; ?>">ACCEPT</button>
			<button class='small' onclick="<?php echo $this->onDeclineClick; ?>">DECLINE</button>
		</td>
	</tr>
</table>
<?php else: ?>
<table class="friend-request-table">
	<tr>
		<td>
			<span class="black">Pending request to <?php echo $this->friendRequest->userTo->Username; ?></span>
		</td>
		<td>
			<button class='small' onclick="<?php echo $this->onRemoveClick; ?>">REMOVE</button>
		</td>
	</tr>
</table>
<?php endif; ?>
<div class="horizontal-divide-short"></div>