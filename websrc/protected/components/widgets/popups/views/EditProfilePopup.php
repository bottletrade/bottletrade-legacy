
<?php 
//create a link
echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));

//put fancybox on page
$contentSelector = '#'.$this->popupID;
$linkSelector = '#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>

<div id="<?php echo $this->popupID; ?>" data-bind="with: $root.ProfileManager()" class="popup mfp-hide">
	<?php $editProfileFormWidget=$this->beginWidget('CActiveForm', array(
	                                                    'id'=>$this->formID,
	                                                    'enableAjaxValidation'=>true,
							    						'htmlOptions' => array('enctype' => 'multipart/form-data')
	                                                    )); ?>
	<?php echo $editProfileFormWidget->hiddenField($editProfileForm,'imagename', array('id'=>'editProfileImageNameId')); ?>
	<?php echo $editProfileFormWidget->hiddenField($editProfileForm,'username'); ?>
	<?php echo $editProfileFormWidget->hiddenField($editProfileForm,'links'); ?>
	<div style="width: 600px; text-align: center; margin: 0px auto">
		<img src="<?php echo UrlUtils::generateImageUrl("profile/edit_title.png"); ?>" width="217" height="164"/>
	</div>
	<div style="width: 360px; height: auto; text-align: center; margin: 0px auto">
		<?php 
			$this->widget('application.components.widgets.popups.ImageModifierPopup', 
						array('config'=>
								array(	'onComplete'=>
											"function(filename, fileurl) {
												$('#editProfileImageNameId').val(filename);
												$('#".$this->linkID."').click();
										  	}",
										'onCancel'=>
											"function() {
												$('#".$this->linkID."').click();
										  	}",
										'defaultImageSrc' => ImageManager::getImageUrlStatic(User::getCurrentUser())
								)
						)
			);
		?>
	<table class="popup-input-field">
 		<tr>
   			<td><?php echo $editProfileFormWidget->label($editProfileForm,'firstname'); ?></td>
    		<td><?php echo $editProfileFormWidget->textField($editProfileForm,'firstname', array('data-bind'=>'value: firstname')); ?>
    			<?php echo $editProfileFormWidget->error($editProfileForm,'firstname')?></td>
  		</tr>
  		<tr>
    		<td><?php echo $editProfileFormWidget->label($editProfileForm,'lastname'); ?></td>
    		<td><?php echo $editProfileFormWidget->textField($editProfileForm,'lastname', array('data-bind'=>'value: lastname')); ?>
    			<?php echo $editProfileFormWidget->error($editProfileForm,'lastname')?></td>
  		</tr>
  		<tr>
    		<td><?php echo $editProfileFormWidget->label($editProfileForm,'city'); ?></td>
    		<td><?php echo $editProfileFormWidget->textField($editProfileForm,'city', array('data-bind'=>'value: city')); ?>
    			<?php echo $editProfileFormWidget->error($editProfileForm,'city')?></td>
  		</tr>
 		 <tr>
    		<td><?php echo $editProfileFormWidget->label($editProfileForm,'state'); ?></td>
    		<td><?php echo $editProfileFormWidget->textField($editProfileForm,'state', array('data-bind'=>'value: state')); ?>
    			<?php echo $editProfileFormWidget->error($editProfileForm,'state')?></td>
  		</tr>
  		<tr>
    		<td><?php echo $editProfileFormWidget->labelEx($editProfileForm,'links'); ?></td>
    		<td>
    			<div id="LinkTable" data-bind='visible: links().length > 0'>
					<table data-bind='foreach: links'>
						<tr>
			 				<td><input class='required' data-bind='value: name, uniqueName: true' /></td>
							<td><button class='small' data-bind='click: $root.removeLink'>DELETE</button>
							</td>
		 				</tr>
		 			</table>
		 		</div>
		 		<button class='small' data-bind='click: addLink' onclick='return false;'>ADD LINK</button>
			</td>
 		 </tr>
  		<tr>
    		<td><?php echo $editProfileFormWidget->label($editProfileForm,'about'); ?></td>
    		<td><?php echo $editProfileFormWidget->textArea($editProfileForm,'about'); ?>
    			<?php echo $editProfileFormWidget->error($editProfileForm,'about')?></td>
  		</tr>
  		<tr>
  			<td>&nbsp;</td>
    		<td align="left">
    			<button class="medium" type="submit" data-bind="click: $(this).attr('disabled','disabled').beforeSave">SAVE</button>
				<button class='medium' onclick='$.magnificPopup.close(); return false;'>CANCEL</button>
			</td>
 		</tr>
	</table>
</div>
		<?php $this->endWidget(); ?>
</div>
	
<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	var OrigUserInfo = <?php echo json_encode(EditProfileForm::MakeDisplayDataWithUser($user)); ?>;
	var UserInfo = <?php echo json_encode(EditProfileForm::MakeDisplayDataWithForm($editProfileForm)); ?>;
	var OrigLinks = [
		<?php 
				foreach (explode(';',$user->Links) as $link) { 
	    			if ($link != '') {
	    				echo "{ name: '$link' },";
	    			}
	    		}
		?>];
	var Links = [
		<?php 
				foreach (explode(';',$editProfileForm->links) as $link) { 
	    			if ($link != '') {
	    				echo "{ name: '$link' },";
	    			}
	   			}
		?>];
	
	var LinkModel = function() {
	    var self = this;
	    self.links = ko.observableArray(Links);
	    self.city = ko.observable(UserInfo.city);
	    self.about = ko.observable(UserInfo.about);
	    self.firstname = ko.observable(UserInfo.firstname);
	    self.lastname = ko.observable(UserInfo.lastname);
	    self.state = ko.observable(UserInfo.state);
	    self.imgurl = ko.observable(UserInfo.imgurl);

	    self.reset = function() {
		    self.links(OrigLinks);
		    self.city(OrigUserInfo.city);
		    self.about(OrigUserInfo.about);
		    self.firstname(OrigUserInfo.firstname);
		    self.lastname(OrigUserInfo.lastname);
		    self.state(OrigUserInfo.state);
		    self.imgurl(OrigUserInfo.imgurl);
	    };
	 
	    self.addLink = function() {
	        self.links.push({
	            name: ""
	        });
	    };
	 
	    self.removeLink = function(link) {
	        self.links.remove(link);
	    };
	
	    self.convert = function() {
	        var links_ = new Array();
	    	ko.utils.arrayForEach(this.links(), function(link) {
	        	if (link.name != null && link.name != '') {
	        		links_.push(link.name);
	        	}
	        });
	        if (links_.length > 0) {
	        	return links_.join(';');
	        } else {
	            return '';
	        }
	   	};
	};
	
	KnockoutManager.ProfileManager(new LinkModel(Links));
	
	$("#<?php echo $this->formID; ?>").find('input[type="submit"]').first().click(function() {
		$("#<?php echo $this->formID; ?> input[id$='links']").val(KnockoutManager.ProfileManager().convert());
		return $("#<?php echo $this->formID; ?>").submit();
	});

	// have magnific popup reset form before closing
	$('#<?php echo $this->linkID; ?>').on('mfpBeforeClose', function(e /*, params */) {
		KnockoutManager.ProfileManager().reset();
	});
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