<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Cache-control" content="private"/>

	<link rel="shortcut icon" href="<?php echo UrlUtils::generateUrl("favicon.ico"); ?>" type="image/x-icon"/>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link href="<?php echo UrlUtils::generateCssUrl("normalize.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>

	<link href="<?php echo UrlUtils::generateCssUrl("foundation.min.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>

	<link href="<?php echo UrlUtils::generateCssUrl("foundation-override.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>

</head>

<body>

<div id="header" class="show-for-large-up">
	<img src="<?php echo UrlUtils::generateImageUrl("header-logo.png"); ?>" width="401" height="116"/>
</div>
<div class="center">
<nav class="top-bar show-for-large-up" data-topbar role="navigation">
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="left">
      <li><a class="left" href="<?php echo UrlUtils::generateUrl(UrlUtils::TraderFeedUri); ?>">HOME</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::ManifestoUri); ?>">MANIFESTO</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::StoreUri); ?>">STORE</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::EducateUri); ?>">EDUCATE</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri); ?>">BLOG</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri); ?>">SEARCH</a></li>
      <li class="divider"></li>
      <li class="has-dropdown">
        <?php if (Yii::app()->user->isGuest): ?>
			<a href="<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>">LOGIN</a>
			<?php else: ?>
			<a href='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>'><?php echo Yii::app()->user->getName(); ?></a>
		<?php endif; ?>
        <ul class="dropdown">
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::InboxMessagesAllUri); ?>">INBOX</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarBottlesUri); ?>">MY CYBER CELLAR</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>">MY TRADES</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersIncomingUri); ?>">MY OFFERS</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::TradeFindUri); ?>">FIND A TRADER</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>">HASHTAGS</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountSettingsUri); ?>">ACCOUNT SETTINGS</a></li>
          <li class="divider"></li>
          <?php if (Yii::app()->user->isAdmin): ?>
		  <li><a href="<?php echo UrlUtils::generateUrl("/admin"); ?>">ADMIN PANEL</a></li>
		  <li class="divider"></li>
		  <?php endif; ?>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountLogoutUri); ?>">LOGOUT</a></li>
        </ul>
      </li>
     </ul>

    </section>
</nav>
</div>

<div class="off-canvas-wrap hide-for-large-up" data-offcanvas>
  <div class="inner-wrap">
    <nav class="tab-bar">
      <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
      </section>

      <section class="middle tab-bar-section">
        <h1>BottleTrade</h1>
      </section>

      <section class="right-small">
        <a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
      </section>
    </nav>

    <aside class="left-off-canvas-menu">
      <ul class="off-canvas-list">
      <li><label>Site Nav</label></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::TraderFeedUri); ?>">HOME</a></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::ManifestoUri); ?>">MANIFESTO</a></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::StoreUri); ?>">STORE</a></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::EducateUri); ?>">EDUCATE</a></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::BlogUri); ?>">BLOG</a></li>
      <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri); ?>">SEARCH</a></li>
      </ul>
    </aside>

    <aside class="right-off-canvas-menu">
      <ul class="off-canvas-list">
        <li><label>User Nav</label></li>
        <li><?php if (Yii::app()->user->isGuest): ?>

				<a  href="<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>">LOGIN</a>

			<?php else: ?>
			
			<a  href='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>'><?php echo Yii::app()->user->getName(); ?>

					</a>
					<?php endif; ?>
		</li>
        <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::InboxMessagesAllUri); ?>">INBOX</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarBottlesUri); ?>">MY CYBER CELLAR</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>">MY TRADES</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersIncomingUri); ?>">MY OFFERS</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::TradeFindUri); ?>">FIND A TRADER</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>">HASHTAGS</a></li>
          <li><a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountSettingsUri); ?>">ACCOUNT SETTINGS</a></li>
          <?php if (Yii::app()->user->isAdmin): ?>

			<li>

				<a href="<?php echo UrlUtils::generateUrl("/admin"); ?>">ADMIN PANEL</a>
			</li>
		<?php endif; ?>
          <li class="active"><a href="<?php echo UrlUtils::generateUrl(UrlUtils::AccountLogoutUri); ?>">LOGOUT</a></li>
        </ul>
      </li>
      </ul>
    </aside>
    
    <section class="main-section">
		<div id='<?php echo KnockoutConstants::KnockoutManagerBindingID; ?>'>
			<?php echo $content; ?>
		</div>
	</section>
	
  <a class="exit-off-canvas"></a>

  </div>
</div>
	<div class="show-for-large-up">
	<div id='<?php echo KnockoutConstants::KnockoutManagerBindingID; ?>'>
			<?php echo $content; ?>
	</div>
</div>		
		
	<div id="footer" class="show-for-large-up">
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
	
	<!-- fibo's parent site code start -->
	<!--
	<div class="off-canvas-wrap" data-offcanvas>
	  <div class="inner-wrap" data-ng-controller="HomeCtrl">
	  	<nav class="top-bar hide-for-small" data-topbar>
		  <ul class="title-area">
		    <li class="name">
		      <h1><a href="#">Home</a></h1>
		    </li>
		  </ul>
		
		  <section class="top-bar-section">
		    <ul class="right">
		        <li data-ng-hide="!authentication.isAuth"><a>Welcome back {{ authentication.email }}!</a></li>
		        <li data-ng-hide="!authentication.isAuth"><a href="" data-ng-click="logOut()">Logout</a></li>
		        <li data-ng-hide="authentication.isAuth"><a href="#/account/login">Login</a></li>
		        <li data-ng-hide="authentication.isAuth"><a href="#/account/signup">Signup</a></li>
		    </ul>
		
		    <ul class="left">
		    </ul>
		  </section>
		</nav>	
		
	    <nav class="tab-bar show-for-small-only">
	
	      <section class="middle tab-bar-section">
	        <h1 class="title">Fibo Parent Portal</h1>
	      </section>
	
	      <section class="right-small">
	        <a class="right-off-canvas-toggle menu-icon" href="js:return false;"><span></span></a>
	      </section>
	    </nav>
	
	    <aside class="left-off-canvas-menu show-for-small-only">
	      <ul class="off-canvas-list">
	      	<li><label>Registration</label></li>
	      	<li><a href="#/register/afterschool">After School</a></li>
	      </ul>
	    </aside>
	
	    <aside class="right-off-canvas-menu show-for-small-only">
	      <ul class="off-canvas-list">
	        <li><label>Account</label></li>
	        <li data-ng-hide="!authentication.isAuth"><a href="" data-ng-click="logOut()">Logout</a></li>
	        <li data-ng-hide="authentication.isAuth"><a href="#/account/login">Login</a></li>
	      </ul>
	    </aside>
	    
	    <section class="main-section">
	    	<div ui-view/>
	    </section>
	    
	  	<a class="exit-off-canvas show-for-small-only"></a>
	  	
	    <section class="footer show-for-small-only">
		  <div class="row">
		    <div class="small-12 columns">
		      <ul class="home-social">
		          <li><a href="https://twitter.com/fiboart" class="twitter"></a></li>
		          <li><a href="https://www.facebook.com/fiboart" class="facebook"></a></li>
		          <li><a href="mailto:classes@fiboart.com?Subject=Question about Fibo Art" class="mail"></a></li>
		        </ul>
		    </div>
		  </div>
		</section>
		    
	    <section class="footer hide-for-small">
		  <div class="row" data-equalizer>
		    <div class="medium-4 push-8 columns" data-equalizer-watch>
		      <ul class="home-social">
		          <li><a href="https://twitter.com/fiboart" class="twitter"></a></li>
		          <li><a href="https://www.facebook.com/fiboart" class="facebook"></a></li>
		          <li><a href="mailto:classes@fiboart.com?Subject=Question about Fibo Art" class="mail"></a></li>
		        </ul>
		     </div>
		     <div class="medium-8 pull-4 columns" data-equalizer-watch>
		        <a href="http://www.fiboart.com" class="y-center fibo-logo regular"></a>
		       	<span class="y-center copyright">© 2014 Fibo Art. All rights reserved.</span>
		    </div>
		  </div>
	    </section>
	  </div>
	</div>
	-->
	<!-- fibo's parent site code end -->

	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("jquery-1.8.3.min.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("modernizr.min.js"); ?>"></script>
	<script type='text/javascript' src="<?php echo UrlUtils::generateScriptUrl("foundation.min.js"); ?>"></script>
	<script>
    	$(document).foundation();
  	</script>
</body>

</html>
