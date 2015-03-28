<?php

class TradeMessage extends BaseTradeMessage
{
	public static function MakePostDisplayWithMessage($message) {
		$messageInfo = array();
		$messageInfo["userFrom"] = $message->userFrom->Username;
		$messageInfo["userFromImgUrl"] = ImageManager::getImageUrlStatic($message->userFrom);
		$messageInfo["sentTime"] = $message->SentTime;
		$messageInfo["body"] = $message->Body;
		return $messageInfo;
	}
}