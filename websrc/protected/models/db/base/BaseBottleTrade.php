<?php

/**
 * This is the model class for table "bottletrade".
 *
 * The followings are the available columns in table 'bottletrade':
 * @property integer $ID
 * @property integer $TradeID
 * @property integer $BottleID
 * @property integer $Quantity
 *
 * The followings are the available model relations:
 * @property Trade $trade
 * @property Bottle $bottle
 */
class BaseBottleTrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseBottleTrade the static model class
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
		return 'bottletrade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TradeID, BottleID, Quantity', 'required'),
			array('TradeID, BottleID, Quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TradeID, BottleID, Quantity', 'safe', 'on'=>'search'),
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
			'bottle' => array(self::BELONGS_TO, 'Bottle', 'BottleID'),
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
			'BottleID' => 'Bottle',
			'Quantity' => 'Quantity',
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
		$criteria->compare('TradeID',$this->TradeID);
		$criteria->compare('BottleID',$this->BottleID);
		$criteria->compare('Quantity',$this->Quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}