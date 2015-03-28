<?php

    class TraderReviewForm extends CFormModel
    {
    	public $tradeId;
    	public $userTo;
    	public $rating;
    	public $message;
    
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				array('tradeId, userTo, rating, message', 'required'),
    				array('message','length','max'=>1000),
    				array('tradeId, userTo','numerical','integerOnly'=>true),
					array('tradeId', 'verifyUsers'),
    				array('rating','in','range'=>array('1','2', '3', '4', '5'),'allowEmpty'=>false,'message'=> 'Must select rating between 1-5')
    				);
    	}
    
    	/**
    	 * Check users
    	 */
    	public function verifyUsers($attribute,$params)
    	{
    		if(!$this->hasErrors())
    		{
    			$trade = Trade::model()->findByPk($this->tradeId);
    			if (!Trade::belongsToCurrentUser($trade)) {
    				$this->addError('userTo','User invalid');
    			}
    		}
    	}
    	
    	/**
         * Creates a new friend request
         * @return boolean whether message was created successfully
         */
        public function sendReview()
        {
        	$transaction = Yii::app()->db->beginTransaction();
        	try
        	{
        		// send review
        		$review = new Review;
        		$review->Rating = $this->rating;
        		$review->TradeID = $this->tradeId;
        		$review->UserTo = $this->userTo;
        		$review->UserFrom = Yii::app()->user->ID;
        		$review->Message = $this->message;
        		
        		if (!$review->save()) {
        			throw new Exception("Failed to send review");
        		}
        		
        		// mark trade as having been reviewed
        		$trade = Trade::model()->findByPk($review->TradeID);
        		TradeStatus::setStatus($trade, TradeStatus_Reviewed);
        		if (!$trade->save()) {
        			throw new Exception("Failed to update trade");
        		}

        		// mark trade info as having been reviewed
        		$tradeInfo = Trade::getCurrentUserTradeInfo($trade);
        		TradeStatus::setStatus($tradeInfo, TradeStatus_Reviewed);
        		if (!$tradeInfo->save()) {
        			throw new Exception("Failed to update trade information");
        		}
        		
        		$transaction->commit();
        		return true;
        	}
        	catch (Exception $e)
        	{
        		$transaction->rollback();
        		ExceptionUtils::logException($e);
        		return false;
        	}
        }
    }
    
?>