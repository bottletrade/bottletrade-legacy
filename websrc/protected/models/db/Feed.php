<?php

class Feed extends BaseFeed 
{
	public static function isBottle($feed) {
		return $feed->EventType == FeedEventType::BOTTLE;
	}	
	
	public static function isTrade($feed) {
		return $feed->EventType == FeedEventType::TRADE;
	}
}