<?php 

class SearchForm extends CFormModel
{
	const SEARCH_TYPE_BOTTLES = 2;
	const SEARCH_TYPE_BEVERAGES = 3;
	const SEARCH_TYPE_COMPANIES = 4;
	const SEARCH_TYPE_STYLES = 5;
	const SEARCH_TYPE_USERS = 6;
	public static function getAllTypes() {
		return array(self::SEARCH_TYPE_BOTTLES, self::SEARCH_TYPE_BEVERAGES, self::SEARCH_TYPE_COMPANIES, self::SEARCH_TYPE_STYLES, self::SEARCH_TYPE_USERS);
	}

	// bottle criteria for search
	const BOTTLE_OWNER_ANY_USER = 1;
	const BOTTLE_OWNER_ANY_FRIEND = 2;
	public static function getAllOwners() {
		return array(self::BOTTLE_OWNER_ANY_USER, self::BOTTLE_OWNER_ANY_FRIEND, self::BOTTLE_OWNER_SPECIFIC_USER);
	}
	
	const BOTTLE_CRITERIA_LABEL = 1;
	const BOTTLE_CRITERIA_COMPANY = 2;
	const BOTTLE_CRITERIA_BEVERAGE_STYLE = 3;
	const BOTTLE_CRITERIA_DESCRIPTION = 4;
	public static function getAllBottleCriteria() {
		return array(self::BOTTLE_CRITERIA_LABEL, self::BOTTLE_CRITERIA_COMPANY, self::BOTTLE_CRITERIA_BEVERAGE_STYLE, self::BOTTLE_CRITERIA_DESCRIPTION);
	}
	
	const BEVERAGE_CRITERIA_NAME = 1;
	const BEVERAGE_CRITERIA_COMPANY = 2;
	public static function getAllBeverageCriteria() {
		return array(self::BEVERAGE_CRITERIA_NAME, self::BEVERAGE_CRITERIA_COMPANY);
	}
	
	const COMPANY_TYPE_BREWERY = 1;
	const COMPANY_TYPE_WINERY = 2;
	const COMPANY_TYPE_DISTILLERY = 3;
	public static function getAllCompanyTypes() {
		return array(self::COMPANY_TYPE_BREWERY, self::COMPANY_TYPE_WINERY, self::COMPANY_TYPE_DISTILLERY);
	}

	// company criteria for search
	const COMPANY_CRITERIA_NAME = 1;
	const COMPANY_CRITERIA_LOCATION = 2;
	public static function getAllCompanyCriteria() {
		return array(self::COMPANY_CRITERIA_NAME, self::COMPANY_CRITERIA_LOCATION);
	}
	
	// style criteria for search
	const STYLE_CRITERIA_NAME = 1;
	public static function getAllStyleCriteria() {
		return array(self::STYLE_CRITERIA_NAME);
	}
	
	// user criteria for search
	const USER_CRITERIA_USER_NAME = 1;
	const USER_CRITERIA_FORMAL_NAME = 2;
	const USER_CRITERIA_LOCATION = 3;
	public static function getAllUserCriteria() {
		return array(self::USER_CRITERIA_USER_NAME, self::USER_CRITERIA_FORMAL_NAME, self::USER_CRITERIA_LOCATION);
	}
	
	public $searchType; // see above for possible values
	public $searchTerm;
	
	// bottle search criteria
	public $bottleOwner; // see above for possible value
	
	// company search criteria
	public $companyType; // see above for possible value

	// beverage search criteria
	public $beverageType; // see above for possible value

	// style search criteria
	public $styleType; // see above for possible value
	
	public $bottleCriteria; // fields to perform search on
	public $beverageCriteria; // fields to perform search on
	public $companyCriteria; // fields to perform search on
	public $styleCriteria; // fields to perform search on
	public $userCriteria; // fields to perform search on
	
	public function __construct() {
		// remove once we have support for other beverage types
		$this->beverageType = array(self::COMPANY_TYPE_BREWERY);
		$this->companyType = array(self::COMPANY_TYPE_BREWERY);
		$this->styleType = array(self::COMPANY_TYPE_BREWERY);
		$this->styleCriteria = array(self::STYLE_CRITERIA_NAME);
	}
        
    public function attributeLabels()
    {
    	return array(	'bottleOwner' => 'Owner',
        				'bottleCriteria' => 'Search Criteria',
    					'beverageType' => 'Type',
        				'beverageCriteria' => 'Search Criteria',
    					'companyType' => 'Type',
        				'companyCriteria' => 'Search Criteria',
    					'styleType' => 'Type',
        				'styleCriteria' => 'Search Criteria',
        				'userCriteria' => 'Search Criteria');
 	}
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
				array('searchTerm', 'required'),
				array('searchTerm', 'length', 'min'=>3),
				array('searchType, bottleCriteria, beverageType, beverageCriteria, companyType, companyCriteria, styleType, styleCriteria, userCriteria','type','type'=>'array','allowEmpty'=>true),
				array('bottleOwner','numerical','integerOnly'=>true, 'allowEmpty'=>false),
				array('searchTerm', 'length', 'max'=>100, 'allowEmpty'=>false),
				array('searchTerm, searchType, bottleOwner, companyType, bottleCriteria, companyCriteria, styleType, styleCriteria, userCriteria', 'safe')
		);
	}
	
	public function beforeValidate()
	{
		$ret = parent::beforeValidate();
		if (empty($this->searchType)) {
				$this->addError('searchType','No search criteria provided');
				$ret = false;
		} else {
			if (in_array(self::SEARCH_TYPE_BOTTLES, $this->searchType) && $this->bottleOwner == null) {
				$this->addError('bottleOwner','Please select a bottle owner');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_BOTTLES, $this->searchType) && $this->bottleCriteria == null) {
				$this->addError('bottleCriteria','Bottle search fields cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_BEVERAGES, $this->searchType) && $this->beverageCriteria == null) {
				$this->addError('beverageCriteria','Beverage search fields cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_COMPANIES, $this->searchType) && $this->companyType == null) {
				$this->addError('companyType','Company type cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_COMPANIES, $this->searchType) && $this->companyCriteria == null) {
				$this->addError('companyCriteria','Company search fields cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_STYLES, $this->searchType) && $this->styleType == null) {
				$this->addError('styleType','Style type cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_STYLES, $this->searchType) && $this->styleCriteria == null) {
				$this->addError('styleCriteria','Style search fields cannot be empty');
				$ret = false;
			}
			if (in_array(self::SEARCH_TYPE_USERS, $this->searchType) && $this->userCriteria == null) {
				$this->addError('userCriteria','User search fields cannot be empty');
				$ret = false;
			}
		}
		
		return $ret;
	}
	
	// returns SearchResult
	public function runQuery() {
		$result = new SearchResult;
		$result->bottles = null;
		$result->term = $this->searchTerm;
		$result->breweries = null;
		$result->wineries = null;
		$result->distilleries = null;
		$result->beers = null;
		$result->wines = null;
		$result->spirits = null;
		$result->beerStyles = null;
		$result->wineStyles = null;
		$result->spiritStyles = null;
		$result->users = null;
		
		// start bottle search
		if (in_array(self::SEARCH_TYPE_BOTTLES, $this->searchType)) {
			$conditionStmt = "IsSearchable=1 ";
			$joinStmt = "";
			$params = array(":keyword"=>"%$this->searchTerm%");
			$addedBeerJoin = false;
			
			// create bottle criteria
			$bottleCriteriaStr = "";
			
			// check which fields where requested to be included
			if (in_array(self::BOTTLE_CRITERIA_LABEL, $this->bottleCriteria)) {
				$joinStmt .= "LEFT JOIN beer ON `t`.BeerID = beer.ID ";
				$addedBeerJoin = true;
				if (!empty($bottleCriteriaStr)) $bottleCriteriaStr .= "OR ";
				$bottleCriteriaStr.= "beer.Name LIKE :keyword ";
			}
			if (in_array(self::BOTTLE_CRITERIA_COMPANY, $this->bottleCriteria)) {
				// need to add beer join if not added before
				if (!$addedBeerJoin) {
					$joinStmt .= "LEFT JOIN beer ON `t`.BeerID = beer.ID ";
					$addedBeerJoin = true;
				}
				$joinStmt .= "LEFT JOIN brewery ON beer.BreweryID = brewery.ID ";
				if (!empty($bottleCriteriaStr)) $bottleCriteriaStr .= "OR ";
				$bottleCriteriaStr.= "brewery.Name LIKE :keyword ";
			}
			if (in_array(self::BOTTLE_CRITERIA_BEVERAGE_STYLE, $this->bottleCriteria)) {
				// need to add beer join if not added before
				if (!$addedBeerJoin) {
					$joinStmt .= "LEFT JOIN beer ON `t`.BeerID = beer.ID ";
					$addedBeerJoin = true;
				}
				$joinStmt .= "LEFT JOIN beerstyle ON beer.StyleID = beerstyle.ID ";
				if (!empty($bottleCriteriaStr)) $bottleCriteriaStr .= "OR ";
				$bottleCriteriaStr.= "beerstyle.Name LIKE :keyword ";
			}
			if (in_array(self::BOTTLE_CRITERIA_DESCRIPTION, $this->bottleCriteria)) {
				if (!empty($bottleCriteriaStr)) $bottleCriteriaStr .= "OR ";
				$bottleCriteriaStr.= "`t`.Description LIKE :keyword ";
			}
			
			// check if we have any bottle criteria and assign to search criteria
			if (!empty($bottleCriteriaStr)) {
				$conditionStmt .= "AND ($bottleCriteriaStr) ";
			}
			
			if ($this->bottleOwner == self::BOTTLE_OWNER_ANY_FRIEND) {
				$conditionStmt = 'friend.User1=:uid AND '.$conditionStmt;
				$joinStmt = 'LEFT JOIN friend ON UserID = friend.User2 '.$joinStmt;
				$params = array_merge(array(':uid'=>Yii::app()->user->ID),$params);
			}

			// clear statements to not be used in query
			if (empty($joinStmt)) { $joinStmt = null; }
			if (count($params) == 0) { $params = null; }
			
			$result->bottles = Bottle::model()->findAll(array(
								'condition'=>$conditionStmt,
								'join' => $joinStmt,
								'params'=>$params,
								'order'=>'CreatedTime DESC'));
		} 
		// end bottle search
		
		// start beverage search
		if (in_array(self::SEARCH_TYPE_BEVERAGES, $this->searchType)) {
			$query = new CDbCriteria();
			
			// perform search for each beverage type
			if (in_array(self::COMPANY_TYPE_BREWERY, $this->beverageType)) {
				// perform search
				if (in_array(self::BEVERAGE_CRITERIA_NAME, $this->beverageCriteria)) {
					$query->addSearchCondition('t.Name', $this->searchTerm, true, "OR");
				}
				if (in_array(self::BEVERAGE_CRITERIA_COMPANY, $this->beverageCriteria)) {
					$query->addSearchCondition('brewery.Name', $this->searchTerm, true, "OR");
					$query->join = "JOIN brewery ON t.BreweryID = brewery.ID";
				}
				$query->order = "t.Name ASC";
				$result->beers = Beer::model()->findAll($query);
			}
		}
		// end beverage search
		
		// start company search
		if (in_array(self::SEARCH_TYPE_COMPANIES, $this->searchType)) {
			$query = new CDbCriteria();
			
			// check which fields where requested to be included
			if (in_array(self::COMPANY_CRITERIA_NAME, $this->companyCriteria)) {
				$query->addSearchCondition('Name', $this->searchTerm, true, "OR");
			}
			if (in_array(self::COMPANY_CRITERIA_LOCATION, $this->companyCriteria)) {
				$query->addSearchCondition('City', $this->searchTerm, true, "OR");
				$query->addSearchCondition('State', $this->searchTerm, true, "OR");
				$query->addSearchCondition('Country', $this->searchTerm, true, "OR");
			}
			$query->order = "Name ASC";
			
			// perform search for each company type
			if (in_array(self::COMPANY_TYPE_BREWERY, $this->companyType)) {
				// perform search
				$result->breweries = Brewery::model()->findAll($query);
			}
			if (in_array(self::COMPANY_TYPE_WINERY, $this->companyType)) {
				// perform search
				$result->wineries = Winery::model()->findAll($query);
			}
			if (in_array(self::COMPANY_TYPE_DISTILLERY, $this->companyType)) {
				// perform search
				$result->distilleries = Distillery::model()->findAll($query);
			}
		} 
		// end company search
		/*
		// start style search
		if (in_array(self::SEARCH_TYPE_STYLES, $this->searchType)) {
			$query = new CDbCriteria();

			// perform search for each company type
			if (in_array(self::COMPANY_TYPE_BREWERY, $this->styleType)) {
				// check which fields where requested to be included
				if (in_array(self::STYLE_CRITERIA_NAME, $this->styleCriteria)) {
					$query->addSearchCondition('Name', $this->searchTerm, true, "OR"); // TODO: add support for category search
				}
				$query->order = "Name ASC";
				
				// perform search
				$result->beerStyles = Beerstyle::model()->findAll($query);
			}
			if (in_array(self::COMPANY_TYPE_WINERY, $this->styleType)) {
				// check which fields where requested to be included
				if (in_array(self::STYLE_CRITERIA_NAME, $this->styleCriteria)) {
					$query->addSearchCondition('Name', $this->searchTerm, true, "OR");
				}
				$query->order = "Name ASC";
				
				// perform search
				$result->wineStyles = WineStyle::model()->findAll($query);
			}
			if (in_array(self::COMPANY_TYPE_DISTILLERY, $this->styleType)) {
				// check which fields where requested to be included
				if (in_array(self::STYLE_CRITERIA_NAME, $this->styleCriteria)) {
					$query->addSearchCondition('Name', $this->searchTerm, true, "OR");
				}
				$query->order = "Name ASC";
				
				// perform search
				$result->spiritStyles = SpiritStyle::model()->findAll($query);
			}
		}
		// end style search
		*/
		// start user search
		if (in_array(self::SEARCH_TYPE_USERS, $this->searchType)) {
			$query = new CDbCriteria();

			// check which fields where requested to be included
			if (in_array(self::USER_CRITERIA_USER_NAME, $this->userCriteria)) {
				$query->addSearchCondition('Username', $this->searchTerm, true, "OR");
			}
			if (in_array(self::USER_CRITERIA_FORMAL_NAME, $this->userCriteria)) {
				$query->addSearchCondition('FirstName', $this->searchTerm, true, "OR");
				$query->addSearchCondition('LastName', $this->searchTerm, true, "OR");
				$query->addSearchCondition('CONCAT(FirstName," ",LastName)', $this->searchTerm, true, "OR");
			}
			if (in_array(self::USER_CRITERIA_LOCATION, $this->userCriteria)) {
				$query->addSearchCondition('City', $this->searchTerm, true, "OR");
				$query->addSearchCondition('DisplayCity', $this->searchTerm, true, "OR");
				$query->addSearchCondition('State', $this->searchTerm, true, "OR");
				$query->addSearchCondition('Country', $this->searchTerm, true, "OR");
			}
			$query->order = "Username ASC";
			
			// perform search
			$result->users = User::model()->findAll($query);
		}
		// end user search
		
		return $result;
	}
}

?>