<?php 
class FileUploadController extends Controller
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
    					'actions'=>array('uploadTempImage','cropTempImage', 'rotateTempImage'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
    private function saveUploadedImage($folder) 
    {
    	Yii::import("ext.EAjaxUpload.qqFileUploader");

    	// folder path to save image, must end with directory separator
    	if (!StringUtils::endsWith($folder,DIRECTORY_SEPARATOR)) $folder .= DIRECTORY_SEPARATOR;
    	
    	$allowedExtensions = array("jpg","jpeg","png");//array("jpg","jpeg","gif","exe","mov" and etc...
    	$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
    	$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
    	$result = $uploader->handleUpload($folder, FALSE);
    	$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    	
    	$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
    	$fileName=$result['filename'];//GETTING FILE NAME

    	return $return;// it's array
    }
    
    public function actionUploadTempImage() {
    	echo $this->saveUploadedImage(ImageManager::getTempUploadPath());
    }
    
    public function actionCropTempImage() {
    	// verify input exists
    	if(!isset($_POST['filename']) || 
    	   !isset($_POST['width']) || 
    	   !isset($_POST['height']) || 
    	   !isset($_POST['cwidth']) ||  
    	   !isset($_POST['cheight']) ||
    	   !isset($_POST['nwidth']) ||  
    	   !isset($_POST['nheight']) ||
    	   !isset($_POST['top']) || 
    	   !isset($_POST['left']) || 
    	   !isset($_POST['rotate'])) {
        	throw new CHttpException(404, 'Info not set');
    	}
    	
    	$savedImage = PathUtils::pathCombine(ImageManager::getTempUploadPath(), $_POST['filename']);
    	$image = new EasyImage($savedImage);
    	
    	// first handle the cases when the image uploaded was taken in a different orientation
    	$exif = exif_read_data($savedImage);
    	if ($exif !== FALSE && isset($exif['Orientation'])) {
	    	switch($exif['Orientation'])
	    	{
	    		case 1: // nothing
	    			break;
	    		case 2: // horizontal flip
	    			$image->flip(EasyImage::FLIP_HORIZONTAL);
	    			break;
	    		case 3: // 180 rotate left
	    			$image->rotate(180);
	    			break;
	    		case 4: // vertical flip
	    			$image->flip(EasyImage::FLIP_VERTICAL);
	    			break;
	    		case 5: // vertical flip + 90 rotate right
	    			$image->flip(EasyImage::FLIP_VERTICAL);
	    			$image->rotate(90);
	    			break;
	    		case 6: // 90 rotate right
	    			$image->rotate(90);
	    			break;
	    		case 7: // horizontal flip + 90 rotate right
	    			$image->flip(EasyImage::FLIP_HORIZONTAL);
	    			$image->rotate(90);
	    			break;
	    		case 8:    // 90 rotate left
	    			$image->rotate(-90);
	    			break;
	    	}
    	}
    	
    	// carry on with user's modification requests
    	$image->rotate($_POST['rotate']);
    	
    	// figure out rate image was adjusted
    	$adjRate = $_POST['nheight'] / $_POST['cheight'];
    	
    	// apply adjusted rate to all values
    	$adjWidth = $_POST['width'] * $adjRate;
    	$adjHeight = $_POST['height'] * $adjRate;
    	$adjLeft = $_POST['left'] * $adjRate;
    	$adjTop = $_POST['top'] * $adjRate;
    	
    	// crop based on what user selected
    	$image->crop($adjWidth, $adjHeight, $adjLeft, $adjTop);
    	
    	// resize crop to 640 x 640
    	$image->resize(640, 640);
    	
    	// save
    	$image->save($savedImage);
    	echo true;
    }
    
    public function actionRotateTempImage() {
    	// verify input exists
    	if(!isset($_POST['filename']) || 
    	   !isset($_POST['deg'])) {
        	throw new CHttpException(404, 'Info not set');
    	}
    	
    	$savedImage = PathUtils::pathCombine(ImageManager::getTempUploadPath(), $_POST['filename']);
    	$image = new EasyImage($savedImage);
    	$image->rotate($_POST['deg']);
    	$image->save($savedImage);
    	echo true;
    }
}