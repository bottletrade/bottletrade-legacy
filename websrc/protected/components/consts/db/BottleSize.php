<?php 

class BottleSize
{
	// THESE VALUES CANNOT CHANGE
	const OTHER = "other";
	
	public static function getDropdownList() {
		$data = FormUtils::createEmptyDropdown();
		FormUtils::addToDropdownList($data, array("Select bottle size..."));
		FormUtils::addToDropdownListWithGroup($data, self::getImperialSizes(), "Imperial");
		FormUtils::addToDropdownListWithGroup($data, self::getMetricSizes(), "Metric");
		FormUtils::addToDropdownListWithGroup($data, array(self::OTHER), "Other");
		return $data;
	}
	
	public static function getAllValidSizes() {
		return array_merge(self::getImperialSizes(), self::getMetricSizes(), array(self::OTHER));
	}
	
	// Order of sizes does not matter
	public static function getImperialSizes() {
		return array(	"7 oz", 
						"12 oz", 
						"16 oz", 
						"22 oz", 
						"25 oz", 
						"32 oz", 
						"40 oz");
	}
	
	// Order of sizes does not matter
	public static function getMetricSizes() {
		return array(	"125 ml", 
						"187 ml", 
						"250 ml", 
						"275 ml", 
						"330 ml", 
						"341 ml", 
						"350 ml", 
						"355 ml", 
						"375 ml", 	
						"500 ml",
						"550 ml",
						"650 ml",
						"750 ml",
						"1 l",
						"1.5 l",
						"3 l"
		);
	}
}

?>