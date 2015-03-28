<?php

class AutoCompleteController extends Controller
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
						'actions'=>array('suggestUser'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actions()
	{
		return array(
				'suggestUser'=>array(
						'class'=>'ext.actions.XSuggestAction',
						'modelName'=>'User',
						'methodName'=>'suggest',
				),
		);
	}
}