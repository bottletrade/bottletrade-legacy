<?php

    class MailMessageForm extends CFormModel
    {
    	public $subject;
    	public $body;
    	public $userToName;
    	public $userToId;
    	public $userFromId;
    	public $parentMessageId;
    
    	public static function getReplyPrefix() {
    		return "RE: ";
    	}
    	
    	public function attributeLabels()
    	{
    		return array('body' => 'Message',
    					 'userToName' => 'To: ');
    	}
    	
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				// fields required
    				array('subject, body, userToId, userFromId', 'required'),
    				array('subject','length','max'=>60),
    				array('body','length','max'=>1000),
    				array('parentMessageId', 'required', 'on' => 'reply'),
    				array('parentMessageId, userToName', 'safe')
    				);
    	}
    
    	/**
         * Creates a new message
         * @return boolean whether message was created successfully, sets output param with message ID
         */
        public function sendMessage(&$newMsgId)
        {
        	$transaction = Yii::app()->db->beginTransaction();
        	try
        	{
        		$message = new Message;
	            $message->UserFrom = $this->userFromId;
	            $message->UserTo = $this->userToId;
	            $message->Subject = $this->subject;
	            $message->Body = $this->body;
	            $message->IsRead = 0;
	            $message->IsLeaf = 1;
	            $message->SentTime = DateTimeUtils::getCurrentDateTime();
	            $message->DeletedBySender = 0;
	            $message->DeletedByReceiver = 0;
	            
	            if ($this->scenario == 'reply') {
	            	$parentMsg = Message::model()->findByPk($this->parentMessageId);
	            	if ($parentMsg == null) {
	            		throw ExceptionUtils::createVarException($this);
	            	}
	            	
	            	// Check if reply should belong to the same thread
	            	// same thread if subject is the same (with or without the reply prefix)
	            	if ($this->subject == self::getReplyPrefix().$parentMsg->Subject || $this->subject == $parentMsg->Subject) {
	            		// reset subject to match thread
	            		$message->Subject = $parentMsg->Subject;
	            		
	            		// mark all messages in thread sent to other user as non-leaves
	            		$messages = Message::model()->findAll(array('condition'=>'Subject = :sub AND UserTo = :uid', 'params'=>array(':sub'=>$message->Subject, ':uid'=>$message->UserTo)));
	            		
	            		foreach ($messages as $m) {
	            			$m->IsLeaf = 0;
	            			if (!$m->save()) {
	            				throw ExceptionUtils::createVarException($m);
	            			}
	            		}
	            	}
	            }
	            
	            if (!$message->save()) {
	            	throw ExceptionUtils::createVarException($message);
	            }
	            
	            $transaction->commit();
	            
	            $emailSender = new EmailSender();
	            $emailSender->sendNewMailMessageEmail($message);
	            $newMsgId = $message->ID;
	            return true;
        	}
        	catch(CDbException $e)
        	{
        		if ($isNewTransaction) {
        			$transaction->rollback();
        		}
        		throw $e;
        	}
        	catch(Exception $e)
        	{
        		if ($isNewTransaction) {
        			$transaction->rollback();
        		}
        		throw $e;
        	}
        }
        
        public static function MakeDisplayData($message)
        {
        	$display = array();
        	$display["userToUsername"] = $message->userTo->Username;
        	$display["userToId"] = $message->UserTo;
        	$display["userFromUsername"] = $message->userFrom->Username;
        	$display["userFromId"] = $message->UserFrom;
        	$display["userFromImgSrc"] = ImageManager::getImageUrlStatic($message->userFrom);
        	if ($message->UserFrom == Yii::app()->user->ID) {
        		// replying to message from same user
        		$display["userToReplyId"] = $message->UserTo;
        		$display["userFromReplyId"] = $message->UserFrom;
        	} else {
        		$display["userToReplyId"] = $message->UserFrom;
        		$display["userFromReplyId"] = $message->UserTo;
        	}
        	$display["parentMessageId"] = $message->ID;
        	$display["body"] = $message->Body;
        	$display["subject"] = $message->Subject;
        	$display["replyBody"] = "";
        	if (!StringUtils::startsWith($message->Subject,self::getReplyPrefix())) {
        		$display["replySubject"] = self::getReplyPrefix().$message->Subject;
        	} else {
        		$display["replySubject"] = $message->Subject;
        	}
        	$display["sentTime"] = $message->SentTime;
        	return $display;
        }
    }
    
?>