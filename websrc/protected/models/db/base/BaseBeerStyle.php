<?php

/**
 * This is the model class for table "beerstyle".
 *
 * The followings are the available columns in table 'beerstyle':
 * @property integer $ID
 * @property integer $CategoryID
 * @property string $Name
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property Beer[] $beers
 * @property Beercategory $category
 * @property Iso[] $isos
 */
class BaseBeerStyle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'beerstyle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CategoryID, Name, LastUpdateTime', 'required'),
			array('CategoryID', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, CategoryID, Name, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'beers' => array(self::HAS_MANY, 'Beer', 'StyleID'),
			'category' => array(self::BELONGS_TO, 'Beercategory', 'CategoryID'),
			'isos' => array(self::HAS_MANY, 'Iso', 'BeerStyleID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'CategoryID' => 'Category',
			'Name' => 'Name',
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
		$criteria->compare('CategoryID',$this->CategoryID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('LastUpdateTime',$this->LastUpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseBeerStyle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
