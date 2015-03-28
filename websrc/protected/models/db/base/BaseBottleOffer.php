<?php

/**
 * This is the model class for table "bottleoffer".
 *
 * The followings are the available columns in table 'bottleoffer':
 * @property integer $ID
 * @property integer $OfferID
 * @property integer $BottleID
 * @property integer $Quantity
 *
 * The followings are the available model relations:
 * @property Offer $offer
 * @property Bottle $bottle
 */
class BaseBottleOffer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseBottleOffer the static model class
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
		return 'bottleoffer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OfferID, BottleID, Quantity', 'required'),
			array('OfferID, BottleID, Quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OfferID, BottleID, Quantity', 'safe', 'on'=>'search'),
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
			'offer' => array(self::BELONGS_TO, 'Offer', 'OfferID'),
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
			'OfferID' => 'Offer',
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
		$criteria->compare('OfferID',$this->OfferID);
		$criteria->compare('BottleID',$this->BottleID);
		$criteria->compare('Quantity',$this->Quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}