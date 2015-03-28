<?php

    class FriendRequestForm extends CFormModel
    {
    	public $userToId;
    	public $userFromId;
    
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				// fields required
    				array('userToId, userFromId', 'required'),
    				// users must be different
    				array('userToId', 'compare', 'compareAttribute'=>'userFromId', 'operator'=>'!='),
					// request needs to be unique
					array('userToId', 'uniqueRequest')
    				);
    	}
    	
    	/**
    	 * Ensure request is unique
    	 * This is the 'uniqueRequest' validator as declared in rules().
    	 */
    	public function uniqueRequest($attribute,$params)
    	{
    		if(!$this->hasErrors())
    		{
    			if(FriendRequest::findByUsers($this->userToId, $this->userFromId) != null) {
    				$this->addError('','Pending friend request already exists between these users');
    			}

    			if(Friend::areFriends($this->userToId, $this->userFromId)) {
    				$this->addError('','Users are already friends');
    			}
    		}
    	}
    
    	/**
         * Creates a new friend request
         * @return boolean whether message was created successfully
         */
        public function addFriend()
        {
        	$friendRequest = new FriendRequest();
        	$friendRequest->UserTo = $this->userToId;
        	$friendRequest->UserFrom = $this->userFromId;
        	$friendRequest->SentTime = DateTimeUtils::getCurrentDateTime();
        	if ($friendRequest->save()) {
        		// send email
        		$emailSender = new EmailSender();
        		$emailSender->sendNewFriendRequestEmail($friendRequest);
        		
        		return true;
        	} else {
        		return false;
        	}
        }
    }
    
?>