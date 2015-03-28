<div style="margin: 0px auto 0px auto; text-align: center;">
	<img src="<?php echo UrlUtils::generateImageUrl("/images/logo_large.png"); ?>" width="451" height="385"/><br />
    <span class="white large bold">Are you 21 years of age or older?</span><br />
    <div style="width: 300px; height: 50px; margin: 0px auto 0px auto;">
    	<div style="width: 143px; height: 50px; text-align: right; float:left;">
	    	<form method="post" action="">
	    		<input name="AgeVerificationResponse" value="YES" class="hidden"></input>
	    		<button type="submit" class="medium">YES</button>
	    	</form>
    	</div>
    	<div style="width: 143px; height: 50px; text-align: left; float:right;">
	    	<form method="get" action="http://www.google.com" target="blank">
	    		<button type="submit" class="medium">NO</button>
	    	</form>
    	</div>
    </div>
</div>
