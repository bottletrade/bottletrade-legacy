<?php 
class UserTradeInfo extends BaseUserTradeInfo
{
	public static function getUsers($trade) {
		$userTradeInfos = UserTradeInfo::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$trade->TradeID)));

		$ret = array();
		$ret[] = $userTradeInfos[0]->userOwner;
		$ret[] = $userTradeInfos[1]->userOwner;
		return $ret;
	}
}
?>