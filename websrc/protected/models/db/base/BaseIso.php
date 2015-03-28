<?php

/**
 * This is the model class for table "iso".
 *
 * The followings are the available columns in table 'iso':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $BeerID
 * @property integer $BreweryID
 * @property integer $BeerStyleID
 * @property integer $WineID
 * @property integer $WineryID
 * @property integer $WineStyleID
 * @property integer $SpiritID
 * @property integer $DistilleryID
 * @property integer $SpiritStyleID
 * @property string $CreatedTime
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Beer $beer
 * @property Brewery $brewery
 * @property Beerstyle $beerStyle
 * @property Wine $wine
 * @property Winery $winery
 * @property Winestyle $wineStyle
 * @property Spirit $spirit
 * @property Distillery $distillery
 * @property Spiritstyle $spiritStyle
 */
class BaseIso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, CreatedTime', 'required'),
			array('UserID, BeerID, BreweryID, BeerStyleID, WineID, WineryID, WineStyleID, SpiritID, DistilleryID, SpiritStyleID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, UserID, BeerID, BreweryID, BeerStyleID, WineID, WineryID, WineStyleID, SpiritID, DistilleryID, SpiritStyleID, CreatedTime', 'safe', 'on'=>'search'),
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
			'brewery' => array(self::BELONGS_TO, 'Brewery', 'BreweryID'),
			'beerStyle' => array(self::BELONGS_TO, 'Beerstyle', 'BeerStyleID'),
			'wine' => array(self::BELONGS_TO, 'Wine', 'WineID'),
			'winery' => array(self::BELONGS_TO, 'Winery', 'WineryID'),
			'wineStyle' => array(self::BELONGS_TO, 'Winestyle', 'WineStyleID'),
			'spirit' => array(self::BELONGS_TO, 'Spirit', 'SpiritID'),
			'distillery' => array(self::BELONGS_TO, 'Distillery', 'DistilleryID'),
			'spiritStyle' => array(self::BELONGS_TO, 'Spiritstyle', 'SpiritStyleID'),
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
			'BreweryID' => 'Brewery',
			'BeerStyleID' => 'Beer Style',
			'WineID' => 'Wine',
			'WineryID' => 'Winery',
			'WineStyleID' => 'Wine Style',
			'SpiritID' => 'Spirit',
			'DistilleryID' => 'Distillery',
			'SpiritStyleID' => 'Spirit Style',
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
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('BeerID',$this->BeerID);
		$criteria->compare('BreweryID',$this->BreweryID);
		$criteria->compare('BeerStyleID',$this->BeerStyleID);
		$criteria->compare('WineID',$this->WineID);
		$criteria->compare('WineryID',$this->WineryID);
		$criteria->compare('WineStyleID',$this->WineStyleID);
		$criteria->compare('SpiritID',$this->SpiritID);
		$criteria->compare('DistilleryID',$this->DistilleryID);
		$criteria->compare('SpiritStyleID',$this->SpiritStyleID);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseIso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
