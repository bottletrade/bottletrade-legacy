<?php

class CompanyController extends Controller
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
						'actions'=>array('viewBrewery','viewWinery','viewDistillery'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionViewBrewery($id) {
		$brewery = Brewery::model()->findByPk($id);
		if ($brewery == null) {
			throw new CHttpException(404, "Brewery not found");
		}

		$this->render('brewery',array('brewery'=>$brewery));
	}
	
	public function actionViewWinery($id) {
		$winery = Winery::model()->findByPk($id);
		if ($winery == null) {
			throw new CHttpException(404, "Winery not found");
		}

		$this->render('winery',array('winery'=>$winery));
	}
	
	public function actionViewDistillery($id) {
		$distillery = Distillery::model()->findByPk($id);
		if ($distillery == null) {
			throw new CHttpException(404, "Distillery not found");
		}

		$this->render('distillery',array('distillery'=>$distillery));
	}
}