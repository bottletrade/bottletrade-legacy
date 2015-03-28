<?php 
class ApiController extends Controller
{
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
    					'actions'=>array('getUsers', 'getBreweries','getBeers',
    									'getBeerStyles', 'getBottles','getHashTagEvents',
    									'getIsoEntries', 'removeIso', 'addIsoBeer',
    									'findTrader'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
    public function actionGetUsers($query) {
    	if($query == null) {
    		throw new CHttpException(404, 'No query provided');
    	} else if (strlen($query) < 3) {
    		return;
    	}
    	
    	// construct query to filter current user from list
    	$dbQuery = new CDbCriteria;
    	$dbQuery->addCondition('ID != :uid');
    	$dbQuery->params = array(':uid'=>Yii::app()->user->ID);

    	// construct query to match users
    	$dbQueryUser = new CDbCriteria;
    	$dbQueryUser->addSearchCondition('Username', $query, true, "OR");
    	$dbQueryUser->addSearchCondition('FirstName', $query, true, "OR");
    	$dbQueryUser->addSearchCondition('LastName', $query, true, "OR");
    	$dbQueryUser->addCondition('IsPrivate = 0');
    	$dbQueryUser->order = "Username";
    	$dbQueryUser->select = "ID, Username, FirstName, LastName";
    	
    	// combine queries
    	$dbQuery->mergeWith($dbQueryUser);
    	
    	// execute queries
    	$users = User::model()->findAll($dbQuery);
    	
    	$ret = array();
    	foreach($users as $user) {
    		$info = array();
    		$info["ID"] = $user->ID;
    		$info["Name"] = User::getUserNameAndFormalName($user);
    		$ret[] = $info;
    	}
    	
    	echo CJavaScript::jsonEncode($ret);
    	Yii::app()->end();
    }
    
    public function actionGetBreweries($query) {
    	if($query == null) {
    		throw new CHttpException(404, 'No query provided');
    	} else if (strlen($query) < 3) {
    		return;
    	}
    	
    	$breweries = Brewery::model()->findAll(array(
    									'select'=>'ID, Name', 
    									'condition'=>'Name LIKE :q', 
    									'params'=>array(':q'=>'%'.$query.'%'), 
    									'order' => 'Name'));
    	$ret = array();
    	foreach($breweries as $brewery) {
    		$info = array();
    		$info["ID"] = $brewery->ID;
    		$info["Name"] = $brewery->Name;
    		$ret[] = $info;
    	}
    	
    	echo CJavaScript::jsonEncode($ret);
    	Yii::app()->end();
    }

    public function actionGetBeers($breweryId, $query = null) {
    	if(empty($query) == null) {
    		$beers = Beer::model()->findAll(array(
    									'select'=>'ID, Name', 
    									'condition'=>'BreweryID = :bid', 
    									'params'=>array(':bid'=>$breweryId), 
    									'order' => 'Name'));
    	} else {
	    	$beers = Beer::model()->findAll(array(
	    									'select'=>'ID, Name', 
	    									'condition'=>'BreweryID = :bid AND Name LIKE :q', 
	    									'params'=>array(':bid'=>$breweryId, ':q'=>'%'.$query.'%'), 
	    									'order' => 'Name'));
    	}
    	
    	$ret = array();
    	foreach($beers as $beer) {
    		$info = array();
    		$info["ID"] = $beer->ID;
    		$info["Name"] = $beer->Name;
    		$ret[] = $info;
    	}
    	
    	echo CJavaScript::jsonEncode($ret);
    	Yii::app()->end();
    }
    
    public function actionGetBeerStyles() {
    	$beerStyles = Beerstyle::model()->findAll(array(
    			'select'=>'ID, Name',
    			'order' => 'Name'));
    	$ret = array();
    	foreach($beerStyles as $bs) {
    		$info = array();
    		$info["ID"] = $bs->ID;
    		$info["Name"] = $bs->Name;
    		$ret[] = $info;
    	}
    	
    	echo CJavaScript::jsonEncode($ret);
    	Yii::app()->end();
    }

    public function actionGetBottles($un, $offset, $limit) {
    	$user = User::findByUsername($un);
    	if ($user == null) {
    		throw new CHttpException(404,'The specified user cannot be found '.$un);
    	}
    	
    	// check if profile belongs to current logged in user
    	if (User::isCurrentUser($user)) {
    		$bottles = Bottle::model()->findAll(array(
    						'order'=>'LastUpdateTime DESC', 
    						'condition'=>'UserID=:uid AND IsActive=1', 
    						'params'=>array(':uid'=>$user->ID),
    						'limit'=>$limit,
			    			'offset'=>$offset));
    	} else {
    		$bottles = Bottle::model()->findAll(array(
    						'order'=>'LastUpdateTime DESC', 
    						'condition'=>'UserID=:uid AND IsPrivate=0 AND IsActive=1', 
    						'params'=>array(':uid'=>$user->ID),
    						'limit'=>$limit,
			    			'offset'=>$offset));
    	}
    	
    	$data = array();
    	foreach($bottles as $bottle) {
    		$data[] = KnockoutBottle::MakeFeedDataWithBottle($bottle);
    	}

    	echo CJavaScript::jsonEncode($data);
    	Yii::app()->end();
    }
    
    public function actionGetHashTagEvents($tag, $offset, $limit) {
    	$hashtags = HashTag::model()->findAll(array(
    					'condition'=>'Tag=:id',
    					'params'=>array(':id'=>$tag),
    					'order'=>'SentTime DESC', 
    					'offset'=>$offset,
    					'limit'=>$limit
    				));

    	$data = array();
    	if (!empty($hashtags)) {
    		foreach ($hashtags as $hashtag) {
    			$data[] = KnockoutBottle::MakeFeedDataWithBottle($hashtag->bottle);
    		}
    	}

    	echo CJavaScript::jsonEncode($data);
    	Yii::app()->end();
    }

    public function actionGetIsoEntries($un, $offset, $limit) {
    	$user = User::findByUsername($un);
    	if ($user == null) {
    		throw new CHttpException(404,'The specified user cannot be found '.$un);
    	}
    	
    	$isos = Iso::model()->findAll(array(
    						'order'=>'CreatedTime DESC',
    						'condition'=>'UserID=:uid',
    						'params'=>array(':uid'=>$user->ID),
    						'limit'=>$limit,
			    			'offset'=>$offset
    	));

    	$data = array();
    	if (!empty($isos)) {
    		foreach ($isos as $iso) {
    			$data[] = KnockoutIso::MakeDataWithIso($iso);
    		}
    	}

    	echo CJavaScript::jsonEncode($data);
    	Yii::app()->end();
    }
    
    public function actionRemoveIso($id) {
    	$iso = Iso::model()->findByPk($id);
    	if (empty($iso)) {
    		throw new CHttpException(404,'The specified iso cannot be found');
    	} else if (!Iso::isOwnedByCurrentUser($iso)) {
    		throw new CHttpException(401);
    	}
    	
    	$removedIso = KnockoutIso::MakeDataWithIso($iso);
    	if (!$iso->delete()) {
    		throw new CHttpException(500);
    	}
    	
    	echo CJavaScript::jsonEncode($removedIso);
    	Yii::app()->end();
    }
    
    public function actionAddIsoBeer($id) {
    	$beer = Beer::model()->findByPk($id);
    	if (empty($beer)) {
    		throw new CHttpException(404,'The specified beer cannot be found');
    	}
    	
    	// check if user already has beer in iso
    	$iso = Iso::model()->findAll(array(
    						'condition'=>'UserID=:uid AND BeerID=:bid',
    						'params'=>array(':uid'=>Yii::app()->user->ID, ':bid'=>$beer->ID)
    	));
    	
    	if (empty($iso)) {
    		$iso = new Iso();
    		$iso->UserID = Yii::app()->user->ID;
    		$iso->BeerID = $beer->ID;
    		$iso->CreatedTime = DateTimeUtils::getCurrentDateTime();
    		 
    		if (!$iso->save()) {
    			//throw new CHttpException(500);
    			throw ExceptionUtils::createVarException($iso);
    		}
    	} else {
    		$iso = $iso[0];
    	}
    	
    	echo CJavaScript::jsonEncode(KnockoutIso::MakeDataWithIso($iso));
    	Yii::app()->end();
    }
    
    public function actionFindTrader($type, $offset, $limit, $un = null) {
    	if (empty($un)) {
	    	$users = null;
	    	switch ($type) {
	    		case 'iso':
	    			$usersIso = Yii::app()->db->createCommand()
					    			->select('bottle.UserID as userId, count(bottle.UserID) as count')
					    			->from('bottle')
					    			->where('bottle.UserID!=:uid AND iso.UserID=:uid AND bottle.IsActive=1 AND bottle.IsTradeable=1',
					    					array(':uid'=>Yii::app()->user->ID))
					    			->group('bottle.UserID')
					    			->order('count(bottle.UserID) DESC')
				    				->limit($limit)
				    				->offset($offset);
	    			$usersIso->setJoin('JOIN iso ON bottle.BeerID = iso.BeerID');

	    			$users = $usersIso->queryAll();
	    			break;
	    		case 'ft':
	    			$usersFt = Yii::app()->db->createCommand()
					    			->select('iso.UserID as userId, count(iso.UserID) as count')
					    			->from('bottle')
					    			->where('bottle.UserID=:uid AND iso.UserID!=:uid AND bottle.IsActive=1 AND bottle.IsTradeable=1',
					    					array(':uid'=>Yii::app()->user->ID))
				    				->group('iso.UserID')
				    				->order('count(iso.UserID) DESC')
							    	->limit($limit)
							    	->offset($offset);
	    			$usersFt->setJoin('JOIN iso ON bottle.BeerID = iso.BeerID');
	    			
	    			$users = $usersFt->queryAll();
	    			break;
	    		case 'both':
	    			$cid = Yii::app()->user->ID;
	    			$usersIsoQuery = "SELECT bottle.UserID as userId, 1 as countIso, 0 as countFt
	    							FROM bottle
	    							JOIN iso ON bottle.BeerID = iso.BeerID
	    							WHERE bottle.UserID!=$cid AND iso.UserID=$cid AND bottle.IsActive=1 AND bottle.IsTradeable=1";
	    			
	    			$usersFtQuery = "SELECT iso.UserID as userId, 0 as countIso, 1 as countFt
					    			FROM bottle
					    			JOIN iso ON bottle.BeerID = iso.BeerID
					    			WHERE bottle.UserID=$cid AND iso.UserID!=$cid AND bottle.IsActive=1 AND bottle.IsTradeable=1
					    			UNION ALL
					    			$usersIsoQuery";
	    			
	    			$usersBoth = Yii::app()->db->createCommand()
					    			->select('userId, count(userId) as count')
					    			->from('('.$usersFtQuery.') as users')
							    	->where('', array(':uid'=>Yii::app()->user->ID))
					    			->group('userId')
					    			->having('count(userId) > sum(countIso) && count(userId) > sum(countFt)')
					    			->order('count(userId) DESC')
					    			->limit($limit)
					    			->offset($offset);
	    			
	    			$users = $usersBoth->queryAll();
	    			break;
	    		default:
	    			throw new CHttpException(400,'Unable to process request');
	    	}
	    	
	    	$data = array();
	    	if (!empty($users)) {
	    		foreach ($users as $userInfo) {
    				$ko = KnockoutUser::MakeFindTraderDataWithUser(User::model()->findByPk($userInfo['userId']));
    				$ko["bottleCount"] = $userInfo['count'];
    				$data[] = $ko;
	    		}
	    	}
    	} else {
    		$user = User::findByUsername($un);
    		if ($user == null) {
	    		throw new CHttpException(400,'Unable to process request');
    		}
    		
    		$bottles = null;
    		switch ($type) {
    			case 'iso':
    				$bottles = Bottle::model()->findAll(array(
    				'join' => 'JOIN iso ON `t`.BeerID = iso.BeerID',
    				'condition'=>'`t`.UserID=:uid2 AND iso.UserID=:uid AND `t`.IsActive=1 AND `t`.IsTradeable=1',
    				'params'=>array(':uid'=>Yii::app()->user->ID, ':uid2'=>$user->ID)
    				));
    				break;
    			case 'ft':
    				$bottles = Bottle::model()->findAll(array(
    				'join' => 'JOIN iso ON `t`.BeerID = iso.BeerID',
    				'condition'=>'`t`.UserID=:uid AND iso.UserID=:uid2 AND `t`.IsActive=1 AND `t`.IsTradeable=1',
    				'params'=>array(':uid'=>Yii::app()->user->ID, ':uid2'=>$user->ID)
    				));
    				break;
    			case 'both':
    				$bottles = Bottle::model()->findAll(array(
    				'join' => 'JOIN iso ON `t`.BeerID = iso.BeerID',
    				'condition'=>'((`t`.UserID=:uid2 AND iso.UserID=:uid) OR (`t`.UserID=:uid AND iso.UserID=:uid2)) AND `t`.IsActive=1 AND `t`.IsTradeable=1',
    				'params'=>array(':uid'=>Yii::app()->user->ID, ':uid2'=>$user->ID)
    				));
    				break;
    			default:
    				throw new CHttpException(400,'Unable to process request');
    		}
    		
    		$data = array();
    		if (!empty($bottles)) {
    			foreach ($bottles as $bottle) {
    				$ko = KnockoutBottle::MakeDataWithBottle($bottle);
    				if ($bottle->UserID == Yii::app()->user->ID) {
    					$ko["findTraderType"] = 'iso';
    				} else {
    					$ko["findTraderType"] = 'ft';
    				}
    				$data[] = $ko;
    			}
    		}
    	}

    	echo CJavaScript::jsonEncode($data);
    	Yii::app()->end();
    }
}