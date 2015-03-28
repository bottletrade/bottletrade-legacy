<?php

class AccountController extends Controller
{
	public $layout='main';

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
				array('allow', // allow any user
						'actions'=>array('login', 'forgotPassword'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user only
						'actions'=>array('delete', 'logout', 'settings'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionDelete() {
		// get user
		$user = User::getCurrentUser();
		$user->IsActive = 0;
		if (!$user->save()) {
			throw new CHttpException(500);
		}
		
		// logout
		Yii::app()->user->logout();
		
		// create cookie so display doesn't appear after logout
		AgeVerificationDisplay::createCookie();
		
		echo true;
		Yii::app()->end();
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->pageDescription = "Create A Profile, Explore Other Users' ISO/FT and Establish A Beer Trade on the BottleTrade Network.";
		$loginForm=new LoginForm;
		$newUserForm=new NewUserForm;
	
		// if it is ajax validation request
		if(isset($_POST['ajax']))
		{
			if ($_POST['ajax']==='login-form') {
				echo CActiveForm::validate($loginForm);
				Yii::app()->end();
			}
			else if ($_POST['ajax']==='newuser-form') {
				echo CActiveForm::validate($newUserForm);
				Yii::app()->end();
			}
		}
	
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$loginForm->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($loginForm->validate() && $loginForm->login())
			{
				$this->redirect(UrlUtils::generateUrl(UrlUtils::ProfileUri));
			}
		}
	
		// collect user input data
		if(isset($_POST['NewUserForm']))
		{
			$newUserForm->attributes=$_POST['NewUserForm'];
			// validate user input and redirect to the previous page if valid
			if($newUserForm->validate() && $newUserForm->createUser())
			{
				$newUserLoginForm=new LoginForm;
				$newUserLoginForm->username = $newUserForm->username;
				$newUserLoginForm->password = $newUserForm->password;
				if ($newUserLoginForm->login()) {
					$this->redirect(UrlUtils::generateUrl(UrlUtils::ProfileUri));
				} else {
					Yii::app()->user->setFlash('error','Failed to login to account');
					$this->refresh();
				}
			}
		}
	
		// display the login form
		$this->render('login',array('loginForm'=>$loginForm, 'newUserForm'=>$newUserForm));
	}
    
    /**
	 * Displays the forgot password page
	 */
    public function actionForgotPassword($email = null, $token = null)
    {
    	if ($email == null && $token == null) {
    		// initial request for forgot password
			$form = new ForgotPasswordForm;
    		
			if(isset($_POST['ForgotPasswordForm']))
			{
	            $form->attributes=$_POST['ForgotPasswordForm'];
	            if($form->validate() && $form->processRequest())
	            {
					Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
					$this->refresh();
	            }
	        }
	            
	        // display the form
			$this->render('forgotPassword',array('forgotPasswordForm'=>$form, 'tokenExpired' => false, 'showChangePassword' => false));
    	} else {
			$form = new ForgotPasswordForm('updatePassword');
			
    		// request after link to forgot password received
    		if ($email == null || $token == null) {
    				throw new CHttpException(401, "Invalid information provided");
    		}
    		
    		// find user with email
    		$user = User::findByEmail($email);
    			
    		if ($user == null) {
    			// user not found
    			throw new CHttpException(401, "Invalid information provided");
    		}
    			
    		if ($user->ForgotPasswordToken != $token) {
    			// token doesn't match
    			throw new CHttpException(401, "Invalid information provided");
    		}
    			
    		$tokenExpired = $user->ForgotPasswordTokenExpiration < DateTimeUtils::getCurrentDateTime();
    		if ($tokenExpired) {
    			Yii::app()->user->setFlash('error','Forgot password token has expired, please request another password reset');
    		} else {
	    		if(isset($_POST['ForgotPasswordForm']))
	    		{
	    			$form->attributes=$_POST['ForgotPasswordForm'];
	    			if($form->validate() && $form->processRequest())
	    			{
	    				$loginForm = new LoginForm;
	    				$loginForm->username = $user->Username;
	    				$loginForm->password = $form->newPassword;
	    				
	    				// log user in with updated credentials
	    				if($loginForm->validate() && $loginForm->login())
	    				{
	    					Yii::app()->user->setFlash('success','Your password has been changed');
							$this->redirect(UrlUtils::generateUrl(UrlUtils::ProfileUri));
	    				}
	    			}
	    		}
    		}
    		
    		$form->email = $email;
    		
    		// display the form
    		$this->render('forgotPassword',array('forgotPasswordForm'=>$form, 'showChangePassword' => !$tokenExpired));
    	}
    }
    
    public function actionSettings() {
		$settings = new AccountSettingsForm;
        
        // collect user input data
		if(isset($_POST['AccountSettingsForm']))
		{
            $settings->attributes=$_POST['AccountSettingsForm'];
            if($settings->validate() && $settings->save())
            {
            	Yii::app()->user->setFlash('success','Your account settings have been updated');
            	$this->refresh();
            }
        }
        
        // configure the boolean values
        $emailManager = new EmailManager(User::getCurrentUser());
        $settings->globalEmailNotifications = !$emailManager->hasDisabledAllEmails() ? 1 : 0;
        $settings->emailFriendRequests = $emailManager->acceptsNewFriendRequestEmails() ? 1 : 0;
        $settings->emailInboxMessages = $emailManager->acceptsNewMailMessageEmails() ? 1 : 0;
        $settings->emailTradeOffers = $emailManager->acceptsIncomingOfferEmails() ? 1 : 0;
        $settings->emailAcceptedOffers = $emailManager->acceptsOfferAcceptedEmails() ? 1 : 0;
        $settings->emailShippingDates = $emailManager->acceptsShipDatesUpdatedEmails() ? 1 : 0;
        $settings->emailBottlesReceived = $emailManager->acceptsBottlesReceivedEmails() ? 1 : 0;
        $settings->emailBottlesShipped = $emailManager->acceptsBottlesShippedEmails() ? 1 : 0;
        $settings->emailClosedTrades = $emailManager->acceptsTradeClosedEmails() ? 1 : 0;
        $settings->emailTraderReviews = $emailManager->acceptsTraderReviewEmails() ? 1 : 0;
        $settings->emailTradeMessages = $emailManager->acceptsTradeMessageEmails() ? 1 : 0;
        $settings->emailDeclinedOffer = $emailManager->acceptsOfferDeclinedEmails() ? 1 : 0;
        
        $friends = User::model()->findAll(array('condition'=>'friend.User1=:uid',
				'join' => 'LEFT JOIN friend ON `t`.ID = friend.User2',
				'params'=>array(':uid'=>Yii::app()->user->ID),
				'order'=>'Username'));
        
    	// display the form
        $this->render('settings',array('settingsForm'=>$settings, 'friends' => $friends ));
    }
    
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		// create cookie so display doesn't appear after logout
		AgeVerificationDisplay::createCookie();
		
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	

    
}