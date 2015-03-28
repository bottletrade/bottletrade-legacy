<?php
$this->pageTitle=Yii::app()->name . ' - Learn the Tips & Tricks to Beer Trading';
?>

<!--PRELOAD THESE IMAGES-->
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/main_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/r1_c1_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/r1_c2_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/r1_c3_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/r2_c1_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/educate/r2_c2_over.jpg"); ?>">
<!--END PRELOAD-->
<div class="top-banner">
	<div class="top-banner-title">
		<span class="white-title ti-large">EDUCATE</span>
	</div>
	<div class="top-banner-copy">
		<span class="white">
			All the information needed to get a head start on the world of craft beer trading 
			can be found here. BottleTrade would like our users to have as much access to information as possible, from 
			looking for tips and tricks on how to trade beer to seeking out the latest news or events in the 
			craft beer industry. Please click on our links below or watch our videos to learn more about our 
			website.
		</span>
	</div>
</div>
<div id="main_container">
	<div style="width: 950px; height: 455px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::TipsTricksUri); ?>'><button class="main"></button></a>
	</div>
	<div style="width: 294px; height: 324px; float: left; margin: 10px 35px 10px 0px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::UseBottleTradeNetworkUri); ?>'><button class="r1_c1"></button></a>
	</div>
	<div style="width: 294px; height: 324px; float: left; margin: 10px 0px 10px 0px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::CBIndustryUri); ?>'><button class="r1_c2"></button></a>
	</div>
	<div style="width: 294px; height: 324px; float: right; margin: 10px 0px 10px 0px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::KnowYourBrewsUri); ?>'><button class="r1_c3"></button></a>
	</div>
	
	<div style="width: 464px; height: 226px; float: left; margin: 10px 0px 10px 0px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::HouseRulesUri); ?>'><button class="r2_c1"></button></a>
	</div>
	<div style="width: 464px; height: 226px; float: right; margin: 10px 0px 10px 0px; box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::PrivacyPolicyUri); ?>'><button class="r2_c2"></button></a>
	</div>
</div>
