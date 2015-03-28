<?php

class BeverageType
{
	const BEER = "Beer";
	const WINE = "Wine";
	const SPIRIT = "Spirit";
	
	public static function getAllTypes() { return array(self::BEER, self::WINE, self::SPIRIT); }
}

?>