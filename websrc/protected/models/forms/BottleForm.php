<?php
    
    class BottleForm extends CFormModel
    {
    	public $imagename;
        public $beverageType;
        public $beverageName;
        public $companyName;
        public $companyId;
    	public $bottleId;
    	public $beerId;
    	public $wineId;
    	public $spiritId;
        public $fluidAmount;
        public $quantity;
        public $bottledOnDate;
        public $purchasePrice;
        public $description;
        public $isTradeable;
        public $isSearchable;
        public $isPrivate;
        
        public function __construct()
        {
        	$this->isPrivate = false;
        	$this->isSearchable = true;
        	$this->description = '';
        	
        	$this->beverageType = BeverageType::BEER;
        	return parent::init();
        }
        
        public function attributeLabels()
        {
        	return array('beerId' => BeverageType::BEER,
        				 'wineId' => BeverageType::WINE,
        				 'spiritId' => BeverageType::SPIRIT,
        				 'beverageType' => 'Beverage Type',
        				 'isTradeable' => 'Tradeable',
        				 'purchasePrice' => 'Purchase Price',
        				 'bottledOnDate' => '"Bottled On" Date',
        				 'isPrivate' => 'Private',
        				 'isSearchable' => 'Searchable');
        }
        
        /**
         * Declares the validation rules.
         */
        public function rules()
        {
            return array(
	            		array('bottleId, delete', 'required', 'on' => 'delete'),
            			array('beerId,wineId,spiritId','numerical','integerOnly'=>true, 'allowEmpty'=>true),
            			array('beerId,wineId,spiritId','checkBeverage'),
            			array('quantity','numerical','integerOnly'=>true, 'allowEmpty'=>false),
            			array('isPrivate, isSearchable', 'boolean'),
	            		array('isTradeable','in','range'=> array("Yes","No")),
            			array('beverageType','in','range'=>BeverageType::getAllTypes()),
                        array('bottledOnDate', 'date', 'format'=>array('yyyy-mm-dd', 'yyyy-mm', 'yyyy'), 'allowEmpty'=>false, 'message'=>'"Bottled On" Date should be in the following format: yyyy, yyyy-mm or yyyy-mm-dd'),
            			array('fluidAmount', 'in','range'=> BottleSize::getAllValidSizes()),
            			array('purchasePrice', 'type', 'type'=>'float', 'message'=>'Purchase Price should be in the following format: xxx or xx.xx (Ex. 129 or 7.99)'),
            			array('purchasePrice', 'match', 'pattern'=>'/\d+|\d+\.\d{1,2}/', 'message'=>'Purchase price should be rounded to the nearest cent'),
            			array('bottleId', 'checkForDuplicate'),
            			array('description, beverageName, companyId, companyName, imagename', 'safe')
            );
        }
        
        public function checkBeverage($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		switch ($this->beverageType)
        		{
        			case BeverageType::BEER:
        				if (empty($this->beerId)) {
        					$this->addError('beerId','Invalid beer provided, must select from list');
        				}
        				break;
       				case BeverageType::WINE:
        				if (empty($this->wineId)) {
        					$this->addError('wineId','Invalid wine provided, must select from list');
        				}
       					break;
       				case BeverageType::SPIRIT:
        				if (empty($this->spiritId)) {
        					$this->addError('spiritId','Invalid spirit provided, must select from list');
        				}
       					break;
        		}
        	}
        }
        
    	public function checkForDuplicate($attribute,$params)
    	{
    		if(!$this->hasErrors())
    		{
    			// check for same type
    			$beverageFieldName = "";
    			$beverageFieldValue = "";
    			switch ($this->beverageType)
	        	{
		        	case BeverageType::BEER:
		        		$beverageFieldName = "BeerID";
		       			$beverageFieldValue = $this->beerId;
		       			break;
		       		case BeverageType::WINE:
		       			$beverageFieldName = "WineID";
		       			$beverageFieldValue = $this->wineId;
		       			break;
		       		case BeverageType::SPIRIT:
		       			$beverageFieldName = "SpiritID";
	        			$beverageFieldValue = $this->spirit;
	        			break;
		        }
		       	$bottle = Bottle::model()->find(array(
		       					'condition'=>$beverageFieldName."=:bevId AND UserID=:uid AND IsActive=1",
		        				'params'=>array(':bevId'=>$beverageFieldValue, ':uid'=>Yii::app()->user->ID)));
	    		if ($bottle != null) {
	    			// check if bottle is the one being updated
	    			if (!empty($this->bottleId) && $bottle->ID != $this->bottleId) {
	    				$this->addError('beverageName','Bottle already exists in your Cyber Cellar, update properties of existing bottle instead');
	    			}
	    		}
    		}
    	}
        
        public function commit()
        {
        	$transaction = Yii::app()->db->beginTransaction();
        	$ret = false;
        	$createdFile = null;
        	try
        	{
        		$isNewBottle = $this->bottleId == null || $this->bottleId <= 0;
        		
        		if ($isNewBottle) {
        			// create new bottle
        			$bottle = new Bottle;
        			$bottle->UserID = Yii::app()->user->ID; // set user
        			$bottle->IsActive = 1; // set active
        		} else {
        			$bottle = Bottle::model()->findByPk($this->bottleId);
        		}
	        		
        		// record whether description changed
        		$descriptionChanged = $bottle->Description != $this->description;

        		$oldImagePath = null;
        		if ($this->imagename != null) {
        			// new image uploaded
        			$tempImagePath = PathUtils::pathCombine(ImageManager::getTempUploadPath(), $this->imagename);
        			$newImagePath = ImageManager::generateUniqueFileName(ImageManager::getBottlePicPath(), $this->imagename);
        			 
        			rename($tempImagePath, $newImagePath);
        			$createdFile = $newImagePath;
        			$oldImagePath = empty($bottle->ImagePath) ? null : ImageManager::getAbsoluteDataPath($bottle->ImagePath);
        			$bottle->ImagePath = ImageManager::getRelativeDataPath($newImagePath);
        		}
	        	switch ($this->beverageType)
	        	{
		        	case BeverageType::BEER:
	        			$bottle->BeerID = $this->beerId;
	        			break;
		        	case BeverageType::WINE:
	        			$bottle->BeerID = $this->wineId;
	        			break;
		        	case BeverageType::SPIRIT:
	        			$bottle->BeerID = $this->spiritId;
	        			break;
	        	}
	            $bottle->Quantity = $this->quantity;
	            $bottle->FluidAmount = $this->fluidAmount;
	            $bottle->PurchasePrice = number_format(floatval($this->purchasePrice), 2, '.', '');
	            $bottle->IsTradeable = !$this->isPrivate && $this->isTradeable == "Yes" ? 1 : 0;
	            $bottle->IsSearchable = !$this->isPrivate && $this->isSearchable ? 1 : 0;
	            $bottle->IsPrivate = $this->isPrivate ? 1 : 0;
	            $bottle->Description = empty($this->description) ? '' : $this->description;
	            $bottle->LastUpdateTime = DateTimeUtils::getCurrentDateTime();
	            
	            // handle bottled on date
	            $bottledOnLen = strlen($this->bottledOnDate);
	            if ($bottledOnLen == 4) {
	            	// just year provided, add zeroed month/day
	            	$this->bottledOnDate = $this->bottledOnDate."-00-00";
	            } else if ($bottledOnLen == 7) {
	            	// just year provided, add zeroed day
	            	$this->bottledOnDate = $this->bottledOnDate."-00";
	            }
	            $bottle->BottledOnDate = $this->bottledOnDate;

	            if ($isNewBottle) {
	            	$bottle->CreatedTime = $bottle->LastUpdateTime;
	            }
	            
	            if (!$bottle->save()) {
	            	throw ExceptionUtils::createVarException($bottle);
	            }
	            
	            // check if Description changed
	            if ($descriptionChanged) {
	            	// get old hash tags
	            	$oldHashTags = HashTag::model()->deleteAll(array('condition'=>'BottleID=:tid',
	            			'params'=>array(':tid'=>$bottle->ID)));
	            
	            	// find all hashtags in description
	            	$pregRet = preg_match_all("/#(?P<tag>\w+)/", $bottle->Description, $newHashTags);
	            	if ($pregRet !== FALSE and $pregRet > 0) {
	            		// keep list of saved hashtags
	            		$savedHashTags = array();
	            		
	            		foreach($newHashTags["tag"] as $tag) {
	            			$lowerTag = strtolower($tag);
	            			// check if we already saved this tag
	            			if (!in_array($lowerTag, $savedHashTags)) {
	            				// record saved tag
	            				$savedHashTags[] = $lowerTag;
	            				
	            				// save hash tag in DB
		            			$hashtag = new HashTag;
		            			$hashtag->BottleID = $bottle->ID;
		            			$hashtag->Tag = $lowerTag;
		            			$hashtag->SentTime = $bottle->LastUpdateTime;
		            			if (!$hashtag->save()) {
		            				throw ExceptionUtils::createVarException($hashtag);
		            			}
	            			}
	            		}
	            	}
	            }
	            
	            // delete old image
	            if ($oldImagePath != null && file_exists($oldImagePath)) {
	            	unlink($oldImagePath);
	            }
		            
	        	$transaction->commit();
	        	return true;
            }
            catch (CHttpException $e)
            {
            	$transaction->rollback();

            	// delete new image
            	if ($createdFile != null && file_exists($createdFile)) {
            		unlink($createdFile);
            	}
            	
            	ExceptionUtils::logException($e);
            	return false;
            }
            catch(Exception $e)
            {
            	$transaction->rollback();
            	ExceptionUtils::logException($e);
            	return false;
            }
        }
    }
