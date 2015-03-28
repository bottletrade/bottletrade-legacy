<?php

class HtmlUtils
{
	public static function generateUniqueId($length = 20) {
		return "uid".StringUtils::generateRandomString($length);
	}
}