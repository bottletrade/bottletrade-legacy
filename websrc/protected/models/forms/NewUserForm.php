<?php
    
    /**
     * NewUserForm class.
     * NewUserForm is the data structure for keeping
     * new user form data. It is used by the 'login' action of 'AccountController'.
     */
    class NewUserForm extends CFormModel
    {
        public $firstname;
        public $lastname;
        public $email;
        public $username;
        public $password;
        public $confirm_password;
        public $date_of_birth;
        public $acceptRules;
        
        public function init() {
        	$this->acceptRules = false;
        	return parent::init();
        }
        
        public function attributeLabels()
        {
        	$termsPopup = '#'.PopupConstants::TermsAndConditionsPopupLinkID;
        	return array('firstname' => "First name",
        				 'lastname' => "Last name",
        				 'acceptRules' => 'I have read and accept the <a class="terms" href="javascript:return false;" onclick="$(\''.$termsPopup.'\').click();">terms and conditions</a>');
        }
        
        /**
         * Declares the validation rules.
         */
        public function rules()
        {
            return array(
                         array('firstname, lastname, email, username, password, confirm_password, date_of_birth', 'required'),
            			 array('username','length','max'=>20),
            			 array('username', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/', 'message'=>'Username must only contain alphanumeric characters'),
            			 array('password','length','max'=>40),
            			 array('email, firstname, lastname','length','max'=>64),
                         array('confirm_password', 'compare', 'compareAttribute'=>'password'),
                         array('email', 'email'),
                         array('date_of_birth', 'date', 'format'=>array('yyyy-mm-dd')),
            			 array('username','checkDuplicateUsername'),
            			 array('email','checkDuplicateEmail'),
            			 array('date_of_birth','checkValidBirthday'),
            			 array('acceptRules', 'compare', 'compareValue' => 1, 'message' => 'You must read and agree to the house rules before creating an account')
                         );
        }
        
        public function checkDuplicateUsername($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		$user = User::findByUsername($this->username);
        		if ($user != null) {
        			$this->addError('username','Username taken, please choose another');
        		}
        	}
        } 
        
        public function checkDuplicateEmail($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		$user = User::findByEmail($this->email);
        		if ($user != null) {
        			$this->addError('email','Email already associated with an account');
        		}
        	}
        }
        
        public function checkValidBirthday($attribute,$params)
        {
        	if(!$this->hasErrors())
        	{
        		$timeDiff = strtotime(date('Y-m-d',strtotime("-21 year"))) - strtotime(date('Y-m-d',strtotime($this->date_of_birth)));
        		
        		// $timeDiff > 0 means today is after the users 21st birthday
        		// $timeDiff == 0 means today is the users 21st birthday
        		if ($timeDiff < 0) {
        			$this->addError('date_of_birth','You must be 21 or older to create an account');
        		}
        	}
        }
        
        /**
         * Creates a new user
         * @return boolean whether user was created successfully
         */
        public function createUser()
        {
            $user = new User;
            $user->Username = $this->username;
            $user->Password = CPasswordHelper::hashPassword($this->password);
            $user->Email = $this->email;
            $user->FirstName = $this->firstname;
            $user->LastName = $this->lastname;
            $user->Birthday = date('Y-m-d',strtotime($this->date_of_birth));
            $user->EmailPreferences = EmailPreference::All;
            $user->CreatedTime = DateTimeUtils::getCurrentDateTime();
            if ($user->save()) {
            	// send email
            	$emailSender = new EmailSender();
            	$emailSender->sendNewUserEmail($user);
            	
            	return true;
            } else {
            	return false;
            }
        }
    }
