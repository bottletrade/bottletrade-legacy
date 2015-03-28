<?php

class Offer extends BaseOffer
{
	public static function deleteOffer($offerID) {
		$offer = Offer::model()->findByPk($offerID);
		if ($offer == null) {
			throw ExceptionUtils::createInvalidOperationException();
		} else if (!self::belongsToCurrentUser($offer)) {
			throw ExceptionUtils::createUnauthorizedException();
		}
		
		BottleOffer::deleteBottlesOffered($offerID);

		if (!$offer->delete()) {
			throw ExceptionUtils::createVarException($offer);
		}
	}
	
	public static function getOtherUser($offer) {
		if (self::sentByCurrentUser($offer)) {
			return $offer->userTo;
		} else {
			return $offer->userFrom;
		}
	}
	
	public static function getCurrentUser($offer) {
		if (self::sentByCurrentUser($offer)) {
			return $offer->userFrom;
		} else {
			return $offer->userTo;
		}
	}
	
	public static function belongsToCurrentUser($offer) {
		return self::sentByCurrentUser($offer) || self::receivedByCurrentUser($offer);
	}
	
	public static function sentByCurrentUser($offer) {
		return $offer->UserFrom == Yii::app()->user->ID;
	}
	
	public static function receivedByCurrentUser($offer) {
		return $offer->UserTo == Yii::app()->user->ID;
	}
}