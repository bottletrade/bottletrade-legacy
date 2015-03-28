<?php
$this->pageTitle=Yii::app()->name . ' - Search Our Beer Network and Begin Trading Today';
?>
<link href="<?php echo UrlUtils::generateCssUrl("search.css"); ?>" rel="stylesheet" type="text/css" media="screen"/>
<?php 
	function int_to_str(&$item1, $key)
	{
		$item1 = strval($item1);
	}
	
	// useful variables
	$searchPerformed = !empty($searchResult);
	$bottleSearchPerformed = $searchPerformed && in_array(SearchForm::SEARCH_TYPE_BOTTLES, $searchForm->searchType);
	$beverageSearchPerformed = $searchPerformed && in_array(SearchForm::SEARCH_TYPE_BEVERAGES, $searchForm->searchType);
	$companySearchPerformed = $searchPerformed && in_array(SearchForm::SEARCH_TYPE_COMPANIES, $searchForm->searchType);
	$styleSearchPerformed = $searchPerformed && in_array(SearchForm::SEARCH_TYPE_STYLES, $searchForm->searchType);
	$userSearchPerformed = $searchPerformed && in_array(SearchForm::SEARCH_TYPE_USERS, $searchForm->searchType);
	
	if ($searchPerformed) {
		$bottlesRetrieved = empty($searchResult->bottles) ? 0 : count($searchResult->bottles);
		$beersRetrieved = empty($searchResult->beers) ? 0 : count($searchResult->beers);
		$breweriesRetrieved = empty($searchResult->breweries) ? 0 : count($searchResult->breweries);
		$beerStylesRetrieved = empty($searchResult->beerStyles) ? 0 : count($searchResult->beerStyles);
		$usersRetrieved = empty($searchResult->users) ? 0 : count($searchResult->users);
	} else {
		$bottlesRetrieved = 0;
		$beersRetrieved = 0;
		$breweriesRetrieved = 0;
		$beerStylesRetrieved = 0;
		$usersRetrieved = 0;
	}
?>

<div class="top-banner">
	<div class="banner-title-holder">
		<span class="white-title ti-large">SEARCH</span>
	</div>
	<div class="banner-copy-holder">
		<span class="white">
			Search through our network of traders, bottles, breweries, and styles of beer. 
			Enter your search terms into the search field then browse through the results, 
			picking the tab of choice to help you navigate. Feel free to filter your searches 
			by selecting any of the options to the left. You may search the following items 
			on our site: users, bottles, companies, and styles.
		</span>
	</div>
</div>
<div id="left_menu_container">
	<?php $searchFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>FormConstants::SearchFormID,
                                                    'enableAjaxValidation'=>true,
						    						'htmlOptions' => array('enctype' => 'multipart/form-data')
                                                    )); ?>
	<?php echo $searchFormWidget->hiddenField($searchForm,'searchType',array('id'=>'SearchTypeID', 'value'=>CJSON::encode($searchForm->searchType))); ?>
	
    <div id="left_white" data-bind="with: $root.SearchManager()">
		<ul class="search-criteria-list black">
			<li style="margin-bottom: 3px;">
				<?php echo $searchFormWidget->textField($searchForm,'searchTerm',array('id'=>'SearchTermID', 'placeholder'=>'Users, Bottles, Breweries')); ?>
				<?php echo $searchFormWidget->error($searchForm,'searchTerm'); ?>
			</li>
			<li>
				<button class="small center" type="submit">SEARCH</button>
			</li>
			<li class="search-type-header">
				<input type="checkbox" data-bind="attr: { value: <?php echo SearchForm::SEARCH_TYPE_BOTTLES; ?> }, checked: selectedSearchTypes" />
	        	<span>Bottles</span>
			</li>
        	<li data-bind="visible: showBottleCriteria">
				<ul class="search-criteria">
        			<li class="search-criteria-header">
        				<?php echo $searchFormWidget->label($searchForm, 'bottleOwner'); ?>
        			<li>
					<?php
							echo $searchFormWidget->radioButtonList($searchForm, 'bottleOwner', 
										array(SearchForm::BOTTLE_OWNER_ANY_USER => 'Any User',
											  SearchForm::BOTTLE_OWNER_ANY_FRIEND => 'Any Friend')); 
					?>
				</ul>
				<br/>
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'bottleCriteria'); ?><li>
					<?php
						echo $searchFormWidget->checkBoxList($searchForm, 'bottleCriteria',
									array(SearchForm::BOTTLE_CRITERIA_LABEL => 'Label',
										  SearchForm::BOTTLE_CRITERIA_COMPANY => 'Brewery',
										  SearchForm::BOTTLE_CRITERIA_BEVERAGE_STYLE => 'Beer Style',
										  SearchForm::BOTTLE_CRITERIA_DESCRIPTION => 'Description'),
									array('checkAll' => 'Search All', 'checkAllLast' => true));
					?>
				</ul>
			</li>
			<li class="search-type-header">
				<input type="checkbox" data-bind="attr: { value: <?php echo SearchForm::SEARCH_TYPE_BEVERAGES; ?> }, checked: selectedSearchTypes" />
	        	<span>Beers</span>
        	</li>
			<li data-bind="visible: showBeverageCriteria">
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'beverageCriteria'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'beverageCriteria', 
										array(SearchForm::BEVERAGE_CRITERIA_NAME => 'Name', 
											  SearchForm::BEVERAGE_CRITERIA_COMPANY => 'Company'),
										array('checkAll' => 'Search All', 'checkAllLast' => true)); 
					?>
				</ul>
			</li>
			<?php /*<li class="search-type-header">
				<input type="checkbox" data-bind="attr: { value: <?php echo SearchForm::SEARCH_TYPE_STYLES; ?> }, checked: selectedSearchTypes" />
	        	<span>Beer Styles</span>
        	</li>
			<li data-bind="visible: showStyleCriteria">
				
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'styleType'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'styleType', 
										array(SearchForm::COMPANY_TYPE_BREWERY => BeverageType::BEER,
											  SearchForm::COMPANY_TYPE_WINERY => BeverageType::WINE,
											  SearchForm::COMPANY_TYPE_DISTILLERY => BeverageType::SPIRIT),
										array('checkAll' => 'All', 'checkAllLast' => true)); 
					?>
				</ul>
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'styleCriteria'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'styleCriteria', 
										array(SearchForm::STYLE_CRITERIA_NAME => 'Name'),
										array('checkAll' => 'Search All', 'checkAllLast' => true)); 
					?>
				</ul>
			</li>*/ ?>
			<li class="search-type-header">
				<input type="checkbox" data-bind="attr: { value: <?php echo SearchForm::SEARCH_TYPE_COMPANIES; ?> }, checked: selectedSearchTypes" />
	        	<span>Breweries</span>
        	</li>
        	<li data-bind="visible: showCompanyCriteria">
				<?php /*
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'companyType'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'companyType', 
										array(SearchForm::COMPANY_TYPE_BREWERY => CompanyType::BREWERY,
											  SearchForm::COMPANY_TYPE_WINERY => CompanyType::WINERY,
											  SearchForm::COMPANY_TYPE_DISTILLERY => CompanyType::DISTILLERY),
										array('checkAll' => 'All', 'checkAllLast' => true)); 
					?>
				</ul>
				*/ ?>
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'companyCriteria'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'companyCriteria', 
										array(SearchForm::COMPANY_CRITERIA_NAME => 'Name', 
											  SearchForm::COMPANY_CRITERIA_LOCATION => 'Location'),
										array('checkAll' => 'Search All', 'checkAllLast' => true)); 
					?>
				</ul>
			</li>
			<li class="search-type-header">
				<input type="checkbox" data-bind="attr: { value: <?php echo SearchForm::SEARCH_TYPE_USERS; ?> }, checked: selectedSearchTypes" />
	        	<span>Users</span>
        	</li>
			<li data-bind="visible: showUserCriteria">
				<ul class="search-criteria">
        			<li class="search-criteria-header"><?php echo $searchFormWidget->label($searchForm, 'userCriteria'); ?><li>
					<?php
							echo $searchFormWidget->checkBoxList($searchForm, 'userCriteria', 
										array(SearchForm::USER_CRITERIA_USER_NAME => 'Username', 
											  SearchForm::USER_CRITERIA_FORMAL_NAME => 'First or Last Name',
											  SearchForm::USER_CRITERIA_LOCATION => 'Location'),
										array('checkAll' => 'Search All', 'checkAllLast' => true)); 
					?>
				</ul>
			</li>
		</ul>
	</div>
<?php $this->endWidget();?>
</div>
<div id="right_container_with_white">
	<div id="right_white">
		<div id="search-result-loading" style="<?php if (!$searchPerformed) echo "display: none;"; ?>">
			<img src="<?php echo UrlUtils::generateImageUrl("/images/search/search_placeholder.jpg"); ?>" width="218" height="174" border="0" />
			<br/>
			<img src="<?php echo UrlUtils::generateImageUrl("/images/ajax-loader.gif"); ?>" width="40" height="40" border="0" />
		</div>
		<div id="noSearchPerformedDiv" class="center" style="<?php if ($searchPerformed) echo "display: none;"; ?>">
			<img src="<?php echo UrlUtils::generateImageUrl("/images/search/search_placeholder.jpg"); ?>" width="218" height="174" border="0" />
		</div>
		<div id="search-result-container">
			<div id="SearchPerformed"  style="display: none;">
				<div id="tab-holder">
					<div class="black">
					<span id="bottles-tab" class="search-tab">
						Bottles (<?php echo $bottlesRetrieved; ?>)
					</span>
					<span id="beer-tab" class="search-tab">
						Beers (<?php echo $beersRetrieved; ?>)
					</span>
					<span id="beer-style-tab" class="search-tab">
						Beer Styles (<?php echo $beerStylesRetrieved; ?>)
					</span>
					<span id="breweries-tab" class="search-tab">
						Breweries (<?php echo $breweriesRetrieved; ?>)
					</span>
					<span id="users-tab" class="search-tab">
						Users (<?php echo $usersRetrieved; ?>)
					</span>
					</div>
				</div>
				
				<div style="width: 630px; min-height: 590px; border: 2px solid #000;">
					<?php 
							$this->widget('application.components.widgets.popups.IsoPopup');
					?>
					<div id="bottles">
					<?php if ($searchPerformed): ?>
						<?php if ($bottleSearchPerformed): ?>
							<?php if ($bottlesRetrieved == 0): ?>
								&nbsp;&nbsp;<span class="black">No bottles found</span>
							<?php else: ?>
								<div>
									<?php foreach($searchResult->bottles as $bottle) {
											// load KO with bottle info
											$this->widget('application.components.widgets.displays.SearchResultBottleDisplay', array('bottle' => $bottle));
										}
									?>
									<div class="event-container" data-bind="foreach: $root.EventManager().bottles">
										<?php 
											// for each bottle loaded into KO, show info
											$this->widget('application.components.widgets.displays.SearchResultBottleDisplay'); 
										?>
									</div>
								</div>
							<?php endif;?>
						<?php endif;?>
					</div>
					<div id="beers">
						<?php if ($beverageSearchPerformed): ?>
							<?php if ($beersRetrieved == 0): ?>
								&nbsp;&nbsp;<span class="black">No Beers Found</span>
							<?php else: ?>
								<?php if ($beersRetrieved > 0): ?>
									<?php foreach($searchResult->beers as $beer) {
											// print display for each company
											$this->widget('application.components.widgets.displays.SearchResultBeverageDisplay', array('beverage' => $beer)); ?>
									<?php } ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div id="breweries">
						<?php if ($companySearchPerformed): ?>
							<?php if ($breweriesRetrieved == 0): ?>
								&nbsp;&nbsp;<span class="black">No Companies Found</span>
							<?php else: ?>
								<?php if ($breweriesRetrieved > 0): ?>
									<?php foreach($searchResult->breweries as $company) {
											// print display for each company
											$this->widget('application.components.widgets.displays.SearchResultCompanyDisplay', array('company' => $company)); ?>
									<?php } ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div id="beer-style">	
						<?php if ($styleSearchPerformed): ?>
							<?php if ($beerStylesRetrieved == 0): ?>
								&nbsp;&nbsp;<span class="black">No Styles Found</span>
							<?php else: ?>
								<?php if ($beerStylesRetrieved > 0): ?>
									<?php foreach($searchResult->beerStyles as $style) {
											// print display for each company
											$this->widget('application.components.widgets.displays.SearchResultStyleDisplay', array('style' => $style)); ?>
									<?php } ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div id="users">
						<?php if ($userSearchPerformed): ?>
							<?php if ($usersRetrieved == 0): ?>
								&nbsp;&nbsp;<span class="black">No Users Found</span>
							<?php else: ?>
								<?php foreach($searchResult->users as $user) {
										// print display for each company
										$this->widget('application.components.widgets.displays.SearchResultUserDisplay', array('user' => $user)); ?>
								<?php } ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; // if (!empty($searchResult)) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type='text/javascript'>
var searchPerformed = <?php echo json_encode($searchPerformed); ?>;
var bottleSearchPerformed = <?php echo json_encode($bottleSearchPerformed); ?>;
var beverageSearchPerformed = <?php echo json_encode($beverageSearchPerformed); ?>;
var companySearchPerformed = <?php echo json_encode($companySearchPerformed); ?>;
var styleSearchPerformed = <?php echo json_encode($styleSearchPerformed); ?>;
var userSearchPerformed = <?php echo json_encode($userSearchPerformed); ?>;
var bottlesRetrieved = <?php echo json_encode($bottlesRetrieved); ?>;
var beersRetrieved = <?php echo json_encode($beersRetrieved); ?>;
var breweriesRetrieved = <?php echo json_encode($breweriesRetrieved); ?>;
var beerStylesRetrieved = <?php echo json_encode($beerStylesRetrieved); ?>;
var usersRetrieved = <?php echo json_encode($usersRetrieved); ?>;

$(window).bind('load', function() {
	if (!searchPerformed){
		$("#search-result-loading").hide();
	}
	
	if (!bottleSearchPerformed)
		$("#bottles-tab").remove();

	if (!beverageSearchPerformed)
		$("#beer-tab").remove();

	if (!companySearchPerformed)
		$("#breweries-tab").remove();

	//if (!styleSearchPerformed)
		$("#beer-style-tab").remove();

	if (!userSearchPerformed)
		$("#users-tab").remove();
	
	$("#bottles-tab").click(function(){
	    $("#bottles-tab").addClass("search-tab-selected");
	    $("#beer-tab").removeClass("search-tab-selected");
	    $("#beer-style-tab").removeClass("search-tab-selected");
	    $("#breweries-tab").removeClass("search-tab-selected");
	    $("#users-tab").removeClass("search-tab-selected");
	    
	    $("#bottles").show();
	    $("#beers").hide();
	    $("#beer-style").hide();
	    $("#breweries").hide();
	    $("#users").hide();
	});
	$("#beer-tab").click(function(){
	    $("#bottles-tab").removeClass("search-tab-selected");
	    $("#beer-tab").addClass("search-tab-selected");
	    $("#beer-style-tab").removeClass("search-tab-selected");
	    $("#breweries-tab").removeClass("search-tab-selected");
	    $("#users-tab").removeClass("search-tab-selected");
	    
	    $("#bottles").hide();
		$("#beers").show();
		$("#beer-style").hide();
		$("#breweries").hide();
		$("#users").hide();
	  });
	  $("#beer-style-tab").click(function(){
	    $("#bottles-tab").removeClass("search-tab-selected");
	    $("#beer-tab").removeClass("search-tab-selected");
	    $("#beer-style-tab").addClass("search-tab-selected");
	    $("#breweries-tab").removeClass("search-tab-selected");
	    $("#users-tab").removeClass("search-tab-selected");
	    
	    $("#bottles").hide();
		$("#beers").hide();
		$("#beer-style").show();
		$("#breweries").hide();
		$("#users").hide();
	});
	$("#breweries-tab").click(function(){
	    $("#bottles-tab").removeClass("search-tab-selected");
	    $("#beer-tab").removeClass("search-tab-selected");
	    $("#beer-style-tab").removeClass("search-tab-selected");
	    $("#breweries-tab").addClass("search-tab-selected");
	    $("#users-tab").removeClass("search-tab-selected");
	    
	    $("#bottles").hide();
		$("#beers").hide();
		$("#beer-style").hide();
		$("#breweries").show();
		$("#users").hide();
	});
	$("#users-tab").click(function(){
	    $("#bottles-tab").removeClass("search-tab-selected");
	    $("#beer-tab").removeClass("search-tab-selected");
	    $("#beer-style-tab").removeClass("search-tab-selected");
	    $("#breweries-tab").removeClass("search-tab-selected");
	    $("#users-tab").addClass("search-tab-selected");
	    
	    $("#bottles").hide();
		$("#beers").hide();
		$("#beer-style").hide();
		$("#breweries").hide();
		$("#users").show();
	});

	$("#tab-holder").ready(function(){
		$("#bottles").hide();
	    $("#beers").hide();
	    $("#beer-style").hide();
	    $("#breweries").hide();
	    $("#users").hide();
	    
		if (bottleSearchPerformed && bottlesRetrieved > 0)
			$("#bottles-tab").click();
		else if (beverageSearchPerformed && beersRetrieved > 0)
			$("#beer-tab").click();
		else if (companySearchPerformed && breweriesRetrieved > 0)
			$("#breweries-tab").click();
		else if (styleSearchPerformed && beerStylesRetrieved > 0)
			$("#beer-style-tab").click();
		else if (userSearchPerformed)
			$("#users-tab").click();
	});

	if (!searchPerformed){
		$("#SearchPerformed").hide();
		$("#noSearchPerformedDiv").show();
		$("#search-result-loading").hide();
		$("#search-result-container").hide();
	} else {
		$("#SearchPerformed").show();
		$("#noSearchPerformedDiv").hide();
		$("#search-result-loading").show();
		$("#search-result-container").show();
	};
  
});
</script>

<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	$('#<?php echo FormConstants::SearchFormID; ?>').find('button[type="submit"]').first().click(function() {
		$(this).attr("disabled", "disabled");
		$("#noSearchPerformedDiv").hide();
		$("#search-result-container").hide();
		$("#search-result-loading").show();
		$('#<?php echo FormConstants::SearchFormID; ?>').attr('action', '<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri, "/"); ?>' + $('#SearchTermID').val());
		var searchTypeInput = $('#SearchTypeID');
		searchTypeInput.val(JSON.stringify(KnockoutManager.SearchManager().selectedSearchTypes()));
		$('#<?php echo FormConstants::SearchFormID; ?>').submit();
	});

	var SearchModel = function() {
	    var self = this;
	    self.selectedSearchTypes = ko.observableArray(
		    	<?php
					$array = $searchForm->searchType;
					array_walk($array, 'int_to_str');
		    		echo CJSON::encode($array);
		    	?>
	    );

	    self.showBottleCriteria = ko.computed(function() {
			$matched = ko.utils.arrayFilter(this.selectedSearchTypes(), function(checkbox) {
	            return checkbox == <?php echo SearchForm::SEARCH_TYPE_BOTTLES; ?>;
	        });
	        return $matched.length > 0;
		}, this);

	    self.showBeverageCriteria = ko.computed(function() {
			$matched = ko.utils.arrayFilter(this.selectedSearchTypes(), function(checkbox) {
	            return checkbox == <?php echo SearchForm::SEARCH_TYPE_BEVERAGES; ?>;
	        });
	        return $matched.length > 0;
		}, this);

	    self.showCompanyCriteria = ko.computed(function() {
			$matched = ko.utils.arrayFilter(this.selectedSearchTypes(), function(checkbox) {
	            return checkbox == <?php echo SearchForm::SEARCH_TYPE_COMPANIES; ?>;
	        });
	        return $matched.length > 0;
		}, this);

	    self.showStyleCriteria = ko.computed(function() {
			$matched = ko.utils.arrayFilter(this.selectedSearchTypes(), function(checkbox) {
	            return checkbox == <?php echo SearchForm::SEARCH_TYPE_STYLES; ?>;
	        });
	        return $matched.length > 0;
		}, this);

	    self.showUserCriteria = ko.computed(function() {
			$matched = ko.utils.arrayFilter(this.selectedSearchTypes(), function(checkbox) {
	            return checkbox == <?php echo SearchForm::SEARCH_TYPE_USERS; ?>;
	        });
	        return $matched.length > 0;
		}, this);
	};

	KnockoutManager.SearchManager(new SearchModel);

	$("#search-result-loading").hide();
});
</script>

<?php
	// render popup
	$this->widget('application.components.widgets.popups.BottlePopup', array(
			'renderForm' => true // always render to make it easier
	));
?>