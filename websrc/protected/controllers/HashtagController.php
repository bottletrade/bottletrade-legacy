<?php

class HashtagController extends Controller
{
	public $layout='main';
    
    public $defaultAction = 'default';
    
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
    					'actions'=>array('default'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
	public function actionDefault($tag = null) 
	{
		if (!empty($tag)) {
			$this->render('data',array('tag'=>$tag));
		} else {
			$hashtagCounts = Yii::app()->db->createCommand()
				            ->select('Tag, COUNT(*) as Count')
				            ->from('hashtag')  //Your Table name
				            ->group('Tag')
				            ->order('Count DESC, Tag')
				            ->queryAll(); //Will get the all selected rows from table
			
			$this->render('home',array('hashtagCounts'=>$hashtagCounts));
		}
	}
}