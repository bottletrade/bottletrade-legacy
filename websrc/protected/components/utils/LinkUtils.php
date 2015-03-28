<?php 
class LinkUtils
{
	public static function createProfileLink($username) {
		return "<a href='".UrlUtils::generateUrl(UrlUtils::ProfileUri,$username)."'>$username</a>";
	}
}
?>