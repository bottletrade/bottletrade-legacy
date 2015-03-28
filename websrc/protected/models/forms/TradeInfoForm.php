<?php
    class TradeInfoForm extends CFormModel
    {
    	public $tradeId;
    	public $shipDate;
    	public $hasShipped;
        public $hasReceived;
        public $delete;
        public $canReview;
        
        public function attributeLabels()
        {
        	return array('shipDate' => 'Expected Ship Date',
        				 'hasShipped' => 'Bottles Have Been Shipped',
        				 'hasReceived' => 'Bottles Have Been Received');
        }
        
        public function init()
        {
        	$this->delete=0;
        	return parent::init();
        }
        
        public function rules()
        {
        	return array(
        			array('tradeId, delete', 'required'),
        			array('tradeId','numerical','integerOnly'=>true,),
        			array('hasShipped, hasReceived, delete', 'boolean'),
                    array('shipDate', 'date', 'format'=>array('yyyy-mm-dd')),
        			array('shipDate', 'checkShipDate'),
        			array('shipDate, hasShipped, hasReceived', 'safe')
            );
        }
        
        public function checkShipDate($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		// check whether shipDate can be empty
        		if (empty($this->shipDate)) {
	        		$trade = Trade::model()->findByPk($this->tradeId);
	        		if ($trade == null) {
	        			$this->addError('tradeId','Trade not found');
	        		} else {
	        			// check if trade is being deleted, allowing ship date to be empty
	        			if ($this->delete != 1) {
		        			// check if the user already set ship date, allowing ship date to be empty
		        			$currUserTradeInfo = Trade::getCurrentUserTradeInfo($trade);
			        		if (!TradeStatus::checkStatusEqual($currUserTradeInfo, TradeStatus_ShipDateSet)) {
		        				$this->addError('shipDate','Ship date must be set prior to selecting any other options');
			        		}
	        			}
	        		}
        		}
        	}
        }
        
        public function canSaveForm() {
        	return $this->shipDate == null || !$this->hasShipped || !$this->hasReceived;
        }
        
        private function completeTrade($trade, &$createdFiles) {
        	$createdFiles = array();
        	
        	// convert bottles offers to bottles traded
        	$users = Trade::getUsers($trade);
        	$bottleTrades = BottleTrade::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$trade->ID)));
        	foreach ($bottleTrades as $bottleTrade) {
        		// update bottle quantity for seller
        		$bottleTrade->bottle->Quantity -= $bottleTrade->Quantity;
        		if ($bottleTrade->bottle->Quantity < 0) $bottleTrade->bottle->Quantity = 0;
        		if (!$bottleTrade->bottle->save()) {
        			throw ExceptionUtils::createVarException($bottleTrade->bottle);
        		}
        		$sellerUserId = $bottleTrade->bottle->UserID;
        		$buyerUserId = $users[0]->ID == $sellerUserId ? $users[1]->ID : $users[0]->ID;
        
        		// find same bottle in buyers cellar
        		switch (Bottle::getBeverageType($bottleTrade->bottle)) {
        			case BeverageType::BEER:
        				$bottle = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND BeerID=:bid AND IsActive=1',
        						'params'=>array(':uid'=>$buyerUserId,
        								':bid'=>$bottleTrade->bottle->BeerID)));
        				break;
        			case BeverageType::WINE:
        				$bottle = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND WineID=:bid AND IsActive=1',
        						'params'=>array(':uid'=>$buyerUserId,
        								':bid'=>$bottleTrade->bottle->WineID)));
        				break;
        			case BeverageType::SPIRIT:
        				$bottle = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND SpiritID=:bid AND IsActive=1',
        						'params'=>array(':uid'=>$buyerUserId,
        								':bid'=>$bottleTrade->bottle->SpiritID)));
        				break;
        		}
        		
        		if ($bottle != null) {
        			// found matching bottle
        			$bottle = $bottle[0];
        			
        			// update same bottle in buyers cellar
        			$bottle->Quantity = $bottle->Quantity + $bottleTrade->Quantity;
        			if ($bottle->Quantity < 0) $bottle->Quantity = 0;
        			if (!$bottle->save()) {
        				throw ExceptionUtils::createVarException($bottle);
        			}
        		} else {
        			// add new bottle to buyers cyber cellar
        			$bottle = new Bottle();
        			$bottle->attributes = $bottleTrade->bottle->attributes; // transfer data
        
        			// set defaults
        			$bottle->ID = null;
        			$bottle->IsTradeable = 1;
        			$bottle->IsSearchable = 1;
        			$bottle->IsPrivate = 0;
        			$bottle->UserID = $buyerUserId;
        			$bottle->Quantity = $bottleTrade->Quantity;
        			$bottle->Description = "";
        			$bottle->ImagePath = null;
        			$bottle->CreatedTime = DateTimeUtils::getCurrentDateTime();
        			$bottle->LastUpdateTime = $bottle->CreatedTime;

        			// need to copy image
        			/*if ( $bottleTrade->bottle->ImagePath != null) {
        				$otherUserImage = ImageManager::getAbsoluteDataPath($bottleTrade->bottle->ImagePath);
        				$newImagePath = ImageManager::generateUniqueFileName(ImageManager::getBottlePicPath(), $otherUserImage);
        				
        				if (file_exists($otherUserImage)) {
        					copy($otherUserImage, $newImagePath);
        				}
        				array_push($createdFiles, $newImagePath);
        				$bottleTrade->bottle->ImagePath = ImageManager::getRelativeDataPath($newImagePath);
        			}*/
        			
        			if (!$bottle->save()) {
        				throw ExceptionUtils::createVarException($bottle);
        			}
        		}
        	}
        }
        
        public function save()
        {
        	$transaction = Yii::app()->db->beginTransaction();
        	$ret = false;
        	$createdFiles = array();
        	try
        	{
        		$trade = Trade::model()->findByPk($this->tradeId);
        		if ($trade == null)
        		{
        			throw new Exception("Specified Trade cannot be found");
        		}
        		
        		$currUserTradeInfo = Trade::getCurrentUserTradeInfo($trade);
        		$otherUserTradeInfo = Trade::getOtherUserTradeInfo($trade);
        		if ($currUserTradeInfo == null && $otherUserTradeInfo == null)
        		{
        			throw new Exception("Cannot find user trade info for specified trade");
        		}

        		$tradeCompleted = false;
        		$tradeCancelled = false;
        		$tradeInfoUpdated = array();
        		if ($this->delete == 1) {
	        		TradeStatus::setStatus($trade, TradeStatus_Cancelled);
	        		TradeStatus::setStatus($otherUserTradeInfo, TradeStatus_Cancelled);
	        		TradeStatus::setStatus($currUserTradeInfo, TradeStatus_Cancelled);
	        		$tradeCancelled = true;
        		} else {
	        		if ($this->shipDate != null) {
	        			$currUserTradeInfo->ShipDate = $this->shipDate;
	        			TradeStatus::setStatus($currUserTradeInfo, TradeStatus_ShipDateSet);
	        			$tradeInfoUpdated[] = TradeStatus_ShipDateSet;
	        			
	        			// update trade if both users have set ship date
	        			if (TradeStatus::checkStatusEqual($otherUserTradeInfo, TradeStatus_ShipDateSet)) {
	        				TradeStatus::setStatus($trade, TradeStatus_ShipDateSet);
	        			}
	        		}
	        		
	        		if ($this->hasShipped) {
	        			TradeStatus::setStatus($currUserTradeInfo, TradeStatus_Shipped);
	        			$tradeInfoUpdated[] = TradeStatus_Shipped;
	
	        			// update trade if both users have shipped bottles
	        			if (TradeStatus::checkStatusEqual($otherUserTradeInfo, TradeStatus_Shipped)) {
	        				TradeStatus::setStatus($trade, TradeStatus_Shipped);
	        			}
	        		}
	        		
	        		if ($this->hasReceived) {
	        			TradeStatus::setStatus($currUserTradeInfo, TradeStatus_Received);
	        			$tradeInfoUpdated[] = TradeStatus_Received;
	
	        			// update trade if both users have received bottles
	        			if (TradeStatus::checkStatusEqual($otherUserTradeInfo, TradeStatus_Received)) {
	        				TradeStatus::setStatus($trade, TradeStatus_Received);
	        			}
	        		}
	        		
	        		// check if trade completed
	        		if ($trade->CompletedTime == null && Trade::isComplete($trade)) {
	        			$tradeCompleted = true;
	        			$this->completeTrade($trade, $createdFiles);
	        			
	        			// update completed time for user trade info
	        			$completedTime = DateTimeUtils::getCurrentDateTime();
	        			$currUserTradeInfo->CompletedTime = $completedTime;
	        			$otherUserTradeInfo->CompletedTime = $completedTime;
	        			
	        			// update completed time for trade
	        			$trade->CompletedTime = $completedTime;
	        		}
        		}
        		
        		if (!$trade->save()) {
        			throw new Exception("Unable to update trade");
        		}
        		
        		if (!$currUserTradeInfo->save()) {
        			throw new Exception("Unable to update trade info");
        		}
        		
        		if (!$otherUserTradeInfo->save()) {
        			throw new Exception("Unable to update trade info");
        		}
        		
	        	$transaction->commit();
	        	
	        	// Send email
	        	$emailSent = false;
	        	if ($tradeCompleted) {
	        		$emailSender = new EmailSender();
	        		$emailSent = $emailSender->sendTradeCompleteEmail($trade);
	        	} else if ($tradeCancelled) {
	        		$emailSender = new EmailSender();
	        		$emailSent = $emailSender->sendTradeCancelledEmail($trade);
	        	}
	        	// email may not have been sent as user disabled email,
	        	// attempt to send trade update email
	        	if (!$emailSent && count($tradeInfoUpdated) > 0) {
	        		$emailSender = new EmailSender();
	        		$emailSender->sendTradeUpdatedEmail($trade, $tradeInfoUpdated);
	        	}
        		return true;
        	}
        	catch (Exception $e)
        	{
        		foreach ($createdFiles as $file) {
        			if (file_exists($file)) {
        				unlink($file);
        			}
        		}
        		$transaction->rollback();
        		ExceptionUtils::logException($e);
        		return false;
        	}
        }
    }