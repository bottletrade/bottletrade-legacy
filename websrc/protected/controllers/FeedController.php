<?php

class FeedController extends Controller
{
	public $layout='feed';
    
    public $defaultAction = 'global';
    
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
    					'actions'=>array('friend', 'global', 'globalData', 'friendData'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
    private function getFriendFeedData($offset, $limit) {
    	// find all trades made by at least one friend
    	// do not include trades made with current user
    	/*$feeds = Feed::model()->findAll(array('condition'=>'friend.User1 = :uid && ((EventType = :eTypeBottle) || (EventType = :eTypeTrade && EventReceiverID != :uid))',
    			'join' => 'LEFT JOIN friend ON EventOwnerID = friend.User2',
    			'params'=>array(':uid'=>Yii::app()->user->ID, ':eTypeBottle'=>FeedEventType::BOTTLE, ':eTypeTrade'=>FeedEventType::TRADE),
    			'order'=>'EventTime DESC',
    			'limit'=>$limit,
    			'offset'=>$offset));
    	
    	$feeds = Feed::model()->findAll(array('condition'=>'friend.User1 = :uid && ((EventType = :eTypeTrade && EventOwnerID != :uid))',
    			'join' => 'LEFT JOIN friend ON EventReceiverID = friend.User2',
    			'params'=>array(':uid'=>Yii::app()->user->ID, ':eTypeBottle'=>FeedEventType::BOTTLE, ':eTypeTrade'=>FeedEventType::TRADE),
    			'order'=>'EventTime DESC',
    			'limit'=>$limit,
    			'offset'=>$offset));*/
    	
    	$feeds1 = Yii::app()->db->createCommand()
			    	->select('*')
			    	->from('feed')
			    	->where('friend.User1 = :uid && ((EventType = :eTypeBottle) || (EventType = :eTypeTrade && EventReceiverID != :uid))',
			    			array(':uid'=>Yii::app()->user->ID, ':eTypeBottle'=>FeedEventType::BOTTLE, ':eTypeTrade'=>FeedEventType::TRADE));
    	$feeds1->setJoin('LEFT JOIN friend ON EventOwnerID = friend.User2');

    	$feeds2 = Yii::app()->db->createCommand()
			    	->select('*')
			    	->from('feed')
			    	->where('friend.User1 = :uid && (EventType = :eTypeTrade && EventOwnerID != :uid)',
			    			array(':uid'=>Yii::app()->user->ID, ':eTypeBottle'=>FeedEventType::BOTTLE, ':eTypeTrade'=>FeedEventType::TRADE))
			    	->union($feeds1->text)
			    	->order('EventTime DESC')
			    	->limit($limit)
			    	->offset($offset);
    	$feeds2->setJoin('LEFT JOIN friend ON EventReceiverID = friend.User2');
    	
    	$feeds = array();
    	foreach ($feeds2->queryAll() as $result) {
    		 $feed = new BaseFeed();
    		 $feed->_attributes = $result;
    		 $feeds[] = $feed;
    	}
    	return $feeds;
    }
    
    private function getGlobalFeedData($offset, $limit) {
    	// find all bottles
    	$bottles = Bottle::model()->findAll(array('condition'=>'UserID != :uid AND IsActive=1 AND IsPrivate=0',
    			'params'=>array(':uid'=>Yii::app()->user->ID),
    			'order'=>'CreatedTime DESC',
    			'limit'=>$limit,
    			'offset'=>$offset));
    	 
    	return $bottles;
    }
	
	public function actionFriend()
	{
		$this->render('friend');
	}
	
	public function actionGlobal()
	{
		$this->render('global');
	}

	public function actionGlobalData($offset, $limit) {
		$bottles = $this->getGlobalFeedData($offset, $limit);
		
		$data = array();
		foreach($bottles as $bottle) {
			$data[] = KnockoutBottle::MakeFeedDataWithBottle($bottle);
		}
		
		echo CJavaScript::jsonEncode($data);
		Yii::app()->end();
	}
	
	public function actionFriendData($offset, $limit) {
		$feed = $this->getFriendFeedData($offset, $limit);
	
		$data = array();
		foreach($feed as $event) {
			if ($event->EventType == FeedEventType::BOTTLE) {
				$data[] = KnockoutBottle::MakeFeedDataWithEvent($event);
			} else if ($event->EventType == FeedEventType::TRADE) {
				$data[] = KnockoutTrade::MakeFeedDataWithEvent($event);
			}
		}
	
		echo CJavaScript::jsonEncode($data);
		Yii::app()->end();
	}
}