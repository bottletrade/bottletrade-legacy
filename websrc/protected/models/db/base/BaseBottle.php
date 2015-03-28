<?php

/**
 * This is the model class for table "bottle".
 *
 * The followings are the available columns in table 'bottle':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $BeerID
 * @property integer $WineID
 * @property integer $SpiritID
 * @property integer $Quantity
 * @property string $FluidAmount
 * @property string $BottledOnDate
 * @property string $Description
 * @property double $PurchasePrice
 * @property integer $IsTradeable
 * @property integer $IsPrivate
 * @property integer $IsSearchable
 * @property integer $IsActive
 * @property string $ImagePath
 * @property string $CreatedTime
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Beer $beer
 * @property Wine $wine
 * @property Spirit $spirit
 * @property Bottleoffer[] $bottleoffers
 * @property Bottletrade[] $bottletrades
 * @property Hashtag[] $hashtags
 */
class BaseBottle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bottle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, Quantity, FluidAmount, BottledOnDate, IsTradeable, IsPrivate, IsSearchable, IsActive, CreatedTime, LastUpdateTime', 'required'),
			array('UserID, BeerID, WineID, SpiritID, Quantity, IsTradeable, IsPrivate, IsSearchable, IsActive', 'numerical', 'integerOnly'=>true),
			array('PurchasePrice', 'numerical'),
			array('FluidAmount', 'length', 'max'=>20),
			array('Description', 'length', 'max'=>1000),
			array('ImagePath', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, UserID, BeerID, WineID, SpiritID, Quantity, FluidAmount, BottledOnDate, Description, PurchasePrice, IsTradeable, IsPrivate, IsSearchable, IsActive, ImagePath, CreatedTime, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'beer' => array(self::BELONGS_TO, 'Beer', 'BeerID'),
			'wine' => array(self::BELONGS_TO, 'Wine', 'WineID'),
			'spirit' => array(self::BELONGS_TO, 'Spirit', 'SpiritID'),
			'bottleoffers' => array(self::HAS_MANY, 'Bottleoffer', 'BottleID'),
			'bottletrades' => array(self::HAS_MANY, 'Bottletrade', 'BottleID'),
			'hashtags' => array(self::HAS_MANY, 'Hashtag', 'BottleID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserID' => 'User',
			'BeerID' => 'Beer',
			'WineID' => 'Wine',
			'SpiritID' => 'Spirit',
			'Quantity' => 'Quantity',
			'FluidAmount' => 'Fluid Amount',
			'BottledOnDate' => 'Bottled On Date',
			'Description' => 'Description',
			'PurchasePrice' => 'Purchase Price',
			'IsTradeable' => 'Is Tradeable',
			'IsPrivate' => 'Is Private',
			'IsSearchable' => 'Is Searchable',
			'IsActive' => 'Is Active',
			'ImagePath' => 'Image Path',
			'CreatedTime' => 'Created Time',
			'LastUpdateTime' => 'Last Update Time',
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
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('BeerID',$this->BeerID);
		$criteria->compare('WineID',$this->WineID);
		$criteria->compare('SpiritID',$this->SpiritID);
		$criteria->compare('Quantity',$this->Quantity);
		$criteria->compare('FluidAmount',$this->FluidAmount,true);
		$criteria->compare('BottledOnDate',$this->BottledOnDate,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('PurchasePrice',$this->PurchasePrice);
		$criteria->compare('IsTradeable',$this->IsTradeable);
		$criteria->compare('IsPrivate',$this->IsPrivate);
		$criteria->compare('IsSearchable',$this->IsSearchable);
		$criteria->compare('IsActive',$this->IsActive);
		$criteria->compare('ImagePath',$this->ImagePath,true);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);
		$criteria->compare('LastUpdateTime',$this->LastUpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseBottle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
