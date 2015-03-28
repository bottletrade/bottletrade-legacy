<?php 
//create a link
echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));

//put fancybox on page
$contentSelector = 'div#'.$this->popupID;
$linkSelector = 'a#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>
<div id="<?php echo $this->popupID; ?>" class="popup mfp-hide">
	<div data-bind="with: $root.MessageSenderManager()">
		<?php $messageFormWidget=$this->beginWidget('CActiveForm', array(
		                                                    'id'=>$this->formID,
		                                                    'enableAjaxValidation'=>false
		                                                    )); ?>
		                       
		<table width="680px">
		<tr>
	    	<td class="text_field_prompt"><?php echo $messageFormWidget->labelEx($messageForm,'userToName'); ?></td>
	    	<td>
	    		<input type="text" class="bottle_input" data-bind="value: userToName, ko_autocomplete: { source: $root.MessageSenderManager().getUsers, select: $root.MessageSenderManager().setUser }"/>
	    		<?php echo $messageFormWidget->error($messageForm, 'userToName'); ?>
	    	</td>
	  	</tr>
		<tr>
			<td class="text_field_prompt"><?php echo $messageFormWidget->labelEx($messageForm,'subject'); ?></td>
			<td><span class="black"><?php echo $messageFormWidget->textField($messageForm,'subject'); ?></span>
				<?php echo $messageFormWidget->error($messageForm,'subject'); ?></td>
		</tr>
		<tr>
			<td class="text_field_prompt" valign="top"><?php echo $messageFormWidget->labelEx($messageForm,'body'); ?></td>
			<td id="message-text"><span class="black"><?php echo $messageFormWidget->textArea($messageForm,'body'); ?></span>
				<?php echo $messageFormWidget->error($messageForm,'body'); ?></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="medium" type="submit">SAVE</button>
				<button class='medium' onclick='$.magnificPopup.close(); return false;'>CANCEL</button>
			</td>
		</tr>
		</table>
		<?php echo $messageFormWidget->hiddenField($messageForm,'userFromId'); ?>
		<?php echo $messageFormWidget->hiddenField($messageForm,'userToId', array("data-bind"=>"value: userToId")); ?>
		<?php echo $messageFormWidget->hiddenField($messageForm,'userToName', array("data-bind"=>"value: userToName")); ?>

		<?php $this->endWidget(); ?>
	</div>
</div>

<!-- Knockout UI code -->
<script type='text/javascript'>		
$(window).bind("load", function() {
	var MessageEditor = function () {
	    var self = this;
	    self.userToId = ko.observable('<?php echo $messageForm->userToId; ?>');
	    self.userToName = ko.observable('<?php echo $messageForm->userToName; ?>');
	    
	    self.getUsers = function(request, response) {
		    if (request == null || request.term.length < 3) {
			    return;
		    }
		    var apiUrl = "<?php echo UrlUtils::generateUrl(UrlUtils::ApiUsersUri);?>" + request.term;
	    	$.ajax({
	    	    type: 'GET',
	    	    url: apiUrl,
	    	    dataType: 'json',
	    	    success: function(data){
	    	    	response($.map(data, function(user) {
                        return {
                            userId: user.ID,
                            label: user.Name
                        };
                    }));
	    	    }
	    	});
	    }
	    
	    self.setUser = function(event, ui) {
		    self.userToId(ui.item.userId);
		    self.userToName(ui.item.label);
	    }

	    self.setUserTo = function(id,name) {
		    self.userToId(id);
		    self.userToName(name);
	    }
	};

	KnockoutManager.MessageSenderManager(new MessageEditor());
});
</script>

<?php 
	Yii::app()->clientScript->registerScript($this->popupID, "
		$(window).bind('load', function() {
			var errorMsgs = $('$contentSelector div.errorMessage');
			if (errorMsgs.length > 0) {
				for (i = 0; i < errorMsgs.length; ++i) {
					if ($(errorMsgs[i]).css('display') != 'none') {
						$('$linkSelector').click();
						return false;
					}
				}
			}
		});");
?>