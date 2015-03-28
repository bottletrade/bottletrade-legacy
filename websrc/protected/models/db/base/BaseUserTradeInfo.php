<?php

/**
 * This is the model class for table "usertradeinfo".
 *
 * The followings are the available columns in table 'usertradeinfo':
 * @property integer $ID
 * @property integer $TradeID
 * @property integer $UserOwnerID
 * @property integer $UserOtherID
 * @property integer $Status
 * @property string $ShipDate
 * @property string $CompletedTime
 *
 * The followings are the available model relations:
 * @property Trade $trade
 * @property User $userOwner
 * @property User $userOther
 */
class BaseUserTradeInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usertradeinfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TradeID, UserOwnerID, UserOtherID, Status', 'required'),
			array('TradeID, UserOwnerID, UserOtherID, Status', 'numerical', 'integerOnly'=>true),
			array('ShipDate, CompletedTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, TradeID, UserOwnerID, UserOtherID, Status, ShipDate, CompletedTime', 'safe', 'on'=>'search'),
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
			'trade' => array(self::BELONGS_TO, 'Trade', 'TradeID'),
			'userOwner' => array(self::BELONGS_TO, 'User', 'UserOwnerID'),
			'userOther' => array(self::BELONGS_TO, 'User', 'UserOtherID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'TradeID' => 'Trade',
			'UserOwnerID' => 'User Owner',
			'UserOtherID' => 'User Other',
			'Status' => 'Status',
			'ShipDate' => 'Ship Date',
			'CompletedTime' => 'Completed Time',
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
		$criteria->compare('TradeID',$this->TradeID);
		$criteria->compare('UserOwnerID',$this->UserOwnerID);
		$criteria->compare('UserOtherID',$this->UserOtherID);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('ShipDate',$this->ShipDate,true);
		$criteria->compare('CompletedTime',$this->CompletedTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseUserTradeInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
