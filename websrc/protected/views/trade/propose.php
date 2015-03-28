<?php
$this->pageTitle=Yii::app()->name . ' - Propose Trade';
?>

<!--PRELOAD THESE IMAGES-->
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/propose_trade/plus-over.png"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/propose_trade/minus-over.png"); ?>">
<!--END PRELOAD-->

<div class="top-bar">
	<div class="PT-title-holder">	
		<span class="white-title ti-medium">PROPOSE TRADE</span>
	</div>
	<div class="PT-copy-holder">
		<span class="tp_title">Make an offer by adding bottles from your Cyber Cellar below.</span>
	</div>
</div>

<div data-bind="with: $root.TradeManager()">
	<?php 
			$this->widget('application.components.widgets.popups.IsoPopup', array('user'=>$otherUser));
	?>
	<!-- BOTTLES UP FOR TRADE -->
	<div class="up-for-trade">
		<div class="PT-subtitle-holder-L">
			<span class="white-title ti-small">MY CELLAR</span>
		</div>
		<div class="PT-subtitle-holder-R">
			<span class="white-title ti-small"><?php echo StringUtils::createSingularPossessionText($otherUser->Username);?> CELLAR</span>
		</div>
	</div>
	<div class="up-for-trade">
			<div class="PT-bottle-background" style="float:left;">
				<div>
					<div data-bind="visible: currUserBottlesProposed().length == 0">
						<span class="black">No Bottles Selected</span>
					</div>
					<div data-bind='template: { foreach: currUserBottlesProposed,
				                          	 beforeRemove: hideBottleElement,
				                          	 afterAdd: showBottleElement }'>
				   	 	<div data-bind='attr: { "class": "bottle" }'>
							<div class="PT-bottle-holder">
								<div class="PT-bottle-image-holder">
									<img data-bind="attr: { src: ImageUrl }" width='60' height='60' />
								</div>
								<div class="PT-bottle-info">
									<span class="black"><!-- ko text: Year --><!-- /ko --> | <!-- ko text: Label --><!-- /ko --> | <!-- ko text: CompanyName --><!-- /ko --></span>
									<br />
									<span class="black-mini">Location: <!-- ko text: CompanyCityState --><!-- /ko -->
									<br />
									Style: <!-- ko text: StyleName --><!-- /ko -->
									<br />
									ABV: 
										<span data-bind="text: ABV, visible: ABV > 0"></span>
										<span data-bind="visible: ABV == 0">N/A</span> 
									| Size: <!-- ko text: Amount --><!-- /ko --> | Amount: <!-- ko text: MaxQuantity --><!-- /ko --></span>
								</div>
								<div class="PT-bottle-buttons">
										<span class="black">Offering:</span>
										<div style="width: 68px; height: auto; margin: 3px auto 5px auto;">
											<button style="float: left;" class="minus" data-bind='click: subtract, disable: hasReachedMinQuantity()'></button>
											<span class="black-large"><!-- ko text: Quantity --><!-- /ko --></span>
											<button style="float: right;" class="plus" data-bind='click: addBottle, disable: hasReachedMaxQuantity()'></button><br />
										</div>
											<button class="mini-box" data-bind='click: deselectBottle'>Remove</button>
								</div>
							</div>
						</div>
						<div class="horizontal-divide"></div>
					</div>
				</div>
			</div>
			<div class="PT-bottle-background" style="float:right;">
				<div data-bind="visible: otherUserBottlesProposed().length == 0"><span class="black">No Bottles Selected</span></div>
				<div data-bind='template: { foreach: otherUserBottlesProposed,
			                            beforeRemove: hideBottleElement,
			                            afterAdd: showBottleElement }'>
			    <div data-bind='attr: { "class": "bottle" }'>
					<div class="PT-bottle-holder">
						<div class="PT-bottle-image-holder">
							<img data-bind="attr: { src: ImageUrl }" width='60' height='60' />
						</div>
						<div class="PT-bottle-info">
							<span class="black"><!-- ko text: Year --><!-- /ko --> | <!-- ko text: Label --><!-- /ko --> | <!-- ko text: CompanyName --><!-- /ko --></span>
							<br />
							<span class="black-mini">Location: <!-- ko text: CompanyCityState --><!-- /ko -->
							<br />
							Style: <!-- ko text: StyleName --><!-- /ko -->
							<br />
							ABV: 
								<span data-bind="text: ABV, visible: ABV > 0"></span>
								<span data-bind="visible: ABV == 0">N/A</span> 
							| Size: <!-- ko text: Amount --><!-- /ko --><!-- ko text: AmountType --><!-- /ko --> | Amount: <!-- ko text: MaxQuantity --><!-- /ko --></span>
						</div>
						<div class="PT-bottle-buttons">
							<span class="black">Receiving:</span>
							<div style="width: 68px; height: auto; margin: 3px auto 5px auto;">
								<button style="float: left;" class="minus" data-bind='click: subtract, disable: hasReachedMinQuantity()'></button>
								<span class="black-large"><!-- ko text: Quantity --><!-- /ko --></span>
								<button style="float: right;" class="plus" data-bind='click: addBottle, disable: hasReachedMaxQuantity()'></button><br />
							</div>
								<button class="mini-box" data-bind='click: deselectBottle'>Remove</button>
							
						</div>
					</div>
				</div>
				<div class="horizontal-divide"></div>
			</div>
			</div>
	</div>
	<div style="width: 910px">
		<img src="<?php echo UrlUtils::generateImageUrl("propose_trade/trans_divide.png"); ?>" width="910" height="2"/>
	</div>
	<br />
	<!--MESSAGE BOX AND PROPOSE BUTTON -->
	
	<div class="PT-message-holder">
		<div style="float: left; width: 465px; height: auto;">
			<span class="white-title ti-small">MESSAGE:</span><br />
			<span class="black">(Add a message to send along with your proposal)</span><br />
			<textarea class="tp_message" data-bind="value: message"></textarea>
		</div>
		<div style="float: right; width: 425px; padding: 10px; text-align: left;">
			<span class="black">When you create a valid trade the following button will light up! Once this happens you may submit your trade to the other user.</span><br />
			<button class="medium" data-bind='click: save, disable: !isValidTrade() || isTradeSaving()'>PROPOSE TRADE</button>
			<button class="medium" style="width: auto;" onclick="$(bottletrade.popups.iso).click();">VIEW USER'S ISO LIST</button>
			<img class="loading medium" data-bind='visible: isTradeSaving' src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
		</div>
	</div>
	
	<?php /* Not necessary until we support other beverage types
	
	<!--CHOOSE TYPE -->
	<div style="clear: both; width: 940px; height: 30px; padding-top: 5px; text-align: left; margin-left: 10px;">
		<span class="black">
		    Type:
		    <label><input type='radio' name="BeverageType" value='All' data-bind='checked: BeverageTypeToShow' />All</label>
		    <?php 
		    	$types = BeverageType::getAllTypes();
		    	foreach($types as $type) {
			?>
				<label><input type='radio' name="BeverageType" value='<?php echo $type; ?>' data-bind='checked: BeverageTypeToShow' /><?php echo $type; ?></label>
		    <?php 
				}
			?>
		</span>
	</div>
	*/?>
	
	<!--CYBER CELLARS -->
	
	<div class="up-for-trade">
		<div class="PT-subtitle-holder-L">
			<span class="white-title ti-small">MY CELLAR</span>
		</div>
		<div class="PT-subtitle-holder-R">
			<span class="white-title ti-small"><?php echo StringUtils::createSingularPossessionText($otherUser->Username);?> CELLAR</span>
		</div>
	</div>
	<div style="width: 940px; min-height: 350px;">
		<div style="float: left; width: 465px; height: auto;">
			<div class="PT-bottle-background">	
				<div data-bind="visible: currUserBottlesToShow().length == 0">
					<span class="black">
						<span data-bind="visible: BeverageTypeToShow() == 'All'">
							No Bottles To Select <br />Add Bottles To Your Cyber Cellar
						</span>
						<span data-bind="visible: BeverageTypeToShow() != 'All'">
							No <!-- ko text: BeverageTypeToShow() --><!-- /ko -->s To Select <br />Add <!-- ko text: BeverageTypeToShow() --><!-- /ko -->s To Your Cyber Cellar
						</span>
					</span>
				</div>
				<div data-bind='template: { foreach: currUserBottlesToShow,
				                            beforeRemove: hideBottleElement,
				                            afterAdd: showBottleElement }'>
				    <div data-bind='attr: { "class": "bottle" }'>
						<div class="PT-bottle-holder">
								<div class="PT-bottle-image-holder">
								<img data-bind="attr: { src: ImageUrl }" width='60' height='60' />
							</div>
				
							<div class="PT-bottle-info">
							<span class="black"><!-- ko text: Year --><!-- /ko --> | <!-- ko text: Label --><!-- /ko --> | <!-- ko text: CompanyName --><!-- /ko --></span>
							<br/>
							<span class="black-mini">Location: <!-- ko text: CompanyCityState --><!-- /ko --></span>
							<br/>
							<span class="black-mini">Style: <!-- ko text: StyleName --><!-- /ko -->
							<br />
							ABV: 
								<span data-bind="text: ABV, visible: ABV > 0"></span>
								<span data-bind="visible: ABV == 0">N/A</span> 
							| Size: <!-- ko text: Amount --><!-- /ko --><!-- ko text: AmountType --><!-- /ko --> | Amount: <!-- ko text: MaxQuantity --><!-- /ko --></span>
							</div>
							<div class="PT-bottle-buttons">
								<button class="box" data-bind='click: selectBottle'>Add To<br />Trade</button>
							</div>
						</div>
					</div>
					<div class="horizontal-divide"></div>
				</div>
			</div>
		</div>
		<div style="float: right; width: 465px; height: auto;">
			<div class="PT-bottle-background">
				<div data-bind="visible: otherUserBottlesToShow().length == 0">
					<span class="black">
						<span data-bind="visible: BeverageTypeToShow() == 'All'">
							No Bottles To Select <br />
						</span>
						<span data-bind="visible: BeverageTypeToShow() != 'All'">
							No <!-- ko text: BeverageTypeToShow() --><!-- /ko -->s To Select <br />Try Selecting a Different Type of Bottle Above
						</span>
					</span>
				</div>
				<div data-bind='template: { foreach: otherUserBottlesToShow,
			                            beforeRemove: hideBottleElement,
			                            afterAdd: showBottleElement }'>
			    	<div data-bind='attr: { "class": "bottle" }'>
						<div class="PT-bottle-holder">
								<div class="PT-bottle-image-holder">
								<img data-bind="attr: { src: ImageUrl }" width='60' height='60' />
							</div>
							<div class="PT-bottle-info">
							<span class="black"><!-- ko text: Year --><!-- /ko --> | <!-- ko text: Label --><!-- /ko --> | <!-- ko text: CompanyName --><!-- /ko --></span>
							<br/>
							<span class="black-mini">Location: <!-- ko text: CompanyCityState --><!-- /ko --></span>
							<br/>
							<span class="black-mini">Style: <!-- ko text: StyleName --><!-- /ko -->
							<br />
							ABV: 
								<span data-bind="text: ABV, visible: ABV > 0"></span>
								<span data-bind="visible: ABV == 0">N/A</span> 
							| Size: <!-- ko text: Amount --><!-- /ko --><!-- ko text: AmountType --><!-- /ko --> | Amount: <!-- ko text: MaxQuantity --><!-- /ko --></span>
						</div>
							<div class="PT-bottle-buttons">
							<button class="box" data-bind='click: selectBottle'>Add To<br />Trade</button>
							</div>
						</div>
					</div>
					<div class="horizontal-divide"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	var BottleModel = function(bottle) {
		var self = this;
    	self.ID = bottle.ID;
    	self.ImageUrl = bottle.ImageUrl;
    	self.Label = bottle.Label;
    	self.Year = bottle.Year;
    	self.ABV = bottle.ABV;
    	self.Amount = bottle.Amount;
    	self.AmountType = bottle.AmountType;
    	self.CompanyName = bottle.CompanyName;
    	self.CompanyCityState = bottle.CompanyCityState;
    	self.StyleName = bottle.StyleName;
    	self.Type = bottle.Type;
    	self.Quantity = ko.observable(bottle.Quantity);
    	self.MaxQuantity = bottle.MaxQuantity;
    	self.Selected = ko.observable(bottle.Selected);

    	self.selectBottle = function() {
			self.Selected(true);
	    };

	    self.deselectBottle = function() {
			self.Selected(false);
			self.Quantity(0);
	    };

		self.addBottle = function() {
			self.Quantity(self.Quantity() + 1);
	    };

	    self.subtract = function() {
			self.Quantity(self.Quantity() - 1);
	    };

	    self.hasReachedMaxQuantity = ko.computed(function() {
	    	return self.Quantity() == self.MaxQuantity;
	    });

	    self.hasReachedMinQuantity = ko.computed(function() {
	    	return self.Quantity() == 0;
	    });
	}
	
	var TradeModel = function() {
		var self = this;
		self.message = ko.observable("");
		self.currUserBottles = ko.observableArray([
	        <?php foreach ($currUserBottles as $bottle) {
	        	$bottleInfo = array();
	        	$bottleInfo["ID"] = $bottle->ID;
	        	$bottleInfo["ImageUrl"] = ImageManager::getImageUrlStatic($bottle);
	        	$bottleInfo["Label"] = Bottle::getBeverageName($bottle);
	        	$bottleInfo["Year"] = Bottle::getBottledOnYear($bottle);
	        	$bottleInfo["ABV"] = $bottle->beer->ABV;
	        	$bottleInfo["Amount"] = $bottle->FluidAmount;
	        	$bottleInfo["CompanyName"] = Bottle::getCompanyName($bottle);
	        	$bottleInfo["CompanyCityState"] = Bottle::getCompanyCityStateDisplay($bottle, ", ", "", "");
	        	$bottleInfo["StyleName"] = Bottle::getStyleName($bottle);
	        	$bottleInfo["Type"] = Bottle::getBeverageType($bottle);
	        	$bottleInfo["Quantity"] = 0;
	        	$bottleInfo["MaxQuantity"] = $bottle->Quantity;
	        	$bottleInfo["Selected"] = !empty($selectedBottleId) ? $bottle->ID == $selectedBottleId : false;
				echo "new BottleModel(".json_encode($bottleInfo)."),";
	        } ?>
	    ]);

		self.otherUserBottles = ko.observableArray([
			<?php foreach ($otherUserBottles as $bottle) {
	        	$bottleInfo = array();
	        	$bottleInfo["ID"] = $bottle->ID;
	        	$bottleInfo["ImageUrl"] = ImageManager::getImageUrlStatic($bottle);
	        	$bottleInfo["Label"] = Bottle::getBeverageName($bottle);
	        	$bottleInfo["Year"] = Bottle::getBottledOnYear($bottle);
	        	$bottleInfo["ABV"] = $bottle->beer->ABV;
	        	$bottleInfo["Amount"] = $bottle->FluidAmount;
	        	$bottleInfo["CompanyName"] = Bottle::getCompanyName($bottle);
	        	$bottleInfo["CompanyCityState"] = Bottle::getCompanyCityStateDisplay($bottle, ", ", "", "");
	        	$bottleInfo["StyleName"] = Bottle::getStyleName($bottle);
	        	$bottleInfo["Type"] = Bottle::getBeverageType($bottle);
	        	$bottleInfo["Quantity"] = 0;
	        	$bottleInfo["MaxQuantity"] = $bottle->Quantity;
	        	$bottleInfo["Selected"] = !empty($selectedBottleId) ? $bottle->ID == $selectedBottleId : false;
				echo "new BottleModel(".json_encode($bottleInfo)."),";
			} ?>
	    ]);

		self.isTradeProgressing = ko.observable(false);
		self.BeverageTypeToShow = ko.observable("All");

		self.currUserBottlesProposed = ko.computed(function() {
			return ko.utils.arrayFilter(this.currUserBottles(), function(bottle) {
	            return bottle.Selected();
	        });
		}, this);
		
		self.otherUserBottlesProposed = ko.computed(function() {
			return ko.utils.arrayFilter(this.otherUserBottles(), function(bottle) {
	            return bottle.Selected();
	        });
		}, this);
	 
	    self.currUserBottlesToShow = ko.computed(function() {
	        // Represents a filtered list of bottles
	        var desiredBeverageType = this.BeverageTypeToShow();
	        if (desiredBeverageType == "All") {
		        return ko.utils.arrayFilter(this.currUserBottles(), function(bottle) {
		            return !bottle.Selected();
		        });
	        } else {
		        return ko.utils.arrayFilter(this.currUserBottles(), function(bottle) {
		            return !bottle.Selected() && bottle.Type == desiredBeverageType;
		        });
	        }
	    }, this);

	    self.otherUserBottlesToShow = ko.computed(function() {
	    	// Represents a filtered list of bottles
	        var desiredBeverageType = this.BeverageTypeToShow();
	        if (desiredBeverageType == "All") {
		        return ko.utils.arrayFilter(this.otherUserBottles(), function(bottle) {
		            return !bottle.Selected();
		        });
	        } else {
		        return ko.utils.arrayFilter(this.otherUserBottles(), function(bottle) {
		            return !bottle.Selected() && bottle.Type == desiredBeverageType;
		        });
	        }
	    }, this);

	    self.isTradeSaving = ko.computed(function() {
			return self.isTradeProgressing();
	    }, this);

	    self.isValidTrade = ko.computed(function() {
	    	var currUserBottlesToTrade = ko.utils.arrayFilter(this.currUserBottlesProposed(), function(bottle) {
	            return bottle.Quantity() != 0;
	        });

	    	var otherUserBottlesToTrade = ko.utils.arrayFilter(this.otherUserBottlesProposed(), function(bottle) {
	            return bottle.Quantity() != 0;
	        });

	        return currUserBottlesToTrade.length > 0 && otherUserBottlesToTrade.length > 0;
	    }, this);
	 
	    // Animation callbacks for the bottle list
	    self.showBottleElement = function(elem) { if (elem.nodeType === 1) $(elem).hide().slideDown() }
	    self.hideBottleElement = function(elem) { if (elem.nodeType === 1) $(elem).slideUp(function() { $(elem).remove(); }) }

	    self.save = function() {
		    self.isTradeProgressing(true);
	    	var currUserBottlesToTrade = ko.utils.arrayFilter(this.currUserBottlesProposed(), function(bottle) {
	            return bottle.Quantity() != 0;
	        });

	    	var otherUserBottlesToTrade = ko.utils.arrayFilter(this.otherUserBottlesProposed(), function(bottle) {
	            return bottle.Quantity() != 0;
	        });

	    	var currUserBottleData = $.map(currUserBottlesToTrade, function(bottle) {
	    		return {
	                ID: bottle.ID,
	                Quantity: bottle.Quantity()
	            }
	    	});

	    	var otherUserBottleData = $.map(otherUserBottlesToTrade, function(bottle) {
	    		return {
	                ID: bottle.ID,
	                Quantity: bottle.Quantity()
	            }
	    	});   
	    	
	    	$.ajax({
	    	    type: 'post',
	    	    url: "<?php echo UrlUtils::generateUrl(UrlUtils::TradeSendProposalUri);?>",
	    	    data: {'currUserBottles': JSON.stringify(currUserBottleData), 'otherUserBottles': JSON.stringify(otherUserBottleData), 'message': this.message(), 'counterOfferID': '<?php echo $counterOfferID; ?>' },
	    	    dataType: 'json',
	    	    success: function(data){
	    	        window.location="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersUri);?>" + data.OfferID;
	    	    },
	    	    error: function() {
	    		    self.isTradeProgressing(false);
	    	    }
	    	});
	    }
	};
	 
	// Here's a custom Knockout binding that makes elements shown/hidden via jQuery's fadeIn()/fadeOut() methods
	// Could be stored in a separate utility library
	ko.bindingHandlers.fadeVisible = {
	    init: function(element, valueAccessor) {
	        // Initially set the element to be instantly visible/hidden depending on the value
	        var value = valueAccessor();
	        $(element).toggle(ko.utils.unwrapObservable(value)); // Use "unwrapObservable" so we can handle values that may or may not be observable
	    },
	    update: function(element, valueAccessor) {
	        // Whenever the value subsequently changes, slowly fade the element in or out
	        var value = valueAccessor();
	        ko.utils.unwrapObservable(value) ? $(element).fadeIn() : $(element).fadeOut();
	    }
	};

	KnockoutManager.TradeManager(new TradeModel());
});
</script>