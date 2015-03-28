<?php

class SiteController extends Controller
{
	public $layout='main';
    
    public $defaultAction = 'home';
    
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
    					'actions'=>array('home', 'page', 'contactUs', 'viewStatic','error'),
    					'users'=>array('*'),
    			),
    			array('allow', // allow authenticated user only
    					'actions'=>array('deleteFriend', 'getFriendList'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php/site/page/FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionViewStatic($name) {
		switch ($name) {
			case 'manifesto':
				$this->pageDescription = 'The BottleTrade Manifesto Describes the Philosophy and Goals Behind Our Revolutionary Movement.';
				$this->pageKeywords = array('bottletrade', 'bottle trade');
				break;
			case 'store':
				$this->pageDescription = 'BottleTrade Craft Beer T Shirts, Beer Glasses and Beer Art Available On Our Online Square Market Store.';
				$this->pageKeywords = array('beer t shirts', 'beer glasses', 'beer apparel', 'beer art');
				break;
			case 'blog':
				$this->pageDescription = 'Read About the Latest News, Events and Site Features on the BottleTrade Beer Blog.';
				$this->pageKeywords = array('beer blog');
				break;
			case 'educate':
				$this->pageDescription = 'Learn About Beer Trading, Industry News and the Craft Beer Movement on the BottleTrade Educate Page.';
				$this->pageKeywords = array('beer trading', 'trading beer');
				break;
		}		
		$this->render('pages/'.$name);		
	}

    public function actionHome()
	{
		$loginForm=new LoginForm;
	
		// if it is ajax validation request
		if(isset($_POST['ajax']))
		{
			if ($_POST['ajax']==='login-form') {
				echo CActiveForm::validate($loginForm);
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

		// display the home page
		$this->pageKeywords = array('beer trade', 'bottle trade', 'trade beer', 'bottletrade');
		$this->pageDescription = 'BottleTrade is a Reliable Social Network where Users Connect with Other Craft Beer Enthusiasts to Establish a Beer Trade.';
		$this->render('home',array('loginForm'=>$loginForm));
	}
	
	/**
	 * Displays the contact us page
	 */
	public function actionContactUs()
	{
		$contactUsForm = new ContactUsForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']))
		{
			if ($_POST['ajax']==='contact-us-form') {
				echo CActiveForm::validate($contactUsForm);
				Yii::app()->end();
			}
		}
		
		// collect user input data
		if(isset($_POST['ContactUsForm']))
		{
			$contactUsForm->attributes=$_POST['ContactUsForm'];
			// validate user input and redirect to the previous page if valid
			if($contactUsForm->validate() && $contactUsForm->sendMessage())
			{
				Yii::app()->user->setFlash('success','Thank you for your message, we will respond as soon as possible');
				$this->refresh();
			}
		}
		
		$this->render('contact', array( 'contactUsForm' => $contactUsForm ));
	}
	
	public function actionDeleteFriend($id) {
		if ($id == null) {
			throw new CHttpException(400, "Invalid input");
		}
		$user = User::getUser($id);
		if ($user == null) {
			throw new CHttpException(400, "User doesn't exist");
		}
		User::deleteFriend(User::getUser($id));
		Yii::app()->user->setFlash('success','You have successfully removed '.$user->Username.' from your friends list');
		echo true;
		Yii::app()->end();
	}
	
	public function actionGetFriendList() {
		$friends = User::model()->findAll(array('condition'=>'friend.User1=:uid',
				'join' => 'LEFT JOIN friend ON `t`.ID = friend.User2',
				'params'=>array(':uid'=>Yii::app()->user->ID),
				'order'=>'Username'));
		
		if (count($friends) <= 0) {
			echo "You currently have no friends.";
		} else {
			foreach ($friends as $friend) {
				$this->widget('application.components.widgets.displays.FriendListPopupUserDisplay', array('user' => $friend));
			}
		}
	}
}