<?php 

// Values used in database, must not change
define("TradeStatus_Pending", 0);
define("TradeStatus_ShipDateSet", 1);
define("TradeStatus_Shipped", (float)(TradeStatus_ShipDateSet << 1));
define("TradeStatus_Received", (float)(TradeStatus_Shipped << 1));
define("TradeStatus_Reviewed", (float)(TradeStatus_Received << 1));
define("TradeStatus_Cancelled", (float)0xFFFFFFF);

class TradeStatus
{
	// accepts $status values defined by TradeStatus_*
	private static function _assignStatus($trade, $status) {
		$trade->Status = $status;
	}
	
	// accepts $status values defined by TradeStatus_*
	private static function _addStatus($trade, $status) {
		$trade->Status = $trade->Status | $status;
	}
	
	// accepts $status values defined by TradeStatus_*
	private static function _checkStatusEqual($trade, $status) {
		return ($trade->Status & $status) > 0;
	}
	
	// accepts $status values defined by TradeStatus_*
	public static function checkStatusEqual($trade, $status) {
		$ret = true;
		switch ($status) {
			case TradeStatus_Pending:
				$ret = $trade->Status == TradeStatus_Pending;
				break;
			case TradeStatus_Cancelled:
				$ret = $trade->Status == TradeStatus_Cancelled;
				break;
			default:
				$ret = $ret && self::_checkStatusEqual($trade, $status);
				break;
		}
		return $ret;
	}
	
	// accepts $status values defined by TradeStatus_*
	public static function setStatus($trade, $status) {
		if ($status == TradeStatus_Cancelled) {
			self::_assignStatus($trade, $status);
		} else {
			self::_addStatus($trade, $status);
		}
	}
}
?>