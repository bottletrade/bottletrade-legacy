<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Cache-control" content="private"/>
	<link rel="shortcut icon" href="<?php echo UrlUtils::generateUrl("favicon.ico"); ?>" type="image/x-icon"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link href="<?php echo UrlUtils::generateCssUrl("bootstrap-alert.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("popup.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("stylesheet.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("buttons.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("rotating_banner.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("rounded.css"); ?>" rel="stylesheet" type="text/css" media="screen"/> 
	<link href="<?php echo UrlUtils::generateCssUrl("imgareaselect-animated.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("image-crop.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo UrlUtils::generateCssUrl("error_messages.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
	<?php                                                                                                                                                                                                                                                                                                                                                                
	Yii::app()->clientScript->registerScript('helpers', '
			yii = {
				urls: {
					base: '.CJSON::encode(UrlUtils::generateUrl()).',
					tradeSummary: '.CJSON::encode(UrlUtils::generateUrl(UrlUtils::CyberCellarTradeSummaryUri, "/")).',
					beerInfo: '.CJSON::encode(UrlUtils::generateUrl(UrlUtils::BeerUri, "/")).',
					breweryInfo: '.CJSON::encode(UrlUtils::generateUrl(UrlUtils::BreweryUri, "/")).',
					profile: '.CJSON::encode(UrlUtils::generateUrl(UrlUtils::ProfileUri, "/")).',
					makeOffer: '.CJSON::encode(UrlUtils::generateUrl(UrlUtils::TradeProposeUri, "/")).',
			
					/* ajax urls */
					feedFriendData: '.CJSON::encode(UrlUtils::generateUrl("feed","friendData")).',
					feedGlobalData: '.CJSON::encode(UrlUtils::generateUrl("feed","globalData")).'
				},
				knockout: {
					bindingId: '.CJSON::encode(KnockoutConstants::KnockoutManagerBindingID).',
					eventTypeBottle: '.CJSON::encode(KnockoutEventType::BOTTLE).',
					eventTypeTrade: '.CJSON::encode(KnockoutEventType::TRADE).',
					eventTypeIsoBeer: '.CJSON::encode(KnockoutEventType::ISO_BEER).'
				}
			};
			bottletrade = {
				apis: {
					iso: {
						remove: '.CJSON::encode(UrlUtils::generateUrl("api","removeIso")).',
						addBeer: '.CJSON::encode(UrlUtils::generateUrl("api","addIsoBeer")).',
						getEntries: '.CJSON::encode(UrlUtils::generateUrl("api","getIsoEntries")).'
					},
					findTrader: '.CJSON::encode(UrlUtils::generateUrl("api","findTrader")).',
					cyberCellarBottles: '.CJSON::encode(UrlUtils::generateUrl("api","getBottles")).',
					hashTagEvents: '.CJSON::encode(UrlUtils::generateUrl("api","getHashTagEvents")).'
				},
				popups: {
					iso :'.CJSON::encode('#'.PopupConstants::ISOPopupLinkID).',
					bottle :'.CJSON::encode('#'.PopupConstants::BottlePopupLinkID).'
				}
			};
	',CClientScript::POS_HEAD);                                                                                                             
	?> 
</head>
<body>
<?php if (Yii::app()->user->isGuest && !Yii::app()->request->cookies['ageVerified']): ?>
<div>
	<?php $this->widget('application.components.widgets.displays.AgeVerificationDisplay'); ?>
</div>
<?php else: ?>
<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("moment.min.js"); ?>"></script>
<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("bottletrade.preload.js"); ?>"></script>
<div id="body-main">
	<div id="header">
		<img src="<?php echo UrlUtils::generateImageUrl("header-logo.png"); ?>" width="401" height="116"/>
	</div>
	<div id="menu">
		<ul>
			<?php if (Yii::app()->user->isGuest): ?>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(); ?>">HOME</a>
			</li>
			<?php else: ?>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::TraderFeedUri); ?>">HOME</a>
			</li>
			<?php endif; ?>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::ManifestoUri); ?>">MANIFESTO</a>
			</li>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::StoreUri); ?>">STORE</a>
			</li>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::EducateUri); ?>">EDUCATE</a>
			</li>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri); ?>">BLOG</a>
			</li>
			<li>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri); ?>">SEARCH</a>
			</li>
			<li>
			<?php if (Yii::app()->user->isGuest): ?>
				<a class="button" href="<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>">LOGIN</a>
			<?php else: ?>
				<div class="user-menu-header">
					<a href='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>'><?php echo Yii::app()->user->getName(); ?>
					</a>
					<div class="user-menu">
						<div class="user-menu-holder">
							<ul>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::InboxMessagesAllUri); ?>">INBOX</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarBottlesUri); ?>">MY CYBER CELLAR</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>">MY TRADES</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersIncomingUri); ?>">MY OFFERS</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::TradeFindUri); ?>">FIND A TRADER</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>">HASHTAGS</a>
								</li>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountSettingsUri); ?>">ACCOUNT SETTINGS</a>
								</li>
								<?php if (Yii::app()->user->isAdmin): ?>
								<li>
									<a href="<?php echo UrlUtils::generateUrl("/admin"); ?>">ADMIN PANEL</a>
								</li>
								<?php endif; ?>
								<li>
									<a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountLogoutUri); ?>">LOGOUT</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php endif; ?>
			</li>
		</ul>
	</div>
	<div id="container">
		<div id="error-alert-placeholder" class="alert alert-error fade" style="display:none;">
			<a class="close" onclick="$('#error-alert-placeholder.alert').removeClass('in'); $('#error-alert-placeholder').hide();">&times;</a>
			<span id="error-alert-msg-placeholder"></span>
		</div>
		<div id="success-alert-placeholder" class="alert alert-success fade" style="display:none;">
			<a class="close" onclick="$('#success-alert-placeholder.alert').removeClass('in'); $('#success-alert-placeholder').hide();">&times;</a>
			<span id="success-alert-msg-placeholder"></span>
		</div>
		<div id="onload-alert-placeholder">
			<?php 
				$this->widget('bootstrap.widgets.TbAlert', array(
		        	'block'=>true, // display a larger alert block?
		        	'fade'=>true, // use transitions?
		        	'closeText'=>'&times;' // close link text - if set to false, no close link is displayed
		        	)
				);
			?>
		</div>
		<?php 
			$this->widget('application.components.widgets.popups.ImageModifierPopup',
					array('renderOnly' => true)
			);
	
			$this->widget('application.components.widgets.popups.FriendListPopup');
		?>
		<div id='<?php echo KnockoutConstants::KnockoutManagerBindingID; ?>'>
			<?php echo $content; ?>
		</div>
	</div>
	<div id="footer">
	<a class="link" href="<?php echo UrlUtils::generateUrl(); ?>">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::ManifestoUri);  ?>">Manifesto</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::StoreUri);  ?>">Store</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::EducateUri);  ?>">Educate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri);  ?>">Blog</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::ContactUsUri);  ?>">Contact Us</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::AboutUsUri);  ?>">About Us</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php if (Yii::app()->user->isGuest): ?>
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile);  ?>">Login</a>
	<?php else: ?>
	<a class="link" href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountLogoutUri);  ?>">Logout</a>
	<?php endif; ?>
	<br />
	<span class="center black">&copy; Copyright 2014 - BottleTrade, LLC</span>
	</div>
	<?php
	$cs = Yii::app()->getClientScript();
	$cs->packages['jquery'] = array(
	                                'baseUrl' => UrlUtils::generateScriptUrl(""),
	                                'js' => array('jquery-1.8.3.min.js')
	                        );
	$cs->registerPackage('jquery');
	
	Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
	Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
	?>
	</div>
<?php endif;?>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("knockout-2.3.0.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("knockout.mapping-latest.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("knockout.custom.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("modernizr.min.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("bootstrap-alert.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("bootstrap-transition.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo UrlUtils::generateScriptUrl("jquery.imgareaselect.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("bottletrade.js"); ?>"></script>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-49193216-1']);
	  _gaq.push(['_setDomainName', 'bottletrade.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</body>
</html>
