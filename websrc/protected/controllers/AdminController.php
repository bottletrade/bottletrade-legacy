<?php

class AdminController extends Controller
{
	public $layout='admin';
	
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
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('home', 'viewActiveUsers'),
				'users'=>array('admin','zombiechuck','nick','brian','patguitar01','bottletrade'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
		);
	}
	
	public function actionHome()
	{
		$data = array();
		
		// active user count
		$criteria = new CDbCriteria();
		$criteria->condition = 'IsActive = 1';
		$data['activeUsers'] = User::model()->count($criteria);
		
		// active bottle count
		$criteria = new CDbCriteria();
		$criteria->condition = 'IsActive = 1';
		$data['activeBottles'] = Bottle::model()->count($criteria);
		
		// pending offer count
		$data['pendingOffers'] = Offer::model()->count();
		
		// pending trade count
		$criteria = new CDbCriteria();
		$criteria->condition = 'Status!=:stat AND CompletedTime IS NULL';
		$criteria->params = array(':stat'=> TradeStatus_Cancelled);
		$data['pendingTrades'] = Trade::model()->count($criteria);
		
		// completed trade count
		$criteria = new CDbCriteria();
		$criteria->condition = 'CompletedTime IS NOT NULL';
		$data['completedTrades'] = Trade::model()->count($criteria);
		
		$this->render('home', array('data' => $data));
	}
	
	public function actionViewActiveUsers()
	{
		$data = array();
		$data['users'] = User::model()->findAll(array('select'=>'Email', 'condition'=>'IsActive=1'));
		$this->render('users', array('data' => $data));
	}
}