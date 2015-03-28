<?php 
class HashTag extends BaseHashTag
{
	public static function stripOutHashTags($input) {
		$pattern = '/#\w+/i';

		$hashtags = array();
		if (preg_match_all($pattern, $input, $matches)) {
			$hashtags = $matches[0];
		}
		
		return $hashtags;
	}
	
	public static function convertHashTagsToLinks($input) {
		$pattern = '/#(\w+)/i';
		$replacement = '<a class="hashtag" href="'.UrlUtils::generateUrl(UrlUtils::HashTagsUri, "\${1}").'">#\1</a>';
			
		return preg_replace($pattern, $replacement, $input);
	}
}
?>