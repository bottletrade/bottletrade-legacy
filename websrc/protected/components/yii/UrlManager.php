<?php 
class UrlManager extends CUrlManager {

	// remove dash to map dashed url with undashed controller/action
	public function parseUrl($request)
	{
		$url = parent::parseUrl($request);
		if (substr_count($url, "-") > 0) {
			$url = explode('-', $url);
			$url = array_map('strtolower', $url);
			$url = array_map('ucfirst', $url);
			$url = implode('',$url);
		}
		return $url;
	}
}
?>