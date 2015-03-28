<?php 

class ProfileController extends Controller
{
	public $layout='main';

	public $defaultAction = 'home';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl' // perform access control
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
				array('allow', // allow authenticated user only
						'actions'=>array('home',
										 'viewProfile'),
						'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			)
    	);
    }
    
    public function actionHome()
    {
    	return $this->actionViewProfile(Yii::app()->user->Username);
    }
    
    public function actionViewProfile($un) {
    	$friendRequestForm = new FriendRequestForm();
    
    	/// if it is ajax validation request
    	if(Yii::app()->getRequest()->getIsAjaxRequest()) {
    		if ($_POST['ajax']==='friend-request-form') {
    			echo CActiveForm::validate($friendRequestForm);
    			Yii::app()->end();
    		}
    	}
    
    	// collect user input data
    	if(isset($_POST['FriendRequestForm'])) {
    		$friendRequestForm->attributes=$_POST['FriendRequestForm'];
    		// validate user input and redirect to the previous page if valid
    		if($friendRequestForm->validate()) {
    			if ($friendRequestForm->addFriend()) {
    				Yii::app()->user->setFlash('success','Friend request sent');
    			} else {
    				Yii::app()->user->setFlash('error','Failed to send friend request.  If this error continues, please contact the Administrator.');
    			}
    			$this->refresh();
    		}
    	}
    
    	$user = User::findByUsername($un);
    
    	if ($user == null) {
    		throw new CHttpException(404,'The specified user cannot be found '.$un);
    	}
    
    	$reviews = Review::model()->findAll(array( 'condition'=>'UserTo=:un', 'params'=>array(':un'=>$user->ID)));
    
    	// check if profile belongs to current logged in user
    	if (User::isCurrentUser($user)) {
    		$friendRequest = null;
    		$areUsersFriends = false;
    	} else {
    		$areUsersFriends = Friend::areFriends(Yii::app()->user->ID, $user->ID);
    		$friendRequest = FriendRequest::findByUsers(Yii::app()->user->ID, $user->ID);
    		if ($friendRequest == null) {
    			$friendRequestForm->userFromId = Yii::app()->user->ID;
    			$friendRequestForm->userToId = $user->ID;
    		}
    	}
    
    	$this->render('view',
    			array(	'user' => $user, 
    					'reviews'=>$reviews,
    					'friendRequest'=>$friendRequest,
    					'friendRequestForm'=>$friendRequestForm,
    					'areUsersFriends'=>$areUsersFriends
    			)
    	);
    }
}

?>