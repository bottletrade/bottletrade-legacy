<?php
	class KnockoutIso extends KnockoutModel
	{
        public static function MakeEmptyData() {
        	self::generateEmptyData();
        	return self::$data;
        }
        
        public static function MakeDataWithIso($iso) {
        	self::generateDataWithIso($iso);
        	return self::$data;
        }
        
        private static function generateEmptyData() {
        	self::reset();
        	self::$data["eventType"] = KnockoutEventType::ISO;
        }
        
        private static function generateDataWithIso($iso) {
        	self::generateEmptyData();
        	self::$data["isoId"] = $iso->ID;
        	self::$data["time"] = $iso->CreatedTime;
        	self::$data["isEditable"] = Iso::isOwnedByCurrentUser($iso);
        	
        	if (!empty($iso->BeerID)) {
	        	self::$data["eventType"] = KnockoutEventType::ISO_BEER;
	        	self::$data["imgSrc"] = ImageUtils::getBeverageImageUrl($iso->beer);
				self::$data["beverageName"] = $iso->beer->Name;
				self::$data["companyName"] = $iso->beer->brewery->Name;
				self::$data["beverageUrl"] = UrlUtils::getBeverageUrl($iso->beer);
				self::$data["companyUrl"] = UrlUtils::getCompanyUrl($iso->beer->brewery);
        	}
        }
	}