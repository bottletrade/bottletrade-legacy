<?php

// load defines
$tradeStatus = dirname(__FILE__).'/protected/components/consts/db/TradeStatus.php';
require_once($tradeStatus);

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/production.php';

defined('YII_DEBUG') or define('YII_DEBUG',false);

require_once($yii);
$app = Yii::createWebApplication($config);
$app->setTimeZone("UTC");

if (!$app->user->isGuest)
{
	$user = User::findByUsername(Yii::app()->user->getName());
	if ($user == null) {
		Yii::app()->user->logout();
	} else {
		$app->user->setState('isAdmin', in_array(strtolower(Yii::app()->user->getName()), Yii::app()->params['adminUsers'], true));
		$app->user->setState('ID', $user->ID);
		$app->user->setState('Username', $user->Username);
	}
}
$app->run();
