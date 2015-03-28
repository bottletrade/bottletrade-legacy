<?php

/**
 * This is the model class for table "offer".
 *
 * The followings are the available columns in table 'offer':
 * @property integer $ID
 * @property integer $UserTo
 * @property integer $UserFrom
 * @property string $Message
 * @property integer $IsRead
 * @property string $SentTime
 *
 * The followings are the available model relations:
 * @property Bottleoffer[] $bottleoffers
 * @property User $userTo
 * @property User $userFrom
 */
class BaseOffer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseOffer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserTo, UserFrom', 'required'),
			array('UserTo, UserFrom, IsRead', 'numerical', 'integerOnly'=>true),
			array('Message', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserTo, UserFrom, Message, IsRead, SentTime', 'safe', 'on'=>'search'),
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
			'bottleoffers' => array(self::HAS_MANY, 'Bottleoffer', 'OfferID'),
			'userTo' => array(self::BELONGS_TO, 'User', 'UserTo'),
			'userFrom' => array(self::BELONGS_TO, 'User', 'UserFrom'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserTo' => 'User To',
			'UserFrom' => 'User From',
			'Message' => 'Message',
			'IsRead' => 'Is Read',
			'SentTime' => 'Sent Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('UserTo',$this->UserTo);
		$criteria->compare('UserFrom',$this->UserFrom);
		$criteria->compare('Message',$this->Message,true);
		$criteria->compare('IsRead',$this->IsRead);
		$criteria->compare('SentTime',$this->SentTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}