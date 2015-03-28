<div id="title_holder">
	<span class="white-title ti-medium">MESSAGES</span>
</div>
<?php 
	if (count($messages) == 0):
?>
	<span class="black bold">No Messages</span><br/>
<?php else: ?>
<div data-bind="with: $root.MessageReplyManager()">
	<?php
		// render popin
		$this->widget('application.components.widgets.displays.MessageReplyPopinKO');
	
		$totalMessages = count($messages);
		$index = 1;
		foreach($messages as $message) {
			// load KO with bottle info
			$this->widget('application.components.widgets.displays.MessageDisplay', array('message' => $message, 'allowReply' => $index == $totalMessages));
			$index++;
		}
	?>
	<div style="width: 756px; min-height: 471px; overflow-x: hidden; background-color: #FFF; margin: 0px auto 0px auto; border: 2px solid #000;">
		<div class="event-container">
			<button style="margin: 8px;" data-bind="click: deleteMessage" class="small">
				DELETE THREAD
			</button>
			<div data-bind="foreach: messagesArray" style="width: 630px; height: auto; background-color: #FFF; margin: 10px 10px 0px 10px;">
				<?php 
					// for each bottle loaded into KO, show info
					$this->widget('application.components.widgets.displays.MessageDisplay'); 
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
