<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $pageDescription;
	public $pageKeywords = array();
	
	public function render($view, $data = null, $return = false)
	{
		if (!empty($this->pageDescription)) {
			Yii::app()->clientScript->registerMetaTag($this->pageDescription, 'description');
		}
		if (!empty($this->pageKeywords)) {
			Yii::app()->clientScript->registerMetaTag(join(", ", $this->pageKeywords), 'keywords');
		}
		
		parent::render($view, $data, $return);
	}
/*
	public function init()
	{
		parent::init();
	
		Yii::app()->attachEventHandler('onError',array($this,'handleError'));
		Yii::app()->attachEventHandler('onException',array($this,'handleError'));
	}
	
	public function handleError(CEvent $event)
	{
		if ($event instanceof CExceptionEvent)
		{
			// handle exception
			// ...
			Yii::app()->user->setFlash('error','Error encountered while processing your request.  If this error continues to apepar, please contact our administrator.');
		}
		elseif($event instanceof CErrorEvent)
		{
			// handle error
			// ...
			Yii::app()->user->setFlash('error','Error encountered while processing your request.  If this error continues to apepar, please contact our administrator.');
		}
	
		$event->handled = TRUE;
		$this->redirect(Yii::app()->request->urlReferrer);
	}*/
}