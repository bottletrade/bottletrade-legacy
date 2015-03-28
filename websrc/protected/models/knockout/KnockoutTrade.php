<?php
	class KnockoutTrade extends KnockoutModel
	{
        public static function MakeFeedDataWithEvent($event) {
        	self::generateDataWithEvent($event);
        	return self::$data;
        }

        private static function generateEmptyData() {
        	self::reset();
        	self::$data["eventType"] = KnockoutEventType::TRADE;
        }
        
        private static function generateDataWithEvent($event) {
        	self::generateEmptyData();
        	self::$data["tradeId"] = $event->TradeID;
			self::$data["imgSrc"] = ImageManager::getImageUrlStatic($event);
			self::$data["time"] = $event->EventTime;
			self::$data["username"] = $event->eventOwner->Username;
			self::$data["otherUsername"] = $event->eventReceiver->Username;
        }
	}