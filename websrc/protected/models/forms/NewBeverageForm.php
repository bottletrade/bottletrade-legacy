<?php
    
    class NewBeverageForm extends CFormModel
    {
        public $beverageType;
        public $companyType;
        public $companyName;
        public $breweryId;
        public $wineryId;
        public $distilleryId;
        public $styleId;
        public $name;
        public $abv;
        public $ibu;
        public $srm;
        public $upc;
        public $availability;
        public $description;
        
        public function attributeLabels()
        {
        	return array('breweryId' => CompanyType::BREWERY,
        			'wineryId' => CompanyType::WINERY,
        			'distilleryId' => CompanyType::DISTILLERY,
        			'beverageType' => 'Beverage Type',
        			'name' => 'Label',
        			'abv' => 'ABV%',
        			'ibu' => 'IBU',
        			'srm' => 'SRM',
        			'upc' => 'UPC');
        }
        
        public function __construct()
        {
        	$this->beverageType = BeverageType::BEER;
        	$this->companyType = CompanyType::BREWERY;
        	return parent::init();
        }
        
        public function rules()
        {
        	return array(
        			array('name', 'required'),
        			array('name', 'length', 'max'=>60),
            		array('breweryId,wineryId,distilleryId','numerical','integerOnly'=>true, 'allowEmpty'=>true),
            		array('breweryId,wineryId,distilleryId','checkCompany'),
            		array('beverageType','in','range'=>BeverageType::getAllTypes()),
            		array('availability','in','range'=>BeerAvailability::getAllTypes()),
        			array('description', 'length', 'max'=>2000),
        			array('styleId','numerical','integerOnly'=>true, 'allowEmpty'=>false),
        			array('upc','numerical','integerOnly'=>true, 'allowEmpty'=>true),
        			array('abv, ibu, srm','numerical', 'allowEmpty'=>true),
        			array('companyName', 'safe')
        	);
        }
        

        public function checkCompany($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		switch ($this->beverageType)
        		{
        			case BeverageType::BEER:
        				if (empty($this->breweryId)) {
        					$this->addError('breweryId','Invalid brewery provided, must select from autocomplete list or add a new brewery to our network');
        				}
        				break;
        			case BeverageType::WINE:
        				if (empty($this->wineryId)) {
        					$this->addError('wineryId','Invalid winery provided, must select from autocomplete list or add a new winery to our network');
        				}
        				break;
        			case BeverageType::SPIRIT:
        				if (empty($this->distilleryId)) {
        					$this->addError('distilleryId','Invalid distillery provided, must select from autocomplete list or add a new distillery to our network');
        				}
        				break;
        		}
        	}
        }
        
    public function save()
        {
        	if ($this->beverageType == BeverageType::BEER) {
	        	$beverage = new Beer;
	        	$beverage->Name = $this->name;
	        	$beverage->BreweryID = $this->breweryId;
	        	$beverage->StyleID = $this->styleId;
	        	$beverage->ABV = $this->abv;
	        	$beverage->IBU = $this->ibu;
	        	$beverage->SRM = $this->srm;
	        	$beverage->UPC = $this->upc;
	        	$beverage->Availability = $this->availability;
	        	$beverage->Description = $this->description;
	        	$beverage->UserAdded = Yii::app()->user->ID;
	        	$beverage->CreatedTime = DateTimeUtils::getCurrentDateTime();
	        	$beverage->LastUpdateTime = DateTimeUtils::getCurrentDateTime();
        	}
        	if (!$beverage->save()) {
        		ExceptionUtils::logException(ExceptionUtils::createVarException($beverage));
        		return false;
        	} else {
              	$emailSender = new EmailSender();       	
				$emailSender->sendAddBeverageEmail($beverage);
        		
        		return true;
        	}
        }
        
        public static function MakeEmptyDisplayData() {
        	$display = array();
        	$display["beverageType"] = "";
        	$display["companyType"] = "";
        	$display["companyName"] = "";
        	$display["breweryId"] = "";
        	$display["wineryId"] = "";
        	$display["distilleryId"] = "";
        	$display["styleId"] = "";
        	$display["label"] = "";
        	$display["abv"] = "";
        	$display["ibu"] = "";
        	$display["srm"] = "";
        	$display["upc"] = "";
        	$display["availability"] = "";
        	$display["description"] = "";
        	return $display;
        }

        public static function MakeDisplayDataWithForm($form) {
        	$display = self::MakeEmptyDisplayData();
        	$display["beverageType"] = $form->beverageType;
        	$display["companyType"] = $form->companyType;
        	$display["companyName"] = $form->companyName;
        	$display["breweryId"] = $form->breweryId;
        	$display["wineryId"] = $form->wineryId;
        	$display["distilleryId"] = $form->distilleryId;
        	$display["styleId"] = $form->styleId;
        	$display["label"] = $form->name;
        	$display["abv"] = $form->abv;
        	$display["ibu"] = $form->ibu;
        	$display["srm"] = $form->srm;
        	$display["upc"] = $form->upc;
        	$display["availability"] = $form->availability;
        	$display["description"] = $form->description;
        	return $display;
        }
    }