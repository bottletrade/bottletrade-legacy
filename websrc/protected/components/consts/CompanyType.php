<?php

class CompanyType
{
	const BREWERY = "Brewery";
	const WINERY = "Winery";
	const DISTILLERY = "Distillery";
	
	public static function getAllTypes() { return array(self::BREWERY, self::WINERY, self::DISTILLERY); }
}

?>