<a id="<?php echo $this->linkID; ?>" href="<?php echo '#'.$this->popupID; ?>" class="hidden"></a>
<?php 
$contentSelector = '#'.$this->popupID;
$linkSelector = '#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>
<div>
	<div id="<?php echo $this->popupID; ?>" data-bind="with: $root.NewBeverageManager().beverage" class="popup mfp-hide">
		<?php $beverageFormWidget=$this->beginWidget('CActiveForm', array(
		                                                    'id'=>$this->formID,
		                                                    'enableAjaxValidation'=>true
		                                                    )); ?>
			<?php echo $beverageFormWidget->hiddenField($beverageForm,'breweryId',array('id'=>'beverageFormBreweryId','data-bind'=>'value: breweryId')); ?>
			<?php echo $beverageFormWidget->hiddenField($beverageForm,'wineryId',array('id'=>'beverageFormWineryId','data-bind'=>'value: wineryId')); ?>
			<?php echo $beverageFormWidget->hiddenField($beverageForm,'distilleryId',array('id'=>'beverageFormDistilleryId','data-bind'=>'value: distilleryId')); ?>
			<?php echo $beverageFormWidget->hiddenField($beverageForm,'companyName',array('id'=>'beverageFormCompanyName','data-bind'=>'value: companyName')); ?>
		<div style="text-align: center;">
			<img src="<?php echo UrlUtils::generateImageUrl("add_beer/title_icon.png"); ?>" width="180" height="140"/>
		</div>
			<div style="width: 250px; height: 300px; float: left; padding: 100px 10px 0px 10px; text-align: center;">
				<img src="<?php echo UrlUtils::generateImageUrl("add_beer/copy.png"); ?>" width="151" height="243"/>
			</div>
			<div style="min-width: 400px; min-height: 400px; float: left; text-align: center; margin-top: 30px; margin-bottom: 10px;">
				<table class="popup-input-field">
					<?php /*<tr>
					   	<td align="right"><?php echo $beverageFormWidget->labelEx($beverageForm,'type'); ?></td>
				    	<td align="left"><?php echo $beverageFormWidget->dropDownList(
								    $beverageForm,
								    'beverageType',
				    				FormUtils::createDropdownList(BeverageType::getAllTypes()),
									array('class'=>'bottle_input', 'data-bind'=>'value: beverageType, event: { change: beverageTypeChanged }')); ?>
						</td>
				  	</tr> */ ?>
				  	<tr>
				    	<td data-bind="text: companyType"></td>
				    	<td>
				    		<input type="text" class="bottle_input" data-bind="value: companyName, ko_autocomplete: { source: $root.NewBeverageManager().getCompanies, select: $root.NewBeverageManager().setCompany }"/>
				    		<br/>
				    		<?php echo $beverageFormWidget->error($beverageForm, 'breweryId'); ?>
					    	<span class="help-text">Brewery will list after typing 3 characters or <a class="add" href="javascript:return false;" onclick="$('<?php echo '#'.PopupConstants::NewCompanyPopupLinkID; ?>').click(); return false;">Add A Brewery</a></span>
				    	</td>
				  	</tr>
					<tr>
				    	<td data-bind="text: beverageType + ' Label'"></td>
				    	<td><?php echo $beverageFormWidget->textField($beverageForm,'name', array('data-bind'=>'value: label')); ?>
				    		<?php echo $beverageFormWidget->error($beverageForm, 'name'); ?></td>
				  	</tr>
					<tr>
				    	<td data-bind="text: beverageType + ' Style'"></td>
		    			<td><?php 
							    echo $beverageFormWidget->dropDownList($beverageForm,
							      'styleId',
							      CHtml::listData(Beerstyle::model()->findAll(array('order'=>'Name')),'ID','Name')
							    );
						?>
						<?php echo $beverageFormWidget->error($beverageForm, 'styleId'); ?>
						</td>
		    		</tr>
					<tr>
		    			<td><?php echo $beverageFormWidget->labelEx($beverageForm,'abv'); ?></td>
		    			<td><?php echo $beverageFormWidget->textField($beverageForm,'abv', array('data-bind'=>'value: abv')); ?>
						<?php echo $beverageFormWidget->error($beverageForm, 'abv'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $beverageFormWidget->labelEx($beverageForm,'ibu'); ?></td>
		    			<td><?php echo $beverageFormWidget->textField($beverageForm,'ibu', array('data-bind'=>'value: ibu')); ?>
						<?php echo $beverageFormWidget->error($beverageForm, 'ibu'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $beverageFormWidget->labelEx($beverageForm,'srm'); ?></td>
		    			<td><?php echo $beverageFormWidget->textField($beverageForm,'srm', array('data-bind'=>'value: srm')); ?>
						<?php echo $beverageFormWidget->error($beverageForm, 'srm'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $beverageFormWidget->labelEx($beverageForm,'upc'); ?></td>
		    			<td><?php echo $beverageFormWidget->textField($beverageForm,'upc', array('data-bind'=>'value: upc')); ?>
						<?php echo $beverageFormWidget->error($beverageForm, 'upc'); ?></td>
		  			</tr>
		  			<tr>
					   	<td><?php echo $beverageFormWidget->labelEx($beverageForm,'availability'); ?></td>
				    	<td><?php echo $beverageFormWidget->dropDownList(
								    $beverageForm,
								    'availability',
				    				FormUtils::createDropdownList(BeerAvailability::getAllTypes()),
									array('class'=>'bottle_input', 'data-bind'=>'value: availability')); ?>
						<?php echo $beverageFormWidget->error($beverageForm, 'availability'); ?>
						</td>
				  	</tr>
					<tr>
		    			<td><?php echo $beverageFormWidget->labelEx($beverageForm,'description'); ?></td>
		    			<td><?php echo $beverageFormWidget->textArea($beverageForm,'description', array('data-bind'=>'value: description')); ?>
							<?php echo $beverageFormWidget->error($beverageForm, 'description'); ?>
						</td>
		  			</tr>
					<tr>
						<td colspan="2" align="center">
							<button class="medium" type="submit">ADD</button>
							<button class='medium' onclick="$.magnificPopup.close(); return false;">CANCEL</button>
						</td>
					</tr>
				</table>
			</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

<!-- Knockout UI code -->
<script type='text/javascript'>		
$(window).bind("load", function() {
	var BeverageData =	{
	   	"beverageForm": <?php 
	   		echo json_encode(NewBeverageForm::MakeDisplayDataWithForm($beverageForm)); 
	   	?>,
	   	"beverageEmpty": <?php 
	   		echo json_encode(NewBeverageForm::MakeEmptyDisplayData()); 
	   	?>
	};
	
	var BeverageEditor = function () {
	    var self = this;
	    self.selectedCompanyId = ko.observable();
	    self.beverage = ko.observable(BeverageData.beverageForm);
	    self.resetBeverage = function() {
	        self.beverage(jQuery.extend(true, {}, BeverageData.beverageEmpty));
	    }
	    self.refreshAfterError = function() {
	        self.beverage(BeverageData.beverageForm);
	        self.selectedCompanyId(self.beverage().companyId);
		    self.beverage.valueHasMutated();
	    }
	    self.beverageTypeChanged = function (event) {
	    	if (self.beverage() == null) {
		    	return; // nothing to do
	    	}

		    self.beverage.valueHasMutated();
		    if (self.isBeer()) {
			    self.beverage().companyType = '<?php echo CompanyType::BREWERY; ?>';
		    }
		    else if (self.isWine()) {
			    self.beverage().companyType = '<?php echo CompanyType::WINERY; ?>';
		    }
		    else if (self.isSpirit()) {
			    self.beverage().companyType = '<?php echo CompanyType::DISTILLERY; ?>';
		    }
		    self.beverage.valueHasMutated();
	    }
	    
	    self.isBeer = ko.computed(function(){
	    	if (self.beverage() == null) return false;
	    	return self.beverage().beverageType == '<?php echo BeverageType::BEER; ?>';
	    }, this);
	    
	    self.isWine = ko.computed(function(){
	    	if (self.beverage() == null) return false;
	    	return self.beverage().beverageType == '<?php echo BeverageType::WINE; ?>';
	    }, this);
	    
	    self.isSpirit = ko.computed(function(){
	    	if (self.beverage() == null) return false;
	    	return self.beverage().beverageType == '<?php echo BeverageType::SPIRIT; ?>';
	    }, this);
	    
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
	    
	    self.setCompany = function(event, ui) {
		    $("#beverageFormCompanyName").val(ui.item.label);
		    if (self.isBeer()) {
			    $("#beverageFormBreweryId").val(ui.item.companyId);
		    } else if (self.isWine()) {
			    $("#beverageFormWineryId").val(ui.item.companyId);
		    } else if (self.isSpirit()) {
			    $("#beverageFormDistilleryId").val(ui.item.companyId);
		    }
	    }
	};

	// have magnific popup reset form before closing
	$('#<?php echo $this->linkID; ?>').on('mfpBeforeClose', function(e /*, params */) {
		KnockoutManager.NewBeverageManager().resetBeverage();
	});

	KnockoutManager.NewBeverageManager(new BeverageEditor());
});
</script>

<?php 
	Yii::app()->clientScript->registerScript($this->popupID, "
		$(window).bind('load', function() {
			var errorMsgs = $('$contentSelector div.errorMessage');
			if (errorMsgs.length > 0) {
				for (i = 0; i < errorMsgs.length; ++i) {
					if ($(errorMsgs[i]).css('display') != 'none') {
						KnockoutManager.NewBeverageManager().refreshAfterError();
						$('$linkSelector').click();
						return false;
					}
				}
			}
		});");
?>