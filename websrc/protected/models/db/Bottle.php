<?php

class Bottle extends BaseBottle
{
	public static function getBottle($id) {
		return Bottle::model()->findByPk($id);
	}
	
	public static function isOwnedByCurrentUser($bottle)
	{
		return $bottle->UserID == Yii::app()->user->ID;
	}
	
	public static function isOwnedByUser($bottle, $user)
	{
		return $bottle->UserID == $user->ID;
	}
	
	public static function isBeer($bottle)
	{
		return $bottle->BeerID != null;
	}
	
	public static function isWine($bottle)
	{
		return $bottle->WineID != null;
	}
	
	public static function isSpirit($bottle)
	{
		return $bottle->SpiritID != null;
	}
	
	public static function getBottledOnDateDisplay($bottle)
	{
		$date = self::getBottledOnDate($bottle);
		$len = strlen($date);
		if ($len == 4) {
			// only year provided
			return $date;
		} else if ($len == 7) {
			// year/month provided
			return date("F Y", strtotime($date."-01"));
		} else {
			// year/month/day provided
			return date("F jS, Y", strtotime($date));
		}
	}
	
	public static function getBottledOnDate($bottle) 
	{
		$month = substr($bottle->BottledOnDate, 5, 2);
		if ($month != '00') {
			// check if day provided
			$day = substr($bottle->BottledOnDate, 8, 2);
			if ($day != '00') {
				// year/month/day provided
				return substr($bottle->BottledOnDate, 0, 10);
			} else {
				// year/month provided
				return substr($bottle->BottledOnDate, 0, 7);
			}
		} else {
			// year provided
			return substr($bottle->BottledOnDate, 0, 4);
		}
	}
	
	public static function getBottledOnYear($bottle) {
		return substr($bottle->BottledOnDate, 0, 4);
	}
	
	public static function getBeverageType($bottle)
	{
		if (self::isBeer($bottle)) {
			return BeverageType::BEER;
		} else if (self::isWine($bottle)) {
			return BeverageType::WINE;
		} else if (self::isSpirit($bottle)) {
			return BeverageType::SPIRIT;
		}
	}
	
	public static function getCompanyID($bottle)
	{
		if (self::isBeer($bottle)) {
			return $bottle->beer->BreweryID;
		} else if (self::isWine($bottle)) {
			return $bottle->wine->WineID;
		} else if (self::isSpirit($bottle)) {
			return $bottle->spirit->DistilleryID;
		}
	}
	
	public static function getCompanyType($bottle)
	{
		if (self::isBeer($bottle)) {
			return CompanyType::BREWERY;
		} else if (self::isWine($bottle)) {
			return CompanyType::WINERY;
		} else if (self::isSpirit($bottle)) {
			return CompanyType::DISTILLERY;
		}
	}
	
	public static function getCompanyName($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->beer->brewery->Name;
		} else if (self::isWine($bottle)) {
			return $bottle->winery->Name;
		} else if (self::isSpirit($bottle)) {
			return $bottle->distillery->Name;
		}
	}
	
	public static function getCompanyCityStateDisplay($bottle, $separator = ", ", $prefix = "(", $suffix = ")") {
		$city = self::getCompanyCity($bottle);
		$state = self::getCompanyState($bottle);
		$emptyCity = empty($city);
		$emptyState = empty($state);
		if (!$emptyCity || !$emptyState) {
			if ($emptyCity) {
				$display = $state;
			} else if ($emptyState) {
				$display = $city;
			} else {
				$display = $city.$separator.$state;
			}
			
			return $prefix.$display.$suffix;
		}
		
		return "";
	}

	public static function getCompanyCity($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->beer->brewery->City;
		} else if (self::isWine($bottle)) {
			return $bottle->winery->City;
		} else if (self::isSpirit($bottle)) {
			return $bottle->distillery->City;
		}
	}

	public static function getCompanyState($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->beer->brewery->State;
		} else if (self::isWine($bottle)) {
			return $bottle->wine->winery->State;
		} else if (self::isSpirit($bottle)) {
			return $bottle->spirit->distillery->State;
		}
	}
	
	public static function getBeverageName($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->beer->Name;
		} else if (self::isWine($bottle)) {
			return $bottle->wine->Name;
		} else if (self::isSpirit($bottle)) {
			return $bottle->spirit->Name;
		}
	}
	
	public static function getBeverageAbv($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->beer->ABV;
		} else if (self::isWine($bottle)) {
			return $bottle->wine->ABV;
		} else if (self::isSpirit($bottle)) {
			return $bottle->spirit->ABV;
		}
	}

	public static function getStyleName($bottle) {
		if (self::isBeer($bottle)) {
			if (!empty($bottle->beer->style)) {
				return $bottle->beer->style->Name;
			}
		} else if (self::isWine($bottle)) {
			if (!empty($bottle->wine->style)) {
				return $bottle->wine->style->Name;
			}
		} else if (self::isSpirit($bottle)) {
			if (!empty($bottle->spirit->style)) {
				return $bottle->spirit->style->Name;
			}
		}
		return "";
	}
	
	public static function getStyleID($bottle) {
		if (self::isBeer($bottle)) {
			return $bottle->BeerStyleID;
		} else if (self::isWine($bottle)) {
			return $bottle->WineStyleID;
		} else if (self::isSpirit($bottle)) {
			return $bottle->SpiritStyleID;
		}
	}
}