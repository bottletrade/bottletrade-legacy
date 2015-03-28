<div style="margin: 0px auto; width: 90%; padding: 20px 35px;"><ul class="small-block-grid-2">  	<li>  		<ul class="pricing-table">  <li class="title">Active Users</li>  <li class="price"><?php echo $data['activeUsers']; ?></li>		</ul>  	</li>  	<li>  	<ul class="pricing-table">  <li class="title">Active Bottles</li>  <li class="price"><?php echo $data['activeBottles']; ?></li>		</ul>  	</li>  	<li>  	<ul class="pricing-table">  <li class="title">Pending Offers</li>  <li class="price"><?php echo $data['pendingOffers']; ?></li>		</ul>  	</li>  	<li>  	<ul class="pricing-table">  <li class="title">Pending Trades</li>  <li class="price"><?php echo $data['pendingTrades']; ?></li>		</ul>  	</li>  	<li>  	<ul class="pricing-table">  <li class="title">Completed Trades</li>  <li class="price"><?php echo $data['completedTrades']; ?></li>		</ul>  	</li></ul></div><!--<br />
<span class="black large">ADMIN PANEL</span>
<br />
<br />
<div class="admin-stats-holder">

	<span class="black medium"><strong>User Statistics</strong></span>
	<br />

	<div class="admin-user-stats">
		<div class="admin-title-holder">
			<span class="white">Active Users</span>
		</div>
		<span class="black large"><?php echo $data['activeUsers']; ?></span>
	</div>

	<div class="admin-user-stats">
		<div class="admin-title-holder">
			<span class="white">Active Bottles</span>
		</div>
		<span class="black large"><?php echo $data['activeBottles']; ?></span>
	</div>

	<div class="admin-user-stats">
		<div class="admin-title-holder">
			<span class="white">Pending Offers</span>
		</div>
		<span class="black large"><?php echo $data['pendingOffers']; ?></span>
	</div>

	<div class="admin-user-stats">
		<div class="admin-title-holder">
			<span class="white">Pending Trades</span>
		</div>
		<span class="black large"><?php echo $data['pendingTrades']; ?></span>
	</div>

	<div class="admin-user-stats">
		<div class="admin-title-holder">
			<span class="white">Completed Trades</span>
		</div>
		<span class="black large"><?php echo $data['completedTrades']; ?></span>
	</div>
</div>

<div class="admin-links-holder">
	<span class="black medium"><strong>View/Edit Database Links</strong></span>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudBeerCategory/Admin"); ?>'">
		VIEW BEER CATEGORIES
	</button>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudBeerStyle/Admin"); ?>'">
		VIEW BEER STYLES
	</button>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudBeer/Admin"); ?>'">
		VIEW BEERS
	</button>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudBrewery/Admin"); ?>'">
		VIEW BREWERIES
	</button>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudUser/Admin"); ?>'">
		VIEW USERS
	</button>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/crudReview/Admin"); ?>'">
		VIEW REVIEWS
	</button>
	<br />
</div>

<div class="admin-links-holder">
	<span class="black medium"><strong>Query Result Links</strong></span>
	<br />
	<button class="large" onclick="window.location='<?php echo UrlUtils::generateUrl("/admin/viewActiveUsers"); ?>'">
		VIEW USER EMAILS
	</button>
	<br />
</div>-->
