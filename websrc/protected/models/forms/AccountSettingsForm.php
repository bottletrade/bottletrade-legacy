<?php
    
    class AccountSettingsForm extends CFormModel
    {
        public $newPassword;
        public $confirmPassword;
        public $globalEmailNotifications;
        public $emailFriendRequests;
        public $emailInboxMessages;
        public $emailTradeOffers;
        public $emailAcceptedOffers;
        public $emailDeclinedOffer;
        public $emailShippingDates;
        public $emailBottlesReceived;
        public $emailBottlesShipped;
        public $emailClosedTrades;
        public $emailTraderReviews;
        public $emailTradeMessages;
        
        public function __construct()
        {
        }
        
        public function attributeLabels()
        {
        	return array('newPassword' => 'New Password',
        				 'confirmPassword' => 'Re-enter New Password',
        			     'emailFriendRequests' => 'Friend Requests',
        			     'emailInboxMessages' => 'Inbox Messages',
        			     'emailTradeOffers' => 'Trade Offers',
        			     'emailAcceptedOffers' => 'Accepted Offers',
        			     'emailShippingDates' => 'Shipping Dates',
        			     'emailBottlesReceived' => 'Bottles Received',
        			     'emailBottlesShipped' => 'Bottles Shipped',
        			     'emailClosedTrades' => 'Closed Trades',
        			     'emailTraderReviews' => 'Trader Reviews',
        			     'emailTradeMessages' => 'Trade Messages',
        			     'emailDeclinedOffer' => 'Declined Offers'
        	);
        }
        
        /**
         * Declares the validation rules.
         */
        public function rules()
        {
            return array(
            			// passwords must match
            			array('newPassword', 'length', 'max'=>20, 'allowEmpty'=>true),
            			array('confirmPassword', 'compare', 'compareAttribute'=>'newPassword'),
            			array('globalEmailNotifications, emailFriendRequests, emailInboxMessages, emailTradeOffers, 
            				  emailAcceptedOffers, emailShippingDates, emailBottlesReceived, 
            				  emailBottlesShipped, emailClosedTrades, emailTraderReviews, 
            				  emailTradeMessages, emailDeclinedOffer', 'boolean')
            );
        }
        
        public function save()
        {
        	$user = User::getCurrentUser();
        	if (!empty($this->newPassword)) {
        		// user requested to update password
           		$user->Password = CPasswordHelper::hashPassword($this->newPassword);
        	}
        	$emailManager = new EmailManager($user);
        	if (!$this->globalEmailNotifications) {
        		// disable all emails
        		$emailManager->disableAllEmails();
        	} else {
        		$emailManager->enableNewFriendRequestEmails($this->emailFriendRequests);
        		$emailManager->enableNewMailMessageEmails($this->emailInboxMessages);
        		$emailManager->enableIncomingOfferEmails($this->emailTradeOffers);
        		$emailManager->enableOfferAcceptedEmails($this->emailAcceptedOffers);
        		$emailManager->enableShipDatesUpdatedEmails($this->emailShippingDates);
        		$emailManager->enableBottlesReceivedEmails($this->emailBottlesReceived);
        		$emailManager->enableBottlesShippedEmails($this->emailBottlesShipped);
        		$emailManager->enableTradeClosedEmails($this->emailClosedTrades);
        		$emailManager->enableTraderReviewsEmails($this->emailTraderReviews);
        		$emailManager->enableTradeMessageEmails($this->emailTradeMessages);
        		$emailManager->enableOfferDeclinedEmails($this->emailDeclinedOffer);
        	}
        	$user->EmailPreferences = $emailManager->getEncodedEmailPreferences();
        
        	return $user->save();
        }
    }
