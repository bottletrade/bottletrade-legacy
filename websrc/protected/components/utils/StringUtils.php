<?php
    
class StringUtils
{
	public static function startsWith($input, $keyword) {
		return substr( $input, 0, strlen($keyword) ) === $keyword;
	}

	public static function endsWith($input, $keyword) {
		return substr( $input, strlen($input)-strlen($keyword), strlen($keyword) ) === $keyword;
	}
	
	public static function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $numChars = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $numChars - 1)];
	    }
	    return $randomString;
	}
	
	// add 's to end of word
	public static function createSingularPossessionText($text) {
		return $text."'s";
	}
}