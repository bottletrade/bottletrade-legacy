<?php

/**
 * This is the model class for table "wine".
 *
 * The followings are the available columns in table 'wine':
 * @property integer $ID
 * @property integer $WineryID
 * @property integer $StyleID
 *
 * The followings are the available model relations:
 * @property Bottle[] $bottles
 * @property Iso[] $isos
 * @property Winery $winery
 * @property Winestyle $style
 */
class BaseWine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wine';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WineryID, StyleID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, WineryID, StyleID', 'safe', 'on'=>'search'),
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
			'bottles' => array(self::HAS_MANY, 'Bottle', 'WineID'),
			'isos' => array(self::HAS_MANY, 'Iso', 'WineID'),
			'winery' => array(self::BELONGS_TO, 'Winery', 'WineryID'),
			'style' => array(self::BELONGS_TO, 'Winestyle', 'StyleID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'WineryID' => 'Winery',
			'StyleID' => 'Style',
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
		$criteria->compare('WineryID',$this->WineryID);
		$criteria->compare('StyleID',$this->StyleID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseWine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
