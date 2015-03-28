<?php

    class FriendRequestResponseForm extends CFormModel
    {
    	const ACCEPT = 'accept';
    	const DENY = 'deny';
    	const REMOVE = 'remove';
    	
    	public $id;
    	public $response;
    
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				// fields required
    				array('id, response', 'required'),
    				// response must be one of the specified values
    				array('response','in','range'=>array(self::ACCEPT,self::DENY,self::REMOVE),'allowEmpty'=>false)
    				);
    	}
    
    	/**
         * Creates a new friend request
         * @return boolean whether message was created successfully
         */
        public function replyToRequest()
        {
        	$transaction = Yii::app()->db->beginTransaction();
        	try
        	{
        		$friendRequest = FriendRequest::model()->findByPk($this->id);
        		switch ($this->response) {
        			case self::ACCEPT:
        				$friend1 = new Friend();
        				$friend1->User1 = $friendRequest->UserTo;
        				$friend1->User2 = $friendRequest->UserFrom;
        				$friend1->CreatedTime = DateTimeUtils::getCurrentDateTime();
        				if (!$friend1->save()) {
        					throw new Exception("Failed to add friend");
        				}
        				
        				$friend2 = new Friend();
        				$friend2->User1 = $friend1->User2;
        				$friend2->User2 = $friend1->User1;
        				$friend2->CreatedTime = $friend1->CreatedTime;
        				if (!$friend2->save()) {
        					throw new Exception("Failed to add friend");
        				}
        				// fall through to delete request
        			case self::DENY:
        				// fall through to delete request
        			case self::REMOVE:
        				if (!$friendRequest->delete()) {
        					throw new Exception("Failed to remove friend request");
        				}
        				break;
        		}
        		
        		$transaction->commit();
        		return true;
        	}
        	catch (Exception $e)
        	{
        		$transaction->rollback();
        		throw $e;
        	}
        }
    }
    
?>