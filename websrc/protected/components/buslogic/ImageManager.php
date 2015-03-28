<?php

class ImageManager
{
	private $model;
	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function getImageUrl() {
		$hasImage = !empty($this->model->ImagePath);
		
		if (ModelTypeUtils::isUser($this->model)) {
			if ($hasImage) {
				return UrlUtils::generateAbsoluteUrl("fileView","showProfilePic")."/?u=".$this->model->ID;
			} else {
				return ImageUtils::getDefaultProfileImageUrl();
			}
		} else if (ModelTypeUtils::isBottle($this->model)) {
			if ($hasImage) {
			return UrlUtils::generateAbsoluteUrl("fileView","showBottlePic")."/?b=".$this->model->ID;
			} else {
				return ImageUtils::getDefaultBottleImageUrl();
			}
		} else if (ModelTypeUtils::isFeed($this->model) && $this->model->EventType == FeedEventType::BOTTLE) {
			if ($hasImage) {
			return UrlUtils::generateAbsoluteUrl("fileView","showBottlePic")."/?b=".$this->model->BottleID;
			} else {
				return ImageUtils::getDefaultBottleImageUrl();
			}
		} else if (ModelTypeUtils::isFeed($this->model) && $this->model->EventType == FeedEventType::TRADE) {
			return UrlUtils::generateAbsoluteUrl("fileView","showProfilePic")."/?u=".$this->model->EventOwnerID;
		}
	}
	
	/* Static Methods */
	public static function getTempFileUrl($filename) {
		return UrlUtils::generateAbsoluteUrl("fileView","showTempImage")."/?filename=".$filename;
	}
	
	public static function getImageUrlStatic($model) {
		$imgMgr = new self($model);
		return $imgMgr->getImageUrl();
	}
	
	public static function generateUniqueFileName($path, $origFilename) {
		$fileparts = pathinfo($origFilename);
		$newFile = PathUtils::pathCombine($path, StringUtils::generateRandomString(20).'.'.$fileparts['extension']);
		// make sure we don't get a filename that already exists
		while (file_exists($newFile)) {
			$newFile = $newFile = PathUtils::pathCombine($path, StringUtils::generateRandomString(20).'.'.$fileparts['extension']);
		}
		return $newFile;
	}
	
	public static function getAbsoluteDataPath($relativePath) {
		return PathUtils::pathCombine(Yii::getPathOfAlias('application.userdata'), $relativePath);
	}
	
	public static function getRelativeDataPath($absolutePath) {
		$len = strlen(Yii::getPathOfAlias('application.userdata'));
		return substr($absolutePath, $len + 1);
	}
	
	public static function getUserDataPath($create = true) {
		$path = PathUtils::pathCombine(Yii::getPathOfAlias('application.userdata'), Yii::app()->user->Username);
		return !$create ? $path : PathUtils::createFolder($path);
	}
	
	public static function getUserImagePath($create = true) {
		$path = PathUtils::pathCombine(self::getUserDataPath($create), 'images');
		return !$create ? $path : PathUtils::createFolder($path);
	}
	
	public static function getBottlePicPath($create = true) {
		$path = PathUtils::pathCombine(self::getUserImagePath($create), 'bottles');
		return !$create ? $path : PathUtils::createFolder($path);
	}
	
	public static function getProfilePicPath($create = true) {
		$path = PathUtils::pathCombine(self::getUserImagePath($create), 'profile');
		return !$create ? $path : PathUtils::createFolder($path);
	}
	
	public static function getTempUploadPath($create = true) {
		$path = PathUtils::pathCombine(Yii::getPathOfAlias('application.temp'), Yii::app()->user->Username);
		return !$create ? $path : PathUtils::createFolder($path);
	}
	
	public static function getTempFilePath($filename) {
		return PathUtils::pathCombine(self::getTempUploadPath(), $filename);
	}
}