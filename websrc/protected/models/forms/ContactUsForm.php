<?php
    
    class ContactUsForm extends CFormModel
    {
    	const TOPIC_CYBER_CELLAR = "Cyber Cellar";
    	const TOPIC_TRADES = "Trades";
    	const TOPIC_PROFILE = "Profile";
    	const TOPIC_ACCOUNT = "Account";
    	const TOPIC_FRIENDS = "Friends";
    	const TOPIC_MESSAGES = "Messages";
    	const TOPIC_COMPANY_INFO = "Brewery Info";
    	const TOPIC_BEVERAGE_INFO = "Beer Info";
    	const TOPIC_NEW_BEER_STYLE = "New Beer Style";
    	const TOPIC_ORDERS = "Orders";
    	const TOPIC_OTHER = "Other";
    	
    	private static $Topics = null;
    	
    	public $email;
    	public $topic;
    	public $message;
    	
    	public static function getTopics() { 
    		if (self::$Topics == null ) {
    			self::$Topics = array( 
    					self::TOPIC_CYBER_CELLAR,
    					self::TOPIC_TRADES,
    					self::TOPIC_PROFILE,
    					self::TOPIC_ACCOUNT,
    					self::TOPIC_FRIENDS,
    					self::TOPIC_MESSAGES,
    					self::TOPIC_COMPANY_INFO,
    					self::TOPIC_BEVERAGE_INFO,
    					self::TOPIC_NEW_BEER_STYLE,
    					self::TOPIC_ORDERS,
    					self::TOPIC_OTHER );
    		} 
    		return self::$Topics;
    	}
    	
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				// fields required
    				array('email, topic, message', 'required'),
    				array('email', 'email'),
    				// topic must be one of the specified values
    				array('topic','in','range'=>self::getTopics(),'allowEmpty'=>false)
    		);
    	}
    	
    	public function sendMessage()
    	{
    		$emailSender = new EmailSender();
    		return $emailSender->sendContactUsEmail($this);
    	}
    }
    
?>