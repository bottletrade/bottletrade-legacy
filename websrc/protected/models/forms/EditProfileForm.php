<?php

    class EditProfileForm extends CFormModel
    {
    	public $imagename;
    	public $username;
    	public $firstname;
    	public $lastname;
    	public $city;
    	public $state;
    	public $links;
    	public $about;
    
    	public function attributeLabels()
        {
        	return array('firstname' => 'First&nbsp;Name: ',
        				 'lastname' => 'Last&nbsp;Name: ',
        			     'city' => 'City: ',
        				 'state' => 'State: ',
        				 'links' => 'Links: ',
        				 'about' => 'About&nbsp;Me:',);
        }
    	
    	/**
    	 * Declares the validation rules.
    	 */
    	public function rules()
    	{
    		return array(
    				array('firstname, lastname, username', 'required'),
    				array('username','length','max'=>20),
    				array('firstname, lastname, city, state','length','max'=>64),
    				array('links','length','max'=>300),
    				array('about','length','max'=>500),
    				array('city,state,links,about,imagename', 'safe')
    		);
    	}
    
    	/**
    	 * Creates a new user
    	 * @return boolean whether user was created successfully
    	 */
    	public function updateUser()
    	{
        	$transaction = Yii::app()->db->beginTransaction();
        	$ret = false;
        	$createdFile = null;
        	try
        	{
        		$user = User::model()->find('LOWER(Username)=?', array(strtolower($this->username)));
        		
        		// update user
        		$oldImagePath = null;
        		if ($this->imagename != null) {
        			// new image uploaded
        			$tempImagePath = PathUtils::pathCombine(ImageManager::getTempUploadPath(), $this->imagename);
        			$newImagePath = ImageManager::generateUniqueFileName(ImageManager::getProfilePicPath(), $this->imagename);
        			$oldImagePath = empty($user->ImagePath) ? null : ImageManager::getAbsoluteDataPath($user->ImagePath);
        			
        			rename($tempImagePath, $newImagePath);
        			$createdFile = $newImagePath;
        			$user->ImagePath = ImageManager::getRelativeDataPath($newImagePath);
        		}
	    		$user->FirstName = $this->firstname;
	    		$user->LastName = $this->lastname;
	    		$user->DisplayCity = $this->city;
	    		$user->State = $this->state;
	    		$user->Links = $this->links;
	    		$user->About = $this->about;
	    		
	    		if (!$user->save()) {
	            	throw ExceptionUtils::createVarException($user);
	    		}

	    		// delete old image
	    		if ($oldImagePath != null && file_exists($oldImagePath)) {
	    			unlink($oldImagePath);
	    		}
	    		
	            $transaction->commit();
	            return true;
        	}
        	catch(Exception $e)
        	{
        		$transaction->rollback();
        		
        		// delete new image
        		if ($createdFile != null && file_exists($createdFile)) {
        			unlink($createdFile);
        		}
        		
        		ExceptionUtils::logException($e);
        		return false;
        	}
    	}
    	
        public static function MakeDisplayDataWithUser($user)
        {
        	$display = array();
        	$display["imgurl"] = ImageManager::getImageUrlStatic($user);
        	$display["firstname"] = $user->FirstName;
        	$display["lastname"] = $user->LastName;
        	$display["username"] = $user->Username;
        	$display["city"] = $user->DisplayCity;
        	$display["state"] = $user->State;
        	$display["links"] = $user->Links;
        	$display["about"] = $user->About;
        	return $display;
        }
        
        public static function MakeDisplayDataWithForm($form)
        {
        	$display = array();
        	$display["imgurl"] = ImageManager::getImageUrlStatic(User::getCurrentUser());
        	$display["firstname"] = $form->firstname;
        	$display["lastname"] = $form->lastname;
        	$display["username"] = $form->username;
        	$display["city"] = $form->city;
        	$display["state"] = $form->state;
        	$display["links"] = $form->links;
        	$display["about"] = $form->about;
        	return $display;
        }
    }
    