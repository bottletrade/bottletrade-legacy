<?php 
class SearchController extends Controller
{
	public $layout='main';
    
    public $defaultAction = 'default';
    
    public function init() 
    {
    	$this->pageKeywords = array('beer network');
    	$this->pageDescription = 'Search the BottleTrade Network For Users, Beers, Breweries and Bottles.';
    }
    
    /**
     * @return array action filters
     */
    public function filters()
    {
    	return array(
    			'accessControl', // perform access control
    	);
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    
    public function accessRules()
    {
    	return array(
    			array('allow', // allow authenticated user only
    					'actions'=>array('default', 'byTerm'),
    					'users'=>array('@'),
        			),
        		array('deny',  // deny all users
        				'users'=>array('*'),
        		),
		);
	}
	public function actionDefault()
	{		
		if(isset($_POST['SearchForm'])) {
			return $this->actionByTerm(null);
		} else {
			$searchForm = new SearchForm;
			$searchForm->searchTerm = '';
			$searchForm->searchType = SearchForm::getAllTypes();
			$searchForm->bottleOwner = SearchForm::BOTTLE_OWNER_ANY_USER;
			$searchForm->bottleCriteria = array(SearchForm::BOTTLE_CRITERIA_LABEL, 
												SearchForm::BOTTLE_CRITERIA_COMPANY, 
												SearchForm::BOTTLE_CRITERIA_BEVERAGE_STYLE, 
												);
			$searchForm->beverageCriteria = SearchForm::getAllBeverageCriteria();
			$searchForm->companyType = SearchForm::getAllCompanyTypes();
			$searchForm->companyCriteria = array(SearchForm::COMPANY_CRITERIA_NAME);
			$searchForm->styleType = SearchForm::getAllCompanyTypes();
			$searchForm->styleCriteria = SearchForm::getAllStyleCriteria();
			$searchForm->userCriteria = array(	SearchForm::USER_CRITERIA_USER_NAME, 
												SearchForm::USER_CRITERIA_FORMAL_NAME
												);

			return $this->render('default', array('searchResult'=>null, 'searchForm'=>$searchForm));
		}
	}
	
	public function actionByTerm($term)
	{
		$searchForm = new SearchForm;
		$searchResult = null;

		if(isset($_POST['SearchForm'])) {
			$searchForm->attributes = $_POST['SearchForm'];
			try
			{
				$searchForm->searchType = CJSON::decode($searchForm->searchType);
			}
			catch (Exception $e)
			{
				Yii::app()->user->setFlash('error','Invalid search query');
			}
		} else {
			$searchForm->searchTerm = $term;
			$searchForm->searchType = SearchForm::getAllTypes();
			$searchForm->bottleOwner = SearchForm::BOTTLE_OWNER_ANY_USER;
			$searchForm->bottleCriteria = array(SearchForm::BOTTLE_CRITERIA_LABEL, 
												SearchForm::BOTTLE_CRITERIA_COMPANY,
												SearchForm::BOTTLE_CRITERIA_BEVERAGE_STYLE, 
												);
			$searchForm->beverageCriteria = SearchForm::getAllBeverageCriteria();
			$searchForm->companyType = SearchForm::getAllCompanyTypes();
			$searchForm->companyCriteria = array(SearchForm::COMPANY_CRITERIA_NAME);
			$searchForm->styleType = SearchForm::getAllCompanyTypes();
			$searchForm->styleCriteria = SearchForm::getAllStyleCriteria();
			$searchForm->userCriteria = array(	SearchForm::USER_CRITERIA_USER_NAME, 
												SearchForm::USER_CRITERIA_FORMAL_NAME
												);
		}
		
		if (!Yii::app()->user->hasFlash('error')) {
			if($searchForm->validate()) {
				$searchResult = $searchForm->runQuery();
				if ($searchResult == null) {
					Yii::app()->user->setFlash('error','Invalid search query');
				}
			}
		}
		
		return $this->render('default', array('searchResult'=>$searchResult, 'searchForm'=>$searchForm));
	}
}