<?php

class EmailManager 
{
	private $bitmask;
	
	public function __construct($user)
	{
		$this->bitmask = new BitMaskUtils($user->EmailPreferences);
	}
	
	// handles enable changes
	private function enableProperty($enable, $prop) {
		if ($enable) {
			$this->bitmask->addProperty($prop);
		} else {
			$this->bitmask->removeProperty($prop);
		}
	}
	
	public function getEncodedEmailPreferences() {
		return $this->bitmask->getValue();
	}
	
	/*
	 * Global Email settings
	 */
	public function disableAllEmails() {
		return $this->bitmask->setProperty(EmailPreference::None);
	}
	public function hasDisabledAllEmails() {
		return $this->bitmask->isProperty(EmailPreference::None);
	}
	
	/*
	 * New Friend Request
	 */
	public function enableNewFriendRequestEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::NewFriendRequest);
	}
	public function acceptsNewFriendRequestEmails() {
		return $this->bitmask->hasProperty(EmailPreference::NewFriendRequest);
	}
	
	/*
	 * New Mail Message
	 */
	public function enableNewMailMessageEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::NewMailMessage);
	}
	public function acceptsNewMailMessageEmails() {
		return $this->bitmask->hasProperty(EmailPreference::NewMailMessage);
	}
	
	/*
	 * Incoming Offer
	 */
	public function enableIncomingOfferEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::IncomingOffer);
	}
	public function acceptsIncomingOfferEmails() {
		return $this->bitmask->hasProperty(EmailPreference::IncomingOffer);
	}
	
	/*
	 * Offer Accepted
	 */
	public function enableOfferAcceptedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::OfferAccepted);
	}
	public function acceptsOfferAcceptedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::OfferAccepted);
	}
	
	/*
	 * Offer Declined
	 */
	public function enableOfferDeclinedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::OfferDeclined);
	}
	public function acceptsOfferDeclinedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::OfferDeclined);
	}
	
	/*
	 * Ship Date Updated
	 */
	public function enableShipDatesUpdatedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::ShipDatesUpdated);
	}
	public function acceptsShipDatesUpdatedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::ShipDatesUpdated);
	}
	
	/*
	 * Bottles Received
	 */
	public function enableBottlesReceivedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::BottlesReceived);
	}
	public function acceptsBottlesReceivedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::BottlesReceived);
	}
	/*
	 * Bottles Shipped
	 */
	public function enableBottlesShippedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::BottlesShipped);
	}
	public function acceptsBottlesShippedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::BottlesShipped);
	}
	/*
	 * Trade Closed
	 */
	public function enableTradeClosedEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::TradeClosed);
	}
	public function acceptsTradeClosedEmails() {
		return $this->bitmask->hasProperty(EmailPreference::TradeClosed);
	}
	/*
	 * Trade Reviewed
	 */
	public function enableTraderReviewsEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::TraderReviews);
	}
	public function acceptsTraderReviewEmails() {
		return $this->bitmask->hasProperty(EmailPreference::TraderReviews);
	}
	/*
	 * Trade Message
	 */
	public function enableTradeMessageEmails($enable) {
		return $this->enableProperty($enable, EmailPreference::TradeMessage);
	}
	public function acceptsTradeMessageEmails() {
		return $this->bitmask->hasProperty(EmailPreference::TradeMessage);
	}
}