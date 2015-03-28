<?php
$this->pageTitle=Yii::app()->name . ' - Find a Trader';
?>
<style>
.trader-matches { display:none; }
</style>

<div class="top-banner">
	<div style="text-align: center;">
		<span class="white-title ti-large">FIND A TRADER</span>
	</div>
</div>
<div class="FT-main-holder">
<br />
	<div class="FT-column-holder">
		<div class="FT-title-holder">
			<span class="black">
			 <strong>FT matches ISO</strong><br />
				(Traders that have what you want)
			</span> 
		</div>
		<div class="trader-matches">
			<div style="text-align: center;" data-bind="visible: $root.FindTraderManager().isoLoader().loadingData() == false && 
									$root.FindTraderManager().isoMatches().length == 0">
				<br />
				<span class="black"><strong>No Traders Found</strong></span>
			</div>
			<div data-bind="foreach: $root.FindTraderManager().isoMatches">
				<div>
					<div class="FT-user-holder">
						<div class="FT-user-image-holder">
							<img width="60px" height="60px" data-bind="attr: { src: $data.user.imgSrc }"></img>
						</div>
						<span class="black" data-bind="text: $data.user.username"></span>
					</div>
					<div class="FT-user-button-holder">
						<button class="medium" data-bind="click: $data.viewProfile">VIEW PROFILE</button>
						<button class="medium" data-bind="click: $data.makeOffer">MAKE AN OFFER</button>
					</div>
					<div class="FT-matching-bottles-holder" data-bind="visible: $data.showBottles() == false">
						<span class="black-small"><!-- ko text: $data.user.bottleCount --><!-- /ko --> Matching Bottle(s)</span>
						<br />
						<button class="small" data-bind="click: $data.toggleBottles">&#9660; VIEW ALL BOTTLES</button>
					</div>
					<div style="float: left; width: 100%;" data-bind="visible: $data.showBottles()">
						<div style="width: 100%" data-bind="foreach: $data.bottles">
							<div class="FT-bottle-holder">
								<div class="FT-bottle-image-holder">
									<div class="FT-bottle-image">
										<img width="50px" height="50px" data-bind="attr: { src: imgSrc }"></img>
									</div>
								</div>
								<div class="FT-bottle-specs-holder">
									<span class="black-small"><!-- ko text: year --><!-- /ko --> | <!-- ko text: beverageName --><!-- /ko --><br/>
									<!-- ko text: companyName --><!-- /ko -->
									</span>
								</div>
							</div>
						</div>
						<div class="FT-loader" data-bind="visible: $data.bottlesLoader() != null && $data.bottlesLoader().loadingData">
							<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
						</div>
						<div class="FT-hide-bottles-holder">
							<button class="small" data-bind="click: $data.toggleBottles">&#9650; HIDE ALL BOTTLES</button>
						</div>
					</div>
				</div>
				<div class="FT-hor-divide-holder">
					<div class="horizontal-divide" style="width: 95%;"></div>
				</div>
			</div>
		</div>
		<div class="FT-loader" data-bind="visible: $root.FindTraderManager().isoLoader().loadingData()">
			<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
		</div>
		<button class="medium center" 
				data-bind="click: $root.FindTraderManager().isoLoader().loadMore,
							visible: $root.FindTraderManager().isoLoader().endReached() == false">
			LOAD MORE
		</button>
	</div>
	<div class="FT-column-holder">
		<div class="FT-title-holder">
			<span class="black">
			 <strong>ISO matches FT</strong><br />
				(Traders that want what you have)
			</span> 
		</div>
		<div class="trader-matches">
			<div style="text-align: center;" data-bind="visible: $root.FindTraderManager().ftLoader().loadingData() == false && 
									$root.FindTraderManager().ftMatches().length == 0">
				<br />
				<span class="black"><strong>No Traders Found</strong></span>
			</div>
			<div data-bind="foreach: $root.FindTraderManager().ftMatches">
				<div class="FT-user-holder">
					<div class="FT-user-image-holder">
						<img width="60px" height="60px" data-bind="attr: { src: $data.user.imgSrc }"></img>
					</div>
					<span class="black" data-bind="text: $data.user.username"></span>
				</div>
				<div class="FT-user-button-holder">
					<button class="medium" data-bind="click: $data.viewProfile">VIEW PROFILE</button>
					<button class="medium" data-bind="click: $data.makeOffer">MAKE AN OFFER</button>
				</div>
				<div class="FT-matching-bottles-holder" data-bind="visible: $data.showBottles() == false">
					<span class="black-small"><!-- ko text: $data.user.bottleCount --><!-- /ko --> Matching Bottle(s)</span>
					<br />
					<button class="small" data-bind="click: $data.toggleBottles">&#9660; VIEW ALL BOTTLES</button>
				</div>
				<div style="width: 100%;" data-bind="visible: $data.showBottles()">
					<div style="width: 100%;" data-bind="foreach: $data.bottles">
						<div class="FT-bottle-holder">
							<div class="FT-bottle-image-holder">
								<div class="FT-bottle-image">
									<img width="50px" height="50px" data-bind="attr: { src: imgSrc }"></img>
								</div>
							</div>
							<div class="FT-bottle-specs-holder">
								<span class="black-small"><!-- ko text: year --><!-- /ko --> | <!-- ko text: beverageName --><!-- /ko --><br/>
								<!-- ko text: companyName --><!-- /ko -->
								</span>
							</div>
						</div>
					</div>
					<div class="FT-loader" data-bind="visible: $data.bottlesLoader() != null && $data.bottlesLoader().loadingData">
						<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
					</div>
					<div class="FT-hide-bottles-holder">
						<button class="small" data-bind="click: $data.toggleBottles">&#9650; HIDE ALL BOTTLES</button>
					</div>
				</div>
				<div class="FT-hor-divide-holder" style="margin-bottom: -2px;">
					<div class="horizontal-divide" style="width: 95%;"></div>
				</div>
			</div>
		</div>
		<div class="FT-loader" data-bind="visible: $root.FindTraderManager().ftLoader().loadingData()">
			<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
		</div>
		<button class="medium center" 
				data-bind="click: $root.FindTraderManager().ftLoader().loadMore,
							visible: $root.FindTraderManager().ftLoader().endReached() == false">
			LOAD MORE
		</button>
	</div>
	<div class="FT-column-holder">
		<div class="FT-title-holder">
			<span class="black">
			 <strong>FT:ISO Trade Match</strong><br />
				(Perfect Match! Both Traders have what each other wants)
			</span> 
		</div>
		<div class="trader-matches">
			<div style="text-align: center;" data-bind="visible: $root.FindTraderManager().bothLoader().loadingData() == false && 
									$root.FindTraderManager().bothMatches().length == 0">
				<br />
				<span class="black"><strong>No Traders Found</strong></span>
			</div>
			<div data-bind="foreach: $root.FindTraderManager().bothMatches">
				<div class="FT-user-holder">
					<div class="FT-user-image-holder">
						<img width="60px" height="60px" data-bind="attr: { src: $data.user.imgSrc }"></img>
					</div>
					<span class="black" data-bind="text: $data.user.username"></span>
				</div>
				<div class="FT-user-button-holder">
					<button class="medium" data-bind="click: $data.viewProfile">VIEW PROFILE</button>
					<button class="medium" data-bind="click: $data.makeOffer">MAKE AN OFFER</button>
				</div>
				<div class="FT-matching-bottles-holder" style="margin: 0px 0px -1px 0px;" data-bind="visible: $data.showBottles() == false">
					<span class="black-small"><!-- ko text: $data.user.bottleCount --><!-- /ko --> Matching Bottle(s)</span>
					<br />
					<button class="small" data-bind="click: $data.toggleBottles">&#9660; VIEW ALL BOTTLES</button>
				</div>
				<div data-bind="visible: $data.bottlesLoader() != null && $data.bottlesLoader().loadingData() == false" class="center">
					<div style="width: 100%;" data-bind="visible: $data.showBottles()">
						<div style="width: 100%;" data-bind="foreach: $data.bottlesFt">
							<div class="FT-bottle-holder">
							<span class="black">FT matches ISO</span><br/>
								<div class="FT-bottle-image-holder">
									<div class="FT-bottle-image">
										<img width="50px" height="50px" data-bind="attr: { src: imgSrc }"></img>
									</div>
								</div>
								<div class="FT-bottle-specs-holder">
									<span class="black-small"><!-- ko text: year --><!-- /ko --> | <!-- ko text: beverageName --><!-- /ko --><br/>
									<!-- ko text: companyName --><!-- /ko -->
									</span>
								</div>
							</div>
						</div>
						<div data-bind="foreach: $data.bottlesIso">
							<div class="FT-bottle-holder">
							<span class="black">ISO matches FT</span><br/>
								<div class="FT-bottle-image-holder">
									<div class="FT-bottle-image">
										<img width="50px" height="50px" data-bind="attr: { src: imgSrc }"></img>
									</div>
								</div>
								<div class="FT-bottle-specs-holder">
									<span class="black-small"><!-- ko text: year --><!-- /ko --> | <!-- ko text: beverageName --><!-- /ko --><br/>
									<!-- ko text: companyName --><!-- /ko -->
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="FT-loader" data-bind="visible: $data.bottlesLoader() != null && $data.bottlesLoader().loadingData()">
					<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
				</div>
				<div class="FT-hide-bottles-holder">
					<button class="small" data-bind="click: $data.toggleBottles, visible: $data.showBottles() == true">&#9650; HIDE ALL BOTTLES</button>
				</div>
				<div class="FT-hor-divide-holder">
					<div class="horizontal-divide" style="width: 95%; margin: 0px 0px -2px 0px;"></div>
				</div>
			</div>
		</div>
		<div class="FT-loader" data-bind="visible: $root.FindTraderManager().bothLoader().loadingData">
			<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
		</div>
		<button class="medium center" 
				data-bind="click: $root.FindTraderManager().bothLoader().loadMore,
							visible: $root.FindTraderManager().bothLoader().endReached() == false">
			LOAD MORE
		</button>
	</div>
</div>
<script type="text/javascript">
$(window).bind("load", function() {
	var TraderInfo = function(event, type) {
		var self = this;
		self.user = event;
		self.showBottles = ko.observable(false);
		self.bottles = ko.observableArray();
		self.bottlesLoader = ko.observable(null);
		self.type = type;

		self.loadBottles = function(item) {
			if (self.bottlesLoader() == null) {
				self.bottlesLoader(new _AjaxEventLoader());
				self.bottlesLoader().limit(100);
				self.bottlesLoader().dataUrl(bottletrade.apis.findTrader);
				self.bottlesLoader().customUrlData('type=' + self.type + '&un=' + self.user.username);
				self.bottlesLoader().eventLoadedCallback(function(event) {
					item.bottles.push(event);
				});
				self.bottlesLoader().loadMore();
			}
		}

		self.toggleBottles = function(item) {
			if (!self.showBottles()) {
				self.loadBottles(item);
			}
			self.showBottles(!self.showBottles());
		}

		self.viewProfile = function(item) {
			KnockoutManager.NavigationManager().goToUserProfile(item.user);
		}

		self.makeOffer = function(item) {
			KnockoutManager.NavigationManager().goToMakeOfferWithUsername(item.user);
		}

		self.bottlesIso = ko.computed(function() {
			return ko.utils.arrayFilter(this.bottles(), function(bottle) {
	            return bottle.findTraderType == "iso";
	        });
		}, this);

		self.bottlesFt = ko.computed(function() {
			return ko.utils.arrayFilter(this.bottles(), function(bottle) {
	            return bottle.findTraderType == "ft";
	        });
		}, this);
	}
	
	var _FindTraderManager = function () {
		var self = this;
		self.isoLoader = ko.observable(new _AjaxEventLoader());
		self.isoMatches = ko.observableArray();
		self.ftLoader = ko.observable(new _AjaxEventLoader());
		self.ftMatches = ko.observableArray();
		self.bothLoader = ko.observable(new _AjaxEventLoader());
		self.bothMatches = ko.observableArray();
	}

	var ftm = new _FindTraderManager();
	ftm.isoLoader().limit(10);
	ftm.isoLoader().dataUrl(bottletrade.apis.findTrader);
	ftm.isoLoader().customUrlData('type=iso');
	ftm.isoLoader().eventLoadedCallback(function(event) {
		KnockoutManager.FindTraderManager().isoMatches.push(new TraderInfo(event, 'iso'));
	});

	ftm.ftLoader().limit(10);
	ftm.ftLoader().dataUrl(bottletrade.apis.findTrader);
	ftm.ftLoader().customUrlData('type=ft');
	ftm.ftLoader().eventLoadedCallback(function(event) { 
		KnockoutManager.FindTraderManager().ftMatches.push(new TraderInfo(event, 'ft'));
	});

	ftm.bothLoader().limit(10);
	ftm.bothLoader().dataUrl(bottletrade.apis.findTrader);
	ftm.bothLoader().customUrlData('type=both');
	ftm.bothLoader().eventLoadedCallback(function(event) { 
		KnockoutManager.FindTraderManager().bothMatches.push(new TraderInfo(event, 'both'));
	});

	KnockoutManager.FindTraderManager(ftm);
	$('.trader-matches').show();

	KnockoutManager.FindTraderManager().isoLoader().loadMore();
	KnockoutManager.FindTraderManager().ftLoader().loadMore();
	KnockoutManager.FindTraderManager().bothLoader().loadMore();
});
</script>