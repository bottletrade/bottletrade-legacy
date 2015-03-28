<?php

class BeerAvailability
{
	const NONE = "";
	const LIMITED = "Limited";
	const ONE_TIME = "One Time";
	const SEASONAL = "Seasonal";
	const SEASONAL_SPRING = "Seasonal (Spring)";
	const SEASONAL_SUMMER = "Seasonal (Summer)";
	const SEASONAL_FALL = "Seasonal (Fall)";
	const SEASONAL_WINTER = "Seasonal (Winter)";
	const YEAR_ROUND = "Year Round";
	
	public static function getAllTypes() { return array(self::NONE, self::LIMITED, self::ONE_TIME, self::SEASONAL,
														self::SEASONAL_SPRING, self::SEASONAL_SUMMER,
														self::SEASONAL_FALL, self::SEASONAL_WINTER,
														self::YEAR_ROUND
														); }
}

?>