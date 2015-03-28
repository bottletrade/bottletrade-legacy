<?php 
/* 
* Editable Bottle Popup
*/

	// only render form if requested, otherwise just do knockout bindings
	if($this->renderForm): 
?>
<a id="<?php echo $this->editLinkID; ?>" href="<?php echo '#'.$this->editPopupID; ?>" class="hidden"></a>
<?php 
	$contentSelector = '#'.$this->editPopupID;
	$linkSelector = '#'.$this->editLinkID;
	$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
			'linkSelector'=>$linkSelector,
			'contentSelector'=>$contentSelector
	));
?>
	<div id="<?php echo $this->editPopupID; ?>" data-bind="with: $root.BottleManager().bottleToEdit" class="popup mfp-hide upload-bottle">
		<?php $bottleFormWidget=$this->controller->beginWidget('CActiveForm', array(
	                                                    'id'=>$this->formID,
	                                                    'enableAjaxValidation'=>true,
							    						'htmlOptions' => array('enctype' => 'multipart/form-data')
	                                                    )); ?>
	   	<?php echo $bottleFormWidget->hiddenField($bottleForm,'imagename', array('data-bind'=>'value: imageName')); ?>
		<?php echo $bottleFormWidget->hiddenField($bottleForm,'bottleId',array('data-bind'=>'value: bottleId')); ?>
		<?php echo $bottleFormWidget->hiddenField($bottleForm,'companyId',array('data-bind'=>'value: companyId')); ?>
		<?php echo $bottleFormWidget->hiddenField($bottleForm,'companyName',array('data-bind'=>'value: companyName')); ?>
		<?php echo $bottleFormWidget->hiddenField($bottleForm,'beerId',array('id'=>'bottleFormBeerId', 'data-bind'=>'value: beerId')); ?>	
		<div style="text-align: center;">
			<img src="<?php echo UrlUtils::generateImageUrl("bottle_popup/logo.png"); ?>" width="180" height="138"/>
		</div>
			<div style="width: 227px; height: 450px; float: left; padding: 50px 5px 10px 5px; text-align: center;">
				<img src="<?php echo UrlUtils::generateImageUrl("bottle_popup/text.png"); ?>" width="227" height="397"/>
			</div>
			<div style="min-width: 400px; min-height: 450px; float: left; text-align: center; padding: 20px 5px 10px 5px;">
				<?php 
					$this->widget('application.components.widgets.popups.ImageModifierPopup', 
								array('config'=>
										array(	'onComplete'=>
													"function(filename, fileurl) {
														KnockoutManager.BottleManager().restorePopup();
														KnockoutManager.BottleManager().setImageUrl(filename, fileurl);
														$('#".$this->editLinkID."').click();
												}",
												'beforeOpen' =>
													"function() {
														KnockoutManager.BottleManager().suspendPopup();
												}",
												'onCancel'=>
													"function() {
														$('#".$this->editLinkID."').click();
										  		}",
												'defaultImageSrc' => "",
												'imgPreviewId' => 'ImagePreviewBottleEdit',
												'imgDataBind' => 'attr:{src: imgSrc }'
										)
								)
					);
				?>
					<table class="popup-input-field">
					  	<?php /*<tr>
					    	<td align="right"><?php echo $bottleFormWidget->labelEx($bottleForm,'type'); ?></td>
					    	<td align="left"><?php echo $bottleFormWidget->dropDownList(
									    $bottleForm,
									    'beverageType',
					    				FormUtils::createDropdownList(BeverageType::getAllTypes()),
										array('class'=>'bottle-input', 'data-bind'=>'value: beverageType, event: { change: $root.beverageTypeChanged }')); ?>
							</td>
					  	</tr>*/ ?>
					  	<tr>
					    	<td data-bind="text: companyType"></td>
					    	<td>
					    		<input type="text" data-bind="value: companyName, ko_autocomplete: { source: $root.BottleManager().getCompanies, select: $root.BottleManager().setCompanyAutoComplete }"/>
					    		<br/>
					    		Brewery list will appear after typing 3 or more characters or <a class="add !important" href="javascript:return false;" onclick="$('<?php echo '#'.PopupConstants::NewCompanyPopupLinkID; ?>').click(); return false;">Add A Brewery</a>
					    	</td>
					  	</tr>
					  	<tr>
					    	<td data-bind="text: beverageType"></td>
					    	<td>
					    		<select data-bind='options: $root.BottleManager().beers, optionsText: "label", optionsValue: "beverageId", optionsCaption: "Select...", value: beerId'> </select>
					    		<br/>
					    		<?php echo $bottleFormWidget->error($bottleForm,'beerId'); ?>
					    		List will popuplate after selecting a brewery.  If your beer is not shown, <a class="add !important" href="javascript:return false;" onclick="$('<?php echo '#'.PopupConstants::NewBeveragePopupLinkID; ?>').click(); return false;">Add A Beer</a>
					    	</td>
					  	</tr>
	  					<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'fluidAmount'); ?></td>
	    					<td>
	    					<?php 
	    						echo $bottleFormWidget->dropDownList(
									    $bottleForm,
									    'fluidAmount',
					    				BottleSize::getDropdownList(),
										array('data-bind'=>'value: fluidAmount', 'class'=>'bottle-input')); 
							?>
							<?php echo $bottleFormWidget->error($bottleForm,'fluidAmount'); ?>
	    					</td>
	  					</tr>
					  	<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'quantity'); ?></td>
	    					<td><?php echo $bottleFormWidget->textField($bottleForm,'quantity',array('data-bind'=>'value: quantity', 'class'=>'bottle-input', 'placeholder'=>'Quantity of Bottles')); ?>
	    						<?php echo $bottleFormWidget->error($bottleForm,'quantity'); ?>
	    					</td>
	  					</tr>
	  					<tr>
	   	 					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'bottledOnDate'); ?></td>
	    					<td><?php echo $bottleFormWidget->textField($bottleForm,'bottledOnDate',array('data-bind'=>'value: bottledOnDate', 'class'=>'bottle-input', 'placeholder'=>'YYYY-MM-DD, YYYY-MM, or YYYY')); ?>
	    						<?php echo $bottleFormWidget->error($bottleForm,'bottledOnDate'); ?>
	    					</td>
	  					</tr>
					  	<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'purchasePrice'); ?></td>
	    					<td><?php echo $bottleFormWidget->textField($bottleForm,'purchasePrice',array('data-bind'=>'value: purchasePrice', 'class'=>'bottle-input', 'placeholder'=>'Approximate Cost of Bottle')); ?>
								<?php echo $bottleFormWidget->error($bottleForm,'purchasePrice'); ?>
							</td>
	  					</tr>
	  					<tr>
	  						<td><?php echo $bottleFormWidget->labelEx($bottleForm,'isTradeable'); ?></td>
	    					<td><?php echo $bottleFormWidget->dropDownList(
					    		$bottleForm,
					    		'isTradeable',
	    						FormUtils::createDropdownList(array("Yes","No")),
								array('data-bind'=>'value: isTradeable', 'class'=>'bottle-input')); ?>
								<?php echo $bottleFormWidget->error($bottleForm,'isTradeable'); ?>
							</td>
	  					</tr>  
	    				<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'description'); ?></td>
	    					<td><?php echo $bottleFormWidget->textArea($bottleForm,'description',array('data-bind'=>'value: description', 'class'=>'bottle-input', 'placeholder'=>'Describe the beer. Hashtags welcomed!')); ?>
	    					<?php echo $bottleFormWidget->error($bottleForm,'description'); ?>
	    					</td>
	  					</tr>
	  					<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'isPrivate'); ?></td>
	    					<td valign="top"><?php echo $bottleFormWidget->checkbox($bottleForm,'isPrivate',array('data-bind'=>'checked: isPrivate')); ?><span class="black-small"> (Not viewable to any users)</span>
	    									 <?php echo $bottleFormWidget->error($bottleForm,'isPrivate'); ?>
	    					</td>
	  					</tr>
	  					<tr>
	    					<td><?php echo $bottleFormWidget->labelEx($bottleForm,'isSearchable'); ?></td>
	    					<td valign="top"><?php echo $bottleFormWidget->checkbox($bottleForm,'isSearchable',array('data-bind'=>'checked: isSearchable'));  ?><span class="black-small"> (Search results visible to all users)</span>
	    									 <?php echo $bottleFormWidget->error($bottleForm,'isSearchable'); ?>
	    					</td>
	  					</tr>
					</table>
			</div>
		<div style="clear: both; width: 680px; height: 97px; text-align: center;">
			<button class="medium" type="submit" data-bind="click: $root.BottleManager().beforeSave">SAVE</button>
			<button class='medium' onclick='$.magnificPopup.close(); return false;'>CANCEL</button>
		</div>	
		<?php $this->controller->endWidget(); ?>
	</div>
<?php endif; // if($this->renderForm) ?>

<?php 
/* 
* Additional Bottle Info
*
*/?>
<a id="<?php echo $this->moreInfoLinkID; ?>" href="<?php echo '#'.$this->moreInfoPopupID; ?>" class="hidden"></a>
<?php 
//put fancybox on page
$contentSelector = '#'.$this->moreInfoPopupID;
$linkSelector = '#'.$this->moreInfoLinkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=> $contentSelector
));
?>

<div id="<?php echo $this->moreInfoPopupID; ?>" data-bind="with: $root.BottleManager().bottleToView" class="popup mfp-hide view-info">
	<div style="width: 656px; min-height: 530px; background-color: #FFF; padding: 10px; border: 2px solid #000;">
		<div style="width: 160px; height: 160px; margin: 10px auto 0px auto; border: 2px solid #000;">
			<img data-bind='attr:{src: imgSrc}' width='160px' height='160px'>
		</div>
		<div style="width: 620px; min-height: 270px; margin: 0px auto">
			<table class="view-all-info black-medium">
				<tr>
					<td><!-- ko text: companyType --><!-- /ko -->: </td>
					<td><a data-bind="attr: { href: yii.urls.breweryInfo + companyId}, text: companyName"></a></td>
				</tr>
				<tr>
					<td><!-- ko text: beverageType --><!-- /ko --> Label: </td>
					<td><a data-bind="attr: { href: yii.urls.beerInfo + beerId}, text: beverageName"></a></td>
				</tr>
				<tr>
					<td><!-- ko text: beverageType --><!-- /ko --> Style: </td>
					<td>
						<span data-bind="text: styleName, visible: styleName.length > 0"></span>
						<span data-bind="visible: styleName.length == 0">N/A</span>
					</td>
				</tr>
				<tr>
					<td>Fluid Amount: </td>
					<td>
						<span data-bind="text: fluidAmount, visible: fluidAmount.length > 0"></span>
						<span data-bind="visible: fluidAmount.length == 0">N/A</span>
					</td>
				</tr>
				<tr>
					<td>Quantity: </td>
					<td><!-- ko text: quantity --><!-- /ko --></td>
				</tr>
				<tr>
					<td>ABV %: </td>
					<td>
						<span data-bind="text: abv, visible: abv.length > 0"></span>
						<span data-bind="visible: abv.length == 0">N/A</span>
					</td>
				</tr>
				<tr>
					<td>"Bottled On" Date: </td>
					<td><!-- ko text: bottledOnDateDisplay --><!-- /ko --></td>
				</tr>
				<tr>
					<td>Purchase Price: </td>
					<td>
						<span data-bind="visible: purchasePrice > 0">$<!-- ko text: purchasePrice --><!-- /ko --></span>
						<span data-bind="visible: purchasePrice == 0">N/A</span>
					</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td>
						<div data-bind="html: descriptionWithLinks, visible: descriptionWithLinks.length > 0"></div>
						<div data-bind="visible: descriptionWithLinks.length == 0">N/A</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="view-all-info-close">
			<button class='medium' onclick='$.magnificPopup.close(); return false;'>CLOSE</button>
		</div>
	</div>			
</div>
	
<!-- Knockout UI code -->
<script type='text/javascript'>		
$(window).bind("load", function() {
	var _BottleManager = function () {
	    var self = this;
	    self.selectedBeverage = ko.observable();
	    self.beers = ko.observableArray();
	    self.resetOnClose = ko.observable(true);
	    self.bottleToEdit = ko.observable(<?php echo json_encode(KnockoutBottle::MakeEmptyData()); ?>);
	    self.bottleToView = ko.observable(<?php echo json_encode(KnockoutBottle::MakeEmptyData()); ?>);

		self.suspendPopup = function() {
		   	self.resetOnClose(false);
		}
		
		self.restorePopup = function() {
		   	self.resetOnClose(true);
		}
		
	    self.resetBottle = function() {
		    if (self.resetOnClose()) {
	        	self.bottleToEdit(<?php echo json_encode(KnockoutBottle::MakeEmptyData()); ?>);
	        	self.beers([]);
		    }
	    }
	    self.refreshAfterError = function(imgUrl) {
	        self.bottleToEdit(<?php echo json_encode(KnockoutBottle::MakeDataWithForm($bottleForm)); ?>);
	    }
	    self.setImageUrl = function(filename, fileurl) {
	    	self.bottleToEdit().imgSrc = fileurl;
	    	self.bottleToEdit().imageName = filename;
		    self.bottleToEdit.valueHasMutated();
	    }
	    self.editBottle = function (item) {
	        self.bottleToEdit(item);
		}
	    self.makeOffer = function (item) {
	    	 window.location='<?php echo UrlUtils::generateUrl(UrlUtils::TradeProposeUri,"/"); ?>' + item.bottleId;
	    }
	    self.addBottle = function () {
	    	self.bottleToEdit(<?php echo json_encode(KnockoutBottle::MakeEmptyData()); ?>);
	    }
	    self.openPopup = function () {
	    	$(bottletrade.popups.bottle).click(); 
	    	return false;
	    }
	    self.viewMoreInfo = function (item) {
		    item.descriptionWithLinks = self.getDescriptionWithLinks(item.description);
		    item.year = item.bottledOnDate.substr(0,4);
		    self.bottleToView(item);
	    }
	    self.deleteBottle = function (item) {
	    	if (confirm('Are you sure you want to delete this bottle')) {
	    	 	window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarDeleteUri,"/"); ?>' + item.bottleId;
	    	}
	    	return false;
	    }
	    self.beverageTypeChanged = function (event) {
	    	if (self.bottleToEdit() == null) {
		    	return; // nothing to do
	    	}
		    self.bottleToEdit.valueHasMutated();
		    
		    if (self.isBeer()) {
			    self.bottleToEdit().companyType = '<?php echo CompanyType::BREWERY; ?>';
		    }
		    else if (self.isWine()) {
			    self.bottleToEdit().companyType = '<?php echo CompanyType::WINERY; ?>';
		    }
		    else if (self.isSpirit()) {
			    self.bottleToEdit().companyType = '<?php echo CompanyType::DISTILLERY; ?>';
		    }
		    self.bottleToEdit.valueHasMutated();
	    }
	    
	    self.isBeer = ko.computed(function(){
	    	if (self.bottleToEdit() == null) return false;
	    	return self.bottleToEdit().beverageType == '<?php echo BeverageType::BEER; ?>';
	    }, this);
	    
	    self.isWine = ko.computed(function(){
	    	if (self.bottleToEdit() == null) return false;
	    	return self.bottleToEdit().beverageType == '<?php echo BeverageType::WINE; ?>';
	    }, this);
	    
	    self.isSpirit = ko.computed(function(){
	    	if (self.bottleToEdit() == null) return false;
	    	return self.bottleToEdit().beverageType == '<?php echo BeverageType::SPIRIT; ?>';
	    }, this);

	    self.getDescriptionWithLinks = function(inputStr) {
	    	if (inputStr == null || inputStr.length == 0) return "";
	    	
	    	var pattern = '';
	    	var replacement = '<a class="hashtag" href="' + '<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri, "/"); ?>' + '$1">#$1</a>';
	    	var ret = inputStr.replace(/#(\w+)/gi, replacement);
	    	return ret;
	    }
	    
	    self.getCompanies = function(request, response) {
		    if (request == null || request.term.length < 3) {
			    return;
		    }
		    var apiUrl = "<?php echo UrlUtils::generateUrl(UrlUtils::ApiBreweriesUri);?>" + request.term;
	    	$.ajax({
	    	    type: 'GET',
	    	    url: apiUrl,
	    	    dataType: 'json',
	    	    success: function(data){
	    	    	response($.map(data, function(company) {
                        return {
                            companyId: company.ID,
                            label: company.Name
                        };
                    }));
	    	    }
	    	});
	    }

	    self.popuplateBeers = function(companyId) {
	    	var apiUrl = "<?php echo UrlUtils::generateUrl(UrlUtils::ApiBeersUri, "/");?>" + companyId;
	    	$.ajax({
	    	    type: 'GET',
	    	    url: apiUrl,
	    	    dataType: 'json',
	    	    async: false,
	    	    success: function(data){
	    	    	KnockoutManager.BottleManager().beers($.map(data, function(beverage) {
                        return {
                            beverageId: beverage.ID,
                            label: beverage.Name
                        };
                    }));
	    	    }
	    	});
	    }
	    
	    self.setCompanyAutoComplete = function(event, ui) {
	    	self.setCompany(ui.item.companyId, ui.item.label);
	    }

	    self.setCompany = function(id, name) {
		    if (self.bottleToEdit().companyId != id) {
		    	self.bottleToEdit().companyName = name;
		    	self.bottleToEdit().beverageName = "";
		    	self.bottleToEdit().beerId = "";
		    	self.bottleToEdit().companyId = id;
			    self.popuplateBeers(id);
			    self.bottleToEdit.valueHasMutated();
		    }
	    }

	    self.setBeverage = function(id) {
		    if (self.isBeer()) {
			    self.bottleToEdit().beerId = id;
		    } else if (self.isWine()) {
		    } else if (self.isSpirit()) {
		    }
			self.bottleToEdit.valueHasMutated();
	    }

	    self.beforeSave = function() {
		    $('#bottleFormBeerId').val(self.bottleToEdit().beerId);
		    return true;
	    }
	    
	    self.bottleToEdit.subscribe(function(bottle) {
		    if (bottle.companyId > 0) {
		    	self.popuplateBeers(bottle.companyId);
		    }
	    }.bind(this));
	};
	
	// have magnific popup reset form before closing
	$('#<?php echo $this->linkID; ?>').on('mfpBeforeClose', function(e /*, params */) {
		KnockoutManager.BottleManager().resetBottle();
	});
	
	KnockoutManager.BottleManager(new _BottleManager());
});
</script>

<?php
// trigger popup to open if errors exist, can only occur if form is rendered
if($this->renderForm) {
	$contentSelector = '#'.$this->editPopupID;
	$linkSelector = '#'.$this->editLinkID;
	Yii::app()->clientScript->registerScript($this->popupID, "
		$(window).bind('load', function() {
			var errorMsgs = $('$contentSelector div.errorMessage');
			if (errorMsgs.length > 0) {
				for (i = 0; i < errorMsgs.length; ++i) {
					if ($(errorMsgs[i]).css('display') != 'none') {
						KnockoutManager.BottleManager().refreshAfterError();
						$('$linkSelector').click();
						return false;
					}
				}
			}
		});");
}
?>

