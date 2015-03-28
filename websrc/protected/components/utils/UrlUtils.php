<?php 
class UrlUtils
{
	const InboxUri = '/inbox/messages';
	const InboxMessagesIncomingUri = self::InboxUri;
	const InboxMessagesAllUri = self::InboxUri;
	const InboxMessagesReadUri = '/inbox/messages/read';
	const InboxMessagesUnreadUri = '/inbox/messages/unread';
	const InboxMessagesSentUri = '/inbox/messages/sent';
	const InboxFriendRequestIncomingUri = '/inbox/friendrequests/waiting';
	const InboxFriendRequestSentUri = '/inbox/friendrequests/sent';
	const InboxDeleteUri = '/inbox/delete/';
	
	const CyberCellarUri = '/cyber-cellar/';
	const CyberCellarBottlesUri = '/cyber-cellar/bottles/';
	const CyberCellarTradesUri = '/cyber-cellar/trades/';
	const CyberCellarTradeSummaryUri = '/cyber-cellar/trade-summary';
	const CyberCellarPendingTradesUri = '/cyber-cellar/trades/pending';
	const CyberCellarCompletedTradesUri = '/cyber-cellar/trades/complete';
	const CyberCellarOffersUri = '/cyber-cellar/offers/';
	const CyberCellarOffersIncomingUri = '/cyber-cellar/offers/incoming';
	const CyberCellarOffersSentUri = '/cyber-cellar/offers/sent';
	const CyberCellarDeleteUri = '/cyber-cellar/delete/';

	const FriendDeleteUri = '/friend/delete';
	const TradeFindUri = '/trade/find';
	const TradeProposeUri = '/trade/propose';
	const TradeCounterUri = '/trade/counter';
	const TradeOfferResponseUri = 'trade/offerResponse';
	const TradeSendProposalUri = '/trade/proposeTrade';
	const TradeSendMessageUri = 'trade/sendMessage';
	const TraderFeedUri = '/feed';
	const FriendTraderFeedUri = '/feed/friend';
	const ProfileUri = '/profile';
	
	const ManifestoUri = '/manifesto';
	const StoreUri = '/store';
	const EducateUri = '/educate';
	const BlogUri = '/blog';
	const SearchUri = '/search';
	const ContactUsUri = '/contactus';
	const AboutUsUri = '/about';
	const LoginCreateProfile = '/account/login';
	const AccountDeleteUri = '/account/delete';
	const AccountLogoutUri = '/account/logout';
	const AccountSettingsUri = '/account/settings';
	const AccountForgotPasswordUri = '/account/forgot-password';
	
	const TipsTricksUri = '/tips-and-tricks';
	const UseBottleTradeNetworkUri = '/using-network';
	const CBIndustryUri = '/industry-news';
	const KnowYourBrewsUri = '/know-your-brews';
	const HouseRulesUri = '/house-rules';
	const PrivacyPolicyUri = '/privacy-policy';

	const HashTagsUri = "/hashtag";
	
	const BreweryUri = "/brewery";
	const WineryUri = "/winery";
	const DistilleryUri = "/distillery";
	const BeerUri = "/beer";
	const WineUri = "/wine";
	const SpiritUri = "/spirit";

	const ApiUsersUri = "/api/users/";
	const ApiBreweriesUri = "/api/breweries/";
	const ApiBeersUri = "/api/beers/";
	const ApiBeerStylesUri = "/api/beerstyles/";
	const ApiFindTraderUri = "/api/findTrader/";
	
	const BeerUpdateUri = "/crudBeer/update";
	const BreweryUpdateUri = "/crudBrewery/update";
	
	// Accepts a variable number of arguments.  
	// Arguments are combined with '/' separator and appended to the base url.
	public static function generateUrl() {
		$urlBuilder = Yii::app()->getBaseUrl(true).Yii::app()->params['index'];
		foreach (func_get_args() as $arg) {
			// add ending slash if not present
			if (!StringUtils::endsWith($urlBuilder, '/')) {
				$urlBuilder .= '/';
			}
			// remove beginning slash if present
			if (StringUtils::startsWith($arg, '/')) {
				$arg = substr($arg, 1);
			}
			$urlBuilder .= $arg;
		}
		// remove one slash if ending with two slashes
		if (StringUtils::endsWith($urlBuilder, '//')) {
			$urlBuilder = substr($urlBuilder, 0, -1);
		}
		return $urlBuilder;
	}
	
	public static function generateImageUrl($uri) {
		$ret = Yii::app()->getBaseUrl(true);
		if (!StringUtils::startsWith($uri, '/')) {
			// $uri does NOT start with '/'
			if (!StringUtils::startsWith($uri, 'images')) {
				$ret .= '/images/';
			} else {
				$ret .= '/';
			}
		} else {
			// $uri starts with '/'
			if (!StringUtils::startsWith($uri, '/images')) {
				$uri = '/images'.$uri;
			}
		}
		return $ret.$uri;
	}
	
	public static function getBeverageUrl($beverage) {
		if (ModelTypeUtils::isBeer($beverage)) {
			return self::generateUrl(self::BeerUri,$beverage->ID);
		}
		else if (ModelTypeUtils::isWine($beverage)) {
			return self::generateUrl(self::WineUri,$beverage->ID);
		}
		else if (ModelTypeUtils::isSpirit($beverage)) {
			return self::generateUrl(self::SpiritUri,$beverage->ID);
		}
	}
	
	public static function getCompanyUrl($company) {
		if (ModelTypeUtils::isBrewery($company)) {
			return self::generateUrl(self::BreweryUri,$company->ID);
		}
		else if (ModelTypeUtils::isWinery($company)) {
			return self::generateUrl(self::WineryUri,$company->ID);
		}
		else if (ModelTypeUtils::isDistillery($company)) {
			return self::generateUrl(self::DistilleryUri,$company->ID);
		}
	}
	
	public static function generateBaseUrl() {
		return Yii::app()->getBaseUrl(true);
	}
	
	public static function generateAbsoluteUrl() {
		$url = Yii::app()->getBaseUrl(true).Yii::app()->params['index'];
		foreach (func_get_args() as $arg) {
			$url .= "/".$arg;
		}
		return $url;
	}
	
	public static function generateScriptUrl($uri) {
		$ret = Yii::app()->getBaseUrl(true);
		if (!StringUtils::startsWith($uri, '/')) {
			// $uri does NOT start with '/'
			if (!StringUtils::startsWith($uri, 'scripts')) {
				$ret .= '/scripts/';
			} else {
				$ret .= '/';
			}
		} else {
			// $uri starts with '/'
			if (!StringUtils::startsWith($uri, '/scripts')) {
				$uri = '/scripts'.$uri;
			}
		}
		return $ret.$uri."?v=".Yii::app()->params["version"];
	}
	
	public static function generateCssUrl($uri) {
		$ret = Yii::app()->getBaseUrl(true);
		if (!StringUtils::startsWith($uri, '/')) {
			// $uri does NOT start with '/'
			if (!StringUtils::startsWith($uri, 'css')) {
				$ret .= '/css/';
			} else {
				$ret .= '/';
			}
		} else {
			// $uri starts with '/'
			if (!StringUtils::startsWith($uri, '/css')) {
				$uri = '/css'.$uri;
			}
		}
		return $ret.$uri."?v=".Yii::app()->params["version"];
	}
	
	public static function generateProfileUrl($user) {
		if ($user != null) {
			if (is_string($user)) {
				return self::generateUrl(self::ProfileUri, $user);
			} else {
				return self::generateUrl(self::ProfileUri, $user->Username);
			}
		}
		return self::generateUrl(self::ProfileUri);
	}
	
	public static function generateSentMessageUrl($message) {
		if ($message != null) {
			if (is_string($message)) {
				// convert to int
				$message = intval($message);
			}
			if (is_int($message)) {
				if ($message != 0) {
					return self::generateUrl(self::InboxMessagesSentUri, $message);
				}
			} else {
				return self::generateUrl(self::InboxMessagesSentUri, $message->ID);
			}
		}
		return "";
	}
	
	public static function isPageAtUri($queryUri, $exactMatch = true) {
		return self::isPageAtUriImpl($queryUri, $exactMatch, true);
	}
	
	private static function isPageAtUriImpl($queryUri, $exactMatch = true, $firstCheck = false) {
		$uri = Yii::app()->request->requestUri;
		$baseUrl = Yii::app()->getBaseUrl(false).Yii::app()->params['index'];
		if ($baseUrl != '') {
			$basePos = strpos($uri, $baseUrl);
			if ($basePos !== FALSE) {
				$uri = substr($uri, $basePos + strlen($baseUrl));
			}
		}
		
		$isMatch = false;
		if ($exactMatch) {
			$isMatch = $uri == $queryUri;
			
			if (!$isMatch && $firstCheck) {
				// consider case with or without / matching
				// try other possible match
				if (StringUtils::endsWith($queryUri, '/')) {
					$noSlashUri = substr($queryUri, 0, -1 );
					$isMatch = self::isPageAtUriImpl($noSlashUri, $exactMatch, false);
				} else {
					$slashUri = $queryUri."/";
					$isMatch = self::isPageAtUriImpl($slashUri, $exactMatch, false);
				}
			}
		} else {
			$isMatch = StringUtils::startsWith($uri, $queryUri);
			
			if (!$isMatch && $firstCheck) {
				// consider case with or without / matching
				// try other possible match
				if (StringUtils::endsWith($queryUri, '/')) {
					$noSlashUri = substr($queryUri, 0, -1 );
					$isMatch = self::isPageAtUriImpl($noSlashUri, $exactMatch, false);
				} else {
					$slashUri = $queryUri."/";
					$isMatch = self::isPageAtUriImpl($slashUri, $exactMatch, false);
				}
			}
		}
		
		return $isMatch;
	}
}

?>