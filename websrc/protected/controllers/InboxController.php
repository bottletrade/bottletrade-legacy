<?php 
class InboxController extends Controller
{
	public $layout='inbox';
    
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
    			array('allow', // allow authenticated user only
    					'actions'=>array('displayIncomingMessages',
    									 'displaySentMessages',
    									 'displayUnreadMessages',
    									 'displayReadMessages',
    									 'displayMessage',
    									 'displayIncomingFriendRequests',
    									 'displaySentFriendRequests',
    									 'deleteMessage'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
    public function actionDisplayMessage($id) {
    	$transaction = Message::model()->dbConnection->beginTransaction();
    	try
    	{
	    	$requestedMessage = Message::model()->findByPk($id);
	    	if ($requestedMessage == null) {
	    		throw new CHttpException(404, 'Cannot find the specified message');
	    	} elseif (!Message::canViewMessage($requestedMessage)) {
	    		throw new CHttpException(404, 'You are not authorized to view this message');
	    	}
	    	
	    	$un1 = Yii::app()->user->ID;
	    	$un2 = Message::getOtherUser($requestedMessage)->ID;
	    	
	    	$messages = Message::model()->findAll(array('order'=>'SentTime ASC', 
	    												'condition'=>'Subject = :sub AND ((UserTo=:un1 AND UserFrom=:un2) OR (UserTo=:un2 AND UserFrom=:un1))', 
	    												'params'=>array(':sub'=>$requestedMessage->Subject, ':un1'=>$un1, ':un2'=>$un2)));
	    	
	    	// mark all messages in thread sent to current user as read
	    	foreach ($messages as $message) {
	    		if ($message->IsRead != 1 && $message->UserTo == Yii::app()->user->ID) {
	    			$message->IsRead = 1;
	    			if (!$message->save()) {
	    				throw ExceptionUtil::createVarException($message);
	    			}
	    		}
	    	}
	    	
			$transaction->commit();
		}
		catch(Exception $e)
        {
        	$transaction->rollback();
        	ExceptionUtils::logException($e);
        	throw new CHttpException(500);
        }

    	$this->render('thread', array(	'user' => User::getCurrentUser(), 'messages' => $messages ));
    }

    public function actionDisplayIncomingMessages() {
    	$user = User::getCurrentUser();
    	$messages = Message::model()->findAll(array('order'=>'SentTime DESC', 'condition'=>'UserTo=:un AND IsLeaf=1 AND DeletedByReceiver=0', 'params'=>array(':un'=>Yii::app()->user->ID)));
    	
    	$this->render('messages', array( 'user'=>$user,	'messages' => $messages ));
    }
    
    public function actionDisplaySentMessages() {
    	$user = User::getCurrentUser();
    	$messages = Message::model()->findAll(array('select'=>'*, MAX(SentTime) as SentTime','group'=>'Subject','order'=>'SentTime DESC', 'condition'=>'UserFrom=:un AND DeletedBySender=0', 'params'=>array(':un'=>Yii::app()->user->ID)));

    	$this->render('messages', array( 'user'=>$user,	'messages' => $messages ));
    }
    
    public function actionDisplayUnreadMessages() {
    	$user = User::getCurrentUser();
    	$messages = Message::model()->findAll(array('order'=>'SentTime DESC', 'condition'=>'UserTo=:un AND IsRead=0 AND IsLeaf=1 AND DeletedByReceiver=0', 'params'=>array(':un'=>Yii::app()->user->ID)));

    	$this->render('messages', array( 'user'=>$user,	'messages' => $messages ));
    }
    
    public function actionDisplayReadMessages() {
    	$user = User::getCurrentUser();
    	$messages = Message::model()->findAll(array('order'=>'SentTime DESC', 'condition'=>'UserTo=:un AND IsRead=1 AND IsLeaf=1 AND DeletedByReceiver=0', 'params'=>array(':un'=>Yii::app()->user->ID)));

    	$this->render('messages', array( 'user'=>$user,	'messages' => $messages ));
    }
    
    public function actionDisplayIncomingFriendRequests() {
    	$friendResponseForm = new FriendRequestResponseForm();
    	
    	/// if it is ajax validation request
    	if(Yii::app()->getRequest()->getIsAjaxRequest()) {
    		if ($_POST['ajax']==='friend-request-response-form') {
    			echo CActiveForm::validate($friendResponseForm);
    			Yii::app()->end();
    		}
    	}
    	
    	// collect user input data
    	if(isset($_POST['FriendRequestResponseForm'])) {
    		$friendResponseForm->attributes=$_POST['FriendRequestResponseForm'];
    		// validate user input and redirect to the previous page if valid
    		if($friendResponseForm->validate() && $friendResponseForm->replyToRequest()) {
    			switch ($friendResponseForm->response)
    			{
    				case FriendRequestResponseForm::ACCEPT:
    					Yii::app()->user->setFlash('success','Friend request accepted');
    					break;
    				case FriendRequestResponseForm::DENY:
    					Yii::app()->user->setFlash('success','Friend request denied');
    					break;
    				case FriendRequestResponseForm::REMOVE:
    					Yii::app()->user->setFlash('success','Friend request has been removed');
    					break;
    			}
    			$this->refresh();
    		}
    	}
    	
    	$friendRequests = FriendRequest::model()->findAll(array('condition'=>'UserTo=:un', 'params'=>array(':un'=>Yii::app()->user->ID)));
    	
    	$this->render('friendrequests', array(	'friendRequests' => $friendRequests,
        										'friendRequestResponseForm'=>$friendResponseForm ));
    }
    
    public function actionDisplaySentFriendRequests() {
    	$friendResponseForm = new FriendRequestResponseForm();
    	
    	/// if it is ajax validation request
    	if(Yii::app()->getRequest()->getIsAjaxRequest()) {
    		if ($_POST['ajax']==='friend-request-response-form') {
    			echo CActiveForm::validate($friendResponseForm);
    			Yii::app()->end();
    		}
    	}
    	
    	// collect user input data
    	if(isset($_POST['FriendRequestResponseForm'])) {
    		$friendResponseForm->attributes=$_POST['FriendRequestResponseForm'];
    		// validate user input and redirect to the previous page if valid
    		if($friendResponseForm->validate() && $friendResponseForm->replyToRequest()) {
    			switch ($friendResponseForm->response)
    			{
    				case FriendRequestResponseForm::ACCEPT:
    					Yii::app()->user->setFlash('success','Friend request accepted');
    					break;
    				case FriendRequestResponseForm::DENY:
    					Yii::app()->user->setFlash('success','Friend request denied');
    					break;
    				case FriendRequestResponseForm::REMOVE:
    					Yii::app()->user->setFlash('success','Friend request has been removed');
    					break;
    			}
    			$this->refresh();
    		}
    	}

    	$user = User::getCurrentUser();
    	$friendRequests = FriendRequest::model()->findAll(array('condition'=>'UserFrom=:un', 'params'=>array(':un'=>Yii::app()->user->ID)));
    	
    	$this->render('friendrequests', array(	'user' => $user, 'friendRequests'=> $friendRequests,
        				'friendRequestResponseForm'=>$friendResponseForm ));
    }
    
    public function actionDeleteMessage($id) {
    	$transaction = Message::model()->dbConnection->beginTransaction();
    	try
    	{
	    	$requestedMessage = Message::model()->findByPk($id);
	    	if ($requestedMessage == null) {
	    		throw new CHttpException(404, 'Cannot find the specified message');
	    	} elseif (!Message::isOwnedByCurrentUser($requestedMessage)) {
	    		throw new CHttpException(404, 'You are not authorized to delete this message');
	    	}
	    	
	    	$messages = Message::model()->findAll(array('condition'=>'Subject = :sub', 'params'=>array(':sub'=>$requestedMessage->Subject)));
	    	
	    	// "delete" all messages in thread
	    	foreach ($messages as $message) {
		    	if (Message::isCurrentUserSender($message)) {
		    		$message->DeletedBySender = 1;
		    	} else if (Message::isCurrentUserReceiver($message)) {
		    		$message->DeletedByReceiver = 1;
		    	}
		    	
		    	// if both users have deleted the message remove from system, else just save
		    	if ($message->DeletedBySender && $message->DeletedByReceiver) {
		    		if (!$message->delete()) {
		    			throw ExceptionUtils::createVarException($message);
		    		}
		    	}
		    	else if (!$message->save()) {
		    		throw ExceptionUtils::createVarException($message);
		    	}
	    	}
	    	
	    	$transaction->commit();
	    	Yii::app()->user->setFlash('success','Successfully delete thread');
	    	
	    	// get requester url without the message id
	    	$strId = (string)$id;
	    	$newUrl = substr(Yii::app()->request->urlReferrer, 0, strlen(Yii::app()->request->urlReferrer) - strlen($strId) - 1 /* length of forward slash */);
	    	$this->redirect($newUrl);
    	}
    	catch(Exception $e)
    	{
    		$transaction->rollback();
    		ExceptionUtils::logException($e);
	    	Yii::app()->user->setFlash('error','Failed to delete thread');
    	}
    	
    	$this->refresh();
    }
}