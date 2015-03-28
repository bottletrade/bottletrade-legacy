<?php 
class DateTimeUtils
{
	public static function formatTime($time) {
		return date("F jS, Y, g:i a", strtotime($time));
	}
	
	public static function formatDateOnly($time) {
		return date("F jS, Y", strtotime($time));
	}
	
	public static function getAdjustedDateTime($addSeconds = 0) {
		return self::getUtcFormat(time() + $addSeconds);
	}
	
	public static function getCurrentDateTime() {
		return self::getUtcFormat(time());
	}
	
	public static function getUtcFormat($time) {
		if (is_string($time)) {
			return date("Y-m-d\TH:i:s\Z", strtotime($time));
		} else if (is_int($time)) {
			return date("Y-m-d\TH:i:s\Z", $time);
		}
	}
}

?>