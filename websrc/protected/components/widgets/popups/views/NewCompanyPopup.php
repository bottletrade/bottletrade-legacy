<a id="<?php echo $this->linkID; ?>" href="<?php echo '#'.$this->popupID; ?>" class="hidden"></a>
<?php 
$contentSelector = '#'.$this->popupID;
$linkSelector = '#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>
<div data-bind="with: KnockoutManager.NewCompanyManager()">
	<div id="<?php echo $this->popupID; ?>" data-bind="with: company" class="popup mfp-hide">
		<?php $companyFormWidget=$this->beginWidget('CActiveForm', array(
		                                                    'id'=>$this->formID,
		                                                    'enableAjaxValidation'=>true
		                                                    )); ?>
		<div style="text-align: center;">
			<img src="<?php echo UrlUtils::generateImageUrl("add_brewery/title_icon.png"); ?>" width="180" height="140"/>
		</div>
		<div style="width: 250px; height: 541px; float: left; padding: 0px 10px 10px 10px; text-align: center;">
			<img src="<?php echo UrlUtils::generateImageUrl("add_brewery/copy.png"); ?>" width="213" height="541"/>
		</div>
			<div style="min-width: 400px; min-height: 400px; float: left; text-align: center; margin-top: 30px; margin-bottom: 10px;">
				<table class="popup-input-field">
					<?php /*<tr>
					   	<td align="right"><?php echo $companyFormWidget->labelEx($companyForm,'type'); ?></td>
				    	<td align="left"><?php echo $companyFormWidget->dropDownList(
								    $companyForm,
								    'type',
				    				FormUtils::createDropdownList(CompanyType::getAllTypes()),
									array('class'=>'bottle_input', 'data-bind'=>'value: companyType, event: { change: companyTypeChanged }')); ?>
						</td>
				  	</tr> */?>
					<tr>
				    	<td data-bind="text: companyType + ' Name'"></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'name'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'name'); ?>
		    			</td>
		  			</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'description'); ?></td>
		    			<td><?php echo $companyFormWidget->textArea($companyForm,'description'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'description'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'established'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'established'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'established'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'website'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'website'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'website'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'address1'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'address1'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'address1'); ?></td>
		  			</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'address2'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'address2'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'address2'); ?></td>
					</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'city'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'city'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'city'); ?></td>
					</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'state'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'state'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'state'); ?></td>
					</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'code'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'code'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'code'); ?></td>
					</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'country'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'country'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'country'); ?></td>
					</tr>
					<tr>
		    			<td><?php echo $companyFormWidget->labelEx($companyForm,'phone'); ?></td>
		    			<td><?php echo $companyFormWidget->textField($companyForm,'phone'); ?>
		    			<?php echo $companyFormWidget->error($companyForm,'phone'); ?></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<button class="medium" type="submit">ADD</button>
						<button class="medium" onclick="$.magnificPopup.close(); return false;">CANCEL</button>
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
	var CompanyData =	{
	   	"companyForm": <?php 
	   		echo json_encode(NewCompanyForm::MakeDisplayDataWithForm($companyForm)); 
	   	?>,
	   	"companyEmpty": <?php 
	   		echo json_encode(NewCompanyForm::MakeEmptyDisplayData()); 
	   	?>
	};
	
	var CompanyEditor = function () {
	    var self = this;
	    self.company = ko.observable(CompanyData.companyForm);
	    self.resetCompany = function() {
	        self.company(jQuery.extend(true, {}, CompanyData.companyEmpty));
	    }
	    self.companyTypeChanged = function (event) {
	    	if (self.company() == null) {
		    	return; // nothing to do
	    	}

		    self.company.valueHasMutated();
		    if (self.isBrewery()) {
			    self.company().companyType = '<?php echo CompanyType::BREWERY; ?>';
		    }
		    else if (self.isWinery()) {
			    self.company().companyType = '<?php echo CompanyType::WINERY; ?>';
		    }
		    else if (self.isDistillery()) {
			    self.company().companyType = '<?php echo CompanyType::DISTILLERY; ?>';
		    }
		    self.company.valueHasMutated();
	    }
	    
	    self.isBrewery = ko.computed(function(){
	    	if (self.company() == null) return false;
	    	return self.company().companyType == '<?php echo CompanyType::BREWERY; ?>';
	    }, this);
	    
	    self.isWinery = ko.computed(function(){
	    	if (self.company() == null) return false;
	    	return self.company().companyType == '<?php echo CompanyType::WINERY; ?>';
	    }, this);
	    
	    self.isDistillery = ko.computed(function(){
	    	if (self.company() == null) return false;
	    	return self.company().companyType == '<?php echo CompanyType::DISTILLERY; ?>';
	    }, this);
	};

	// have magnific popup reset form before closing
	$('#<?php echo $this->linkID; ?>').on('mfpBeforeClose', function(e /*, params */) {
		KnockoutManager.NewCompanyManager().resetCompany();
	});

	KnockoutManager.NewCompanyManager(new CompanyEditor());
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