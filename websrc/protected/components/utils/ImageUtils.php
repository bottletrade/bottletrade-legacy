<?php 
class ImageUtils
{
	public static function getRelativePathToImage() {
		$imagePath =  DIRECTORY_SEPARATOR.'images';
		foreach (func_get_args() as $arg) {
			$imagePath .= DIRECTORY_SEPARATOR.$arg;
		}
		return $imagePath;
	}
	
	public static function getAbsolutePathToImage() {
		$imagePath =  Yii::getPathOfAlias('webroot.images');
		foreach (func_get_args() as $arg) {
			$imagePath .= DIRECTORY_SEPARATOR.$arg;
		}
		return $imagePath;
	}
	
	// Beverage Image Urls
	public static function generateBeerImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/beverages/beers/'.$filename);
	}
	
	public static function generateWineImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/beverages/wines/'.$filename);
	}
	
	public static function generateSpiritImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/beverages/spirits/'.$filename);
	}
	
	public static function getDefaultBeerImageUrl() {
		return UrlUtils::generateImageUrl('/images/beverages/beers/default.png');
	}
	
	public static function getDefaultWineImageUrl() {
		return UrlUtils::generateImageUrl('/images/beverages/wines/default.png');
	}
	
	public static function getDefaultSpiritImageUrl() {
		return UrlUtils::generateImageUrl('/images/beverages/spirits/default.png');
	}

	// Company Image Urls
	public static function generateBreweryImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/companies/breweries/'.$filename);
	}
	
	public static function generateWineryImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/companies/wineries/'.$filename);
	}
	
	public static function generateDistilleryImageUrl($filename) {
		return UrlUtils::generateImageUrl('/images/companies/distilleries/'.$filename);
	}
	
	public static function getDefaultBreweryImageUrl() {
		return UrlUtils::generateImageUrl('/images/companies/breweries/default.png');
	}
	
	public static function getDefaultWineryImageUrl() {
		return UrlUtils::generateImageUrl('/images/companies/wineries/default.png');
	}
	
	public static function getDefaultDistilleryImageUrl() {
		return UrlUtils::generateImageUrl('/images/companies/distilleries/default.png');
	}
	
	public static function getDefaultStyleImageUrl() {
		return UrlUtils::generateImageUrl('/images/styles/default.png');
	}
	
	public static function getDefaultBottleImageUrl() {
		return UrlUtils::generateImageUrl('/images/default-bottle.png');
	}
	
	public static function getDefaultProfileImageUrl() {
		return UrlUtils::generateImageUrl('/images/profile/siloutte.jpg');
	}
	
	public static function getBeverageImageUrl($beverage) {
		$hasImage = $beverage != null && !empty($beverage->ImageFileName);
		if (ModelTypeUtils::isBeer($beverage)) {
			return !$hasImage ? self::getDefaultBeerImageUrl() : self::generateBeerImageUrl($beverage->ImageFileName);
		}
		else if (ModelTypeUtils::isWine($beverage)) {
			return !$hasImage ? self::getDefaultWineImageUrl() : self::generateWineImageUrl($beverage->ImageFileName);
		}
		else if (ModelTypeUtils::isSpirit($beverage)) {
			return !$hasImage ? self::getDefaultSpiritImageUrl() : self::generateSpiritImageUrl($beverage->ImageFileName);
		}
	}
	
	public static function getCompanyImageUrl($company) {
		$hasImage = $company != null && !empty($company->ImageFileName);
		if (ModelTypeUtils::isBrewery($company)) {
			return !$hasImage ? self::getDefaultBreweryImageUrl() : self::generateBreweryImageUrl($company->ImageFileName);
		}
		else if (ModelTypeUtils::isWinery($company)) {
			return !$hasImage ? self::getDefaultWineryImageUrl() : self::generateWineyImageUrl($company->ImageFileName);
		}
		else if (ModelTypeUtils::isDistillery($company)) {
			return !$hasImage ? self::getDefaultDistilleryImageUrl() : self::generateDistilleryImageUrl($company->ImageFileName);
		}
	}
	
	public static function getStyleImageUrl($style) {
		if ($style == null || empty($style->ImageFileName)) {
			return self::getDefaultStyleImageUrl();
		} else {
			return UrlUtils::generateImageUrl('/styles/'.$style->ImageFileName);
		}
	}
}
?>