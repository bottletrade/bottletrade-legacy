<?php

class BeverageController extends Controller
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
				array('allow', // allow authenticated user only
						'actions'=>array('viewBeer','viewWine','viewSpirit'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionViewBeer($id) {
		$beer = Beer::model()->findByPk($id);
		if ($beer == null) {
			throw new CHttpException(404, "Beer not found");
		}

		$this->render('beer',array('beer'=>$beer));
	}
	
	public function actionViewWine($id) {
		$wine = Wine::model()->findByPk($id);
		if ($wine == null) {
			throw new CHttpException(404, "Wine not found");
		}

		$this->render('wine',array('wine'=>$wine));
	}
	
	public function actionViewSpirit($id) {
		$spirit = Spirit::model()->findByPk($id);
		if ($spirit == null) {
			throw new CHttpException(404, "Spirit not found");
		}

		$this->render('spirit',array('spirit'=>$spirit));
	}
}