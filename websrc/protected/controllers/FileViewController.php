<?php 
class FileViewController extends Controller
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
    					'actions'=>array('showTempImage', 'showProfilePic', 'showBottlePic'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
	private function showImage($folder, $filename = false)
	{
	    if ($filename)
	    {
    		if (!StringUtils::endsWith($folder,DIRECTORY_SEPARATOR)) $folder .= DIRECTORY_SEPARATOR;
    	
	        if (file_exists($folder. $filename))
	        {
	            Yii::app()->request->sendFile(
	                $filename,
	                file_get_contents($folder.$filename)
	            );
	        } else {
	            echo "File not found!";
	        }
	    }
	}
	
	public function actionShowTempImage($filename = false) 
	{
		$folder = ImageManager::getTempUploadPath();
		$this->showImage($folder, $filename);
	}
	
	public function actionShowProfilePic($u) {
		$user = User::getUser($u);
		$accessMgr = new FileAccessManager($user);
		
		if (!$accessMgr->hasAccess()) {
			throw new CHttpException(401, 'You are not authorized to view this image');
		}
		
		if (empty($user->ImagePath)) {
			return $this->showImage(Yii::getPathOfAlias('webroot.images.profile'), "siloutte.jpg");
		} else {
			$pathparts = pathinfo(ImageManager::getAbsoluteDataPath($user->ImagePath));
			$this->showImage($pathparts['dirname'], $pathparts['basename']);
		}
	}
	
	public function actionShowBottlePic($b) {
		$bottle = Bottle::getBottle($b);
		$accessMgr = new FileAccessManager($bottle);
	
		if (!$accessMgr->hasAccess()) {
			throw new CHttpException(401, 'You are not authorized to view this image');
		}
	
		if (empty($bottle->ImagePath)) {
			if (Bottle::isBeer($bottle)) {
				return $this->showImage(Yii::getPathOfAlias('webroot.images.beverages.beers'), "default.png");
			} else if (Bottle::isWine($bottle)) {
				return $this->showImage(Yii::getPathOfAlias('webroot.images.beverages.wines'), "default.png");
			} else if (Bottle::isWine($bottle)) {
				return $this->showImage(Yii::getPathOfAlias('webroot.images.beverages.spirits'), "default.png");
			}
			
			throw new CHttpException(404, "Unable to find image");
		} else {
			$pathparts = pathinfo(ImageManager::getAbsoluteDataPath($bottle->ImagePath));
			$this->showImage($pathparts['dirname'], $pathparts['basename']);
		}
	}
}