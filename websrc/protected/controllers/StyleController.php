<?php

class StyleController extends Controller
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
						'actions'=>array('viewBeerStyle','viewWineStyle','viewSpiritStyle'),
						'users'=>array('@'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionViewBeerStyle($id) {
		$beerStyle = Beerstyle::model()->findByPk($id);
		if ($beerStyle == null) {
			throw new CHttpException(404, "Beer style not found");
		}

		$this->render('beer',array('beerStyle'=>$beerStyle));
	}
	
	public function actionViewWineStyle($id) {
		$wineStyle = WineStyle::model()->findByPk($id);
		if ($wineStyle == null) {
			throw new CHttpException(404, "Wine style not found");
		}

		$this->render('wine',array('wineStyle'=>$wineStyle));
	}
	
	public function actionViewSpiritStyle($id) {
		$spiritStyle = SpiritStyle::model()->findByPk($id);
		if ($spiritStyle == null) {
			throw new CHttpException(404, "Spirit style not found");
		}

		$this->render('spirit',array('spiritStyle'=>$spiritStyle));
	}
}