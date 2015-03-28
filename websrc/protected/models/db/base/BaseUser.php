<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $ID
 * @property string $Username
 * @property string $Password
 * @property string $Email
 * @property string $FirstName
 * @property string $LastName
 * @property string $Birthday
 * @property string $Address
 * @property string $City
 * @property string $DisplayCity
 * @property string $State
 * @property string $Country
 * @property integer $Zip
 * @property string $Links
 * @property string $About
 * @property string $ImagePath
 * @property integer $IsActive
 * @property integer $IsPrivate
 * @property integer $EmailPreferences
 * @property string $ForgotPasswordToken
 * @property string $ForgotPasswordTokenExpiration
 * @property string $CreatedTime
 *
 * The followings are the available model relations:
 * @property Beer[] $beers
 * @property Bottle[] $bottles
 * @property Brewery[] $breweries
 * @property Distillery[] $distilleries
 * @property Friend[] $friends
 * @property Friend[] $friends1
 * @property Friendrequest[] $friendrequests
 * @property Friendrequest[] $friendrequests1
 * @property Iso[] $isos
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Offer[] $offers
 * @property Offer[] $offers1
 * @property Review[] $reviews
 * @property Review[] $reviews1
 * @property Trademessage[] $trademessages
 * @property Trademessage[] $trademessages1
 * @property Usertradeinfo[] $usertradeinfos
 * @property Usertradeinfo[] $usertradeinfos1
 * @property Winery[] $wineries
 */
class BaseUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Username, Password, Email, FirstName, LastName, Birthday', 'required'),
			array('Zip, IsActive, IsPrivate, EmailPreferences', 'numerical', 'integerOnly'=>true),
			array('Username', 'length', 'max'=>20),
			array('Password, ForgotPasswordToken', 'length', 'max'=>128),
			array('Email, FirstName, LastName, Address, City, DisplayCity, State, Country', 'length', 'max'=>64),
			array('Links', 'length', 'max'=>300),
			array('About', 'length', 'max'=>500),
			array('ImagePath', 'length', 'max'=>255),
			array('ForgotPasswordTokenExpiration, CreatedTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Username, Password, Email, FirstName, LastName, Birthday, Address, City, DisplayCity, State, Country, Zip, Links, About, ImagePath, IsActive, IsPrivate, EmailPreferences, ForgotPasswordToken, ForgotPasswordTokenExpiration, CreatedTime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'beers' => array(self::HAS_MANY, 'Beer', 'UserAdded'),
			'bottles' => array(self::HAS_MANY, 'Bottle', 'UserID'),
			'breweries' => array(self::HAS_MANY, 'Brewery', 'UserAdded'),
			'distilleries' => array(self::HAS_MANY, 'Distillery', 'UserAdded'),
			'friends' => array(self::HAS_MANY, 'Friend', 'User1'),
			'friends1' => array(self::HAS_MANY, 'Friend', 'User2'),
			'friendrequests' => array(self::HAS_MANY, 'Friendrequest', 'UserTo'),
			'friendrequests1' => array(self::HAS_MANY, 'Friendrequest', 'UserFrom'),
			'isos' => array(self::HAS_MANY, 'Iso', 'UserID'),
			'messages' => array(self::HAS_MANY, 'Message', 'UserTo'),
			'messages1' => array(self::HAS_MANY, 'Message', 'UserFrom'),
			'offers' => array(self::HAS_MANY, 'Offer', 'UserTo'),
			'offers1' => array(self::HAS_MANY, 'Offer', 'UserFrom'),
			'reviews' => array(self::HAS_MANY, 'Review', 'UserTo'),
			'reviews1' => array(self::HAS_MANY, 'Review', 'UserFrom'),
			'trademessages' => array(self::HAS_MANY, 'Trademessage', 'UserTo'),
			'trademessages1' => array(self::HAS_MANY, 'Trademessage', 'UserFrom'),
			'usertradeinfos' => array(self::HAS_MANY, 'Usertradeinfo', 'UserOwnerID'),
			'usertradeinfos1' => array(self::HAS_MANY, 'Usertradeinfo', 'UserOtherID'),
			'wineries' => array(self::HAS_MANY, 'Winery', 'UserAdded'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Username' => 'Username',
			'Password' => 'Password',
			'Email' => 'Email',
			'FirstName' => 'First Name',
			'LastName' => 'Last Name',
			'Birthday' => 'Birthday',
			'Address' => 'Address',
			'City' => 'City',
			'DisplayCity' => 'Display City',
			'State' => 'State',
			'Country' => 'Country',
			'Zip' => 'Zip',
			'Links' => 'Links',
			'About' => 'About',
			'ImagePath' => 'Image Path',
			'IsActive' => 'Is Active',
			'IsPrivate' => 'Is Private',
			'EmailPreferences' => 'Email Preferences',
			'ForgotPasswordToken' => 'Forgot Password Token',
			'ForgotPasswordTokenExpiration' => 'Forgot Password Token Expiration',
			'CreatedTime' => 'Created Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('Birthday',$this->Birthday,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('DisplayCity',$this->DisplayCity,true);
		$criteria->compare('State',$this->State,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('Zip',$this->Zip);
		$criteria->compare('Links',$this->Links,true);
		$criteria->compare('About',$this->About,true);
		$criteria->compare('ImagePath',$this->ImagePath,true);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('IsPrivate',$this->IsPrivate);
		$criteria->compare('EmailPreferences',$this->EmailPreferences);
		$criteria->compare('ForgotPasswordToken',$this->ForgotPasswordToken,true);
		$criteria->compare('ForgotPasswordTokenExpiration',$this->ForgotPasswordTokenExpiration,true);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
