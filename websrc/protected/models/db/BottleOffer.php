<?php

class BottleOffer extends BaseBottleOffer
{
	public static function deleteBottlesOffered($offerID)
	{
		$offer = Offer::model()->findByPk($offerID);
		if ($offer == null) {
			throw ExceptionUtils::createInvalidOperationException();
		} else if (!Offer::belongsToCurrentUser($offer)) {
			throw ExceptionUtils::createUnauthorizedException();
		}
		
		self::model()->deleteAll('OfferID=?', array($offerID));
	}
}