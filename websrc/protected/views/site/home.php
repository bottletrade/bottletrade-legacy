<?php
$this->pageTitle=Yii::app()->name . ' | Social Network for Craft Beer Trade';
?>

<!--PRELOAD THESE IMAGES-->
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/home/hor_1_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/home/hor_2_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/home/hor_3_over.jpg"); ?>">
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/home/house_rules_over.jpg"); ?>">
<!--END PRELOAD-->

<div class="rotating-banner">
	<div id="slider">
 		<div id="mask">
			<ul>
				<li class="firstanimation"><a href='<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>'><img src="<?php echo UrlUtils::generateImageUrl("home/banner_1.jpg"); ?>" /></a></li>
				<li class="secondanimation"><a href='<?php echo UrlUtils::generateUrl(UrlUtils::StoreUri); ?>'><img src="<?php echo UrlUtils::generateImageUrl("home/STORE_BANNER.jpg"); ?>" /></a></li>
				<li class="thirdanimation"><a href='<?php echo UrlUtils::generateUrl(UrlUtils::EducateUri); ?>'><img src="<?php echo UrlUtils::generateImageUrl("home/LEARN_TO_TRADE.jpg"); ?>" /></a></li>
				<li class="fourthanimation"><a href='<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri); ?>'><img src="<?php echo UrlUtils::generateImageUrl("home/SOCIAL_MEDIA.jpg"); ?>" /></a></li>
				<li class="fifthanimation"><a href='<?php echo UrlUtils::generateUrl(UrlUtils::ManifestoUri); ?>'><img src="<?php echo UrlUtils::generateImageUrl("home/MANIFESTO_BANNER.jpg"); ?>" /></a></li>
			</ul>
		</div>
	</div>
</div>
<div id="left_container">
	<div id="left_text_holder">
  		<p>BottleTrade is a fun, social, educational and user-friendly network of craft beer enthusiasts who 
			want to trade hard-to-find, hard-to-get beers. We want users from around the country to connect 
			and develop strong bottle trading relationships in an effort to spread awareness and availability 
			of the entire spectrum of craft beers that the 50 states have to offer. This is the time to share the 
			knowledge, share the wealth and share the beer. Trade today, drink tomorrow!
  		</p>
  	</div>
  	<div class="left-banner-holder">
  		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>'><button class="home-hor-1"></button></a>
  	</div>
  	<div class="left-banner-holder">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::TipsTricksUri); ?>'><button class="home-hor-2"></button></a>
	</div>
  	<div class="left-banner-holder">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri); ?>'><button class="home-hor-3"></button></a>
	</div>
</div>
<div id="right_container">
	<div class="right_banner_holder">
		<div style="position: relative; width: 300; height: 44px; margin: 0px 0px 8px 0px; padding-left: 172px; background-image:url(<?php echo UrlUtils::generateImageUrl("get_social.png"); ?>); background-repeat:no-repeat;">
			<a href="https://www.facebook.com/BottleTrade" target="_blank"><img class="social" src="<?php echo UrlUtils::generateImageUrl("facebook_icon.png"); ?>" width="28" height="28" border="0"></a>
			<a href="http://instagram.com/thebottletrade" target="_blank"><img  class="social" src="<?php echo UrlUtils::generateImageUrl("instagram.png"); ?>" width="28" height="28" border="0"></a>
			<a href="https://twitter.com/thebottletrade" target="_blank"><img class="social" src="<?php echo UrlUtils::generateImageUrl("twitter_icon.png"); ?>" width="28" height="28" border="0"></a>
			<a href="http://www.youtube.com/bottletradetv" target="_blank"><img  class="social" src="<?php echo UrlUtils::generateImageUrl("you_tube_icon.png"); ?>" width="28" height="28" border="0"></a>
		</div>
		<div style="width: 267px; height: 574px; margin: 0px 0px 15px 0px; padding: 15px 10px 0px 10px; text-align: center; background-image:url(<?php echo UrlUtils::generateImageUrl("home/login_bg.jpg"); ?>); background-repeat:no-repeat; box-shadow: 5px 5px 3px #453B35;">
			<img src="<?php echo UrlUtils::generateImageUrl("home/login_logo.png"); ?>" width="180" height="151"><br>
			<span class="white large">Login and start trading today!</span>
			<?php $loginFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'login-form',
                                                    'enableClientValidation'=>true,
                                                    'clientOptions'=>array(
                                                     	'validateOnSubmit'=>true,
														'validateOnType'=>false,
                                                        'validateOnChange'=>false,
														'afterValidate'=>'js:function(form, data, hasError) {
															if (hasError) {
                                                    			$("#loginInProgress").hide();
                                                    		}
                                                    		return !hasError;
														}',
                                                    ),
                                                    )); ?>
			<div style="width: 250px; height: auto; padding-top: 15px; margin-left:auto; margin-right:auto;">
				<table width="250" border="0" cellspacing="0" cellpadding="2">
  					<tr>
    					<td><span class="white">Username: </span></td>
    					<td><?php echo $loginFormWidget->textField($loginForm,'username'); ?>
    					    <?php echo $loginFormWidget->error($loginForm,'username'); ?></td>
  					</tr>
  					<tr>
    					<td><span class="white">Password: </span></td>
    					<td><?php echo $loginFormWidget->passwordField($loginForm,'password'); ?>
    					    <?php echo $loginFormWidget->error($loginForm,'password'); ?></td>
  					</tr>
		 			<tr>
		    			<td colspan="2" align="center"><a class="white" href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountForgotPasswordUri); ?>">Forgot Password</a></td>
		  			</tr>
 			 		<tr>
    					<td colspan="2" align="center">
    					<button class="medium" onclick='$("#loginInProgress").show(); return true;'>
							LOGIN
						</button>
   					</tr>
  					<tr>
  						<td colspan="2" align="center"><img id="loginInProgress" style="display: none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img></td>
  					</tr>
				</table>
			</div>
			<?php $this->endWidget(); ?>
			<div style="width: 200px; height: 2px; background-color: #FFF; margin: 18px auto;">
			</div>
				<span class="white large">Don't have a BottleTrade account?<br>
					Register by clicking below<br>to create your profile.</span><br><br>
					<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>'">
						REGISTER PROFILE
					</button>
			</div>
		</div>
	<div class="right_banner_holder" style="box-shadow: 5px 5px 3px #453B35;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::HouseRulesUri); ?>'><button class="house-rules"></button></a>
	</div>
</div>