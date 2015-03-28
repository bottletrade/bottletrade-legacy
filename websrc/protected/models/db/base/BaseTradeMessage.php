<?php

/**
 * This is the model class for table "trademessage".
 *
 * The followings are the available columns in table 'trademessage':
 * @property integer $ID
 * @property integer $UserTo
 * @property integer $UserFrom
 * @property string $Body
 * @property integer $IsRead
 * @property integer $TradeID
 * @property string $SentTime
 *
 * The followings are the available model relations:
 * @property User $userTo
 * @property User $userFrom
 * @property Trade $trade
 */
class BaseTradeMessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseTradeMessage the static model class
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
		return 'trademessage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserTo, UserFrom, Body, TradeID, SentTime', 'required'),
			array('UserTo, UserFrom, IsRead, TradeID', 'numerical', 'integerOnly'=>true),
			array('Body', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserTo, UserFrom, Body, IsRead, TradeID, SentTime', 'safe', 'on'=>'search'),
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
			'userTo' => array(self::BELONGS_TO, 'User', 'UserTo'),
			'userFrom' => array(self::BELONGS_TO, 'User', 'UserFrom'),
			'trade' => array(self::BELONGS_TO, 'Trade', 'TradeID'),
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
			'Body' => 'Body',
			'IsRead' => 'Is Read',
			'TradeID' => 'Trade',
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
		$criteria->compare('Body',$this->Body,true);
		$criteria->compare('IsRead',$this->IsRead);
		$criteria->compare('TradeID',$this->TradeID);
		$criteria->compare('SentTime',$this->SentTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}