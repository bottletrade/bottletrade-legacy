<?php
    
    /**
     * NewUserForm class.
     * NewUserForm is the data structure for keeping
     * new user form data. It is used by the 'login' action of 'SiteController'.
     */
    class ForgotPasswordForm extends CFormModel
    {
        public $email;
        public $newPassword;
        public $confirmPassword;
        private $_user;
        
        /**
         * Declares the validation rules.
         */
        public function rules()
        {
            return array(
            			array('newPassword, confirmPassword', 'required', 'on'=>'updatePassword'),
            			array('newPassword', 'length', 'max'=>20),
            			array('confirmPassword', 'compare', 'compareAttribute'=>'newPassword'),
                         array('email', 'required'),
                         // email has to be a valid email address
                         array('email', 'email'),
                         array('email', 'userExists'),
                         );
        }
        
        public function userExists($attribute,$params)
        {
            if(!$this->hasErrors())
            {
                $this->_user = User::model()->find('LOWER(Email)=?',array(strtolower($this->email)));
                if($this->_user == null)
                    $this->addError('email','Email provided is not associated with a user.');
            }
        }
        
        public function processRequest()
        {
            if ($this->_user === null)
            {
            	return false;
            }
            
        	if ($this->scenario != 'updatePassword') {
        		// add token info to user record
            	$expirationTimeInSeconds = 60 * 60 * 24 * 7; /* 7 days */
	        	$this->_user->ForgotPasswordToken = StringUtils::generateRandomString(30);
	        	$this->_user->ForgotPasswordTokenExpiration = DateTimeUtils::getAdjustedDateTime($expirationTimeInSeconds);
            	if (!$this->_user->save()) {
            		return false;
            	}
            	
            	// send email
            	$emailSender = new EmailSender();
            	$emailSender->sendForgotPasswordEmail($this->_user);
            	
            	return true;
        	} else {
        		$this->_user->Password = CPasswordHelper::hashPassword($this->newPassword);
	        	$this->_user->ForgotPasswordToken = null;
	        	$this->_user->ForgotPasswordTokenExpiration = null;
	        	return $this->_user->save();
        	}
        }
    }
