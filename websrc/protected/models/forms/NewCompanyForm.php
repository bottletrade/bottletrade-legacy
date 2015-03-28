<?php
    
    class NewCompanyForm extends CFormModel
    {
        public $companyType;
        public $name;
        public $address1;
        public $address2;
        public $city;
        public $state;
        public $code;
        public $country;
        public $phone;
        public $established;
        public $website;
        public $imagename;
        public $description;

        public function attributeLabels()
        {
        	return array(	'name' => 'Brewery Name',
        					'address1' => 'Street Address',
        					'address2' => 'Extended Address',
        					'state' => 'State/Region',
        					'code' => 'Postal Code');
        }
        
        public function init() 
        {
        	$this->companyType = CompanyType::BREWERY;
        	return parent::init();
        }
        
        public function rules()
        {
        	return array(
        			array('name', 'required'),
        			array('name', 'length', 'max'=>60),
        			array('address1, address2, city, state, country, website', 'length', 'max'=>64),
        			array('website', 'length', 'max'=>255),
        			array('description', 'length', 'max'=>2000),
        			array('code', 'length', 'max'=>25),
        			array('phone', 'length', 'max'=>50),
            		array('companyType','in','range'=>CompanyType::getAllTypes()),
        			array('established', 'date', 'format'=>array('yyyy-mm-dd', 'yyyy-mm', 'yyyy'), 'allowEmpty'=>true),
        			array('imagename', 'safe')
        	);
        }
        
        public function save()
        {
        	$company = new Brewery;
        	$company->Name = $this->name;
        	$company->Address1 = $this->address1;
        	$company->Address2 = $this->address2;
        	$company->City = $this->city;
        	$company->State = $this->state;
        	$company->Code = $this->code;
        	$company->Country = $this->country;
        	$company->Phone = $this->phone;
        	$company->Website = $this->website;
        	if (!empty($this->established)) {
        		$company->Established = date('Y-m-d',strtotime($this->established));
        	} else {
        		$company->Established = null;
        	}
        	$company->Description = $this->description;
        	$company->UserAdded = Yii::app()->user->ID;
        	$company->CreatedTime = DateTimeUtils::getCurrentDateTime();
        	$company->LastUpdateTime = $company->CreatedTime;
        	
        	if (!$company->save()) {
        		ExceptionUtils::logException(ExceptionUtils::createVarException($company));
        		return false;
        	} else {
        		$emailSender = new EmailSender();
        		$emailSender->sendAddCompanyEmail($company);
        		return true;
        	}
        }
        
        public static function MakeEmptyDisplayData() {
        	$display = array();
        	$display["companyType"] = CompanyType::BREWERY;
        	return $display;
        }

        public static function MakeDisplayDataWithForm($form) {
        	$display = self::MakeEmptyDisplayData();
        	$display["companyType"] = $form->companyType;
        	return $display;
        }
    }