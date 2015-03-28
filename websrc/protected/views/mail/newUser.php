<?php $this->beginContent('/layouts/mail'); ?>
Hello <?php echo $user->FirstName; ?>, 
<br /><br />
Thank you for registering your profile on BottleTrade - the world's first social media network dedicated to 
craft beer trading. You can begin updating your profile by logging 
in <a href="<?php echo UrlUtils::generateUrl(UrlUtils::LoginCreateProfile); ?>">here</a>.
<br /><br />
We appreciate you taking the time to sign up and explore our contribution to the world of beer trading. 
BottleTrade was established to present a formal and reliable trading experience for craft beer enthusiasts, 
as well as to educate newcomers about what bottle trading is and how to become a part of this rewarding 
movement.
<br /><br />
BottleTrade users can expect a unique social media platform for trading with the following enabled features:
<br /><br />
	- Profile Page with Messaging and Inbox System<br />
         
	- ISO (In Search Of) Feature that Allows you to Add Beers to your Trading Wishlist<br />

	- Cyber Cellar for Users to Upload and Present Bottles for Trade Offers<br />
         
	- Friend List to Keep Track of Trade Partners<br />
         
	- Trader Feed to View All Activity on the BottleTrade Network<br />
         
	- Hashtag Your Bottles so Traders can Find Your Profile<br />
         
	- Trader Review System to Establish a Reputable Trade History<br />
	
	- Formal Trading Process for Users to easily set up Offers, Counter-Offers, Shipping Dates, Tracking Numbers, etc.<br />
	
	- Educational Resources on How to Trade as well as Craft Beer Industry News<br />
	
	- Online Store with Craft Beer Merchandise, Apparel, Glassware and More...<br /><br />

If you have any questions about your BottleTrade account, feel free to contact us at <a href="mailto:support@bottletrade.com">support@bottletrade.com</a>. 
We also have the BottleTrade Tutorial Series videos available on our YouTube channel <a href="www.youtube.com/bottletradetv">here</a> to learn more 
about how to to use our website.<br /><br />

BottleTrade is currently supported on the following Internet browsers:<br />

	-Google Chrome<br />
	-FireFox<br />
	-Safari<br />
	-Internet Explorer 9 and above (Image Uploads not available on Internet Explorer)<br /><br />
	
Thanks again for being a part of the revolution in craft beer trading!<br /><br />

Cheers,<br />
BottleTrade<br />
<a href="mailto:support@bottletrade.com">support@bottletrade.com</a>
<br />
<?php $this->endContent(); ?>