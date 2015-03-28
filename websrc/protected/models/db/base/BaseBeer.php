<?php

/**
 * This is the model class for table "beer".
 *
 * The followings are the available columns in table 'beer':
 * @property integer $ID
 * @property integer $BreweryID
 * @property string $Name
 * @property integer $StyleID
 * @property double $ABV
 * @property double $IBU
 * @property double $SRM
 * @property integer $UPC
 * @property string $Availability
 * @property string $ImagePath
 * @property string $Description
 * @property integer $UserAdded
 * @property string $CreatedTime
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property Brewery $brewery
 * @property Beerstyle $style
 * @property User $userAdded
 * @property Bottle[] $bottles
 * @property Iso[] $isos
 */
class BaseBeer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, CreatedTime, LastUpdateTime', 'required'),
			array('BreweryID, StyleID, UPC, UserAdded', 'numerical', 'integerOnly'=>true),
			array('ABV, IBU, SRM', 'numerical'),
			array('Name', 'length', 'max'=>60),
			array('Availability', 'length', 'max'=>63),
			array('ImagePath', 'length', 'max'=>255),
			array('Description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BreweryID, Name, StyleID, ABV, IBU, SRM, UPC, Availability, ImagePath, Description, UserAdded, CreatedTime, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'brewery' => array(self::BELONGS_TO, 'Brewery', 'BreweryID'),
			'style' => array(self::BELONGS_TO, 'Beerstyle', 'StyleID'),
			'userAdded' => array(self::BELONGS_TO, 'User', 'UserAdded'),
			'bottles' => array(self::HAS_MANY, 'Bottle', 'BeerID'),
			'isos' => array(self::HAS_MANY, 'Iso', 'BeerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BreweryID' => 'Brewery',
			'Name' => 'Name',
			'StyleID' => 'Style',
			'ABV' => 'Abv',
			'IBU' => 'Ibu',
			'SRM' => 'Srm',
			'UPC' => 'Upc',
			'Availability' => 'Availability',
			'ImagePath' => 'Image Path',
			'Description' => 'Description',
			'UserAdded' => 'User Added',
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
		$criteria->compare('BreweryID',$this->BreweryID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('StyleID',$this->StyleID);
		$criteria->compare('ABV',$this->ABV);
		$criteria->compare('IBU',$this->IBU);
		$criteria->compare('SRM',$this->SRM);
		$criteria->compare('UPC',$this->UPC);
		$criteria->compare('Availability',$this->Availability,true);
		$criteria->compare('ImagePath',$this->ImagePath,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('UserAdded',$this->UserAdded);
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
	 * @return BaseBeer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
