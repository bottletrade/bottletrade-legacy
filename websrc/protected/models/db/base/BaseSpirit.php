<?php

/**
 * This is the model class for table "spirit".
 *
 * The followings are the available columns in table 'spirit':
 * @property integer $ID
 * @property integer $DistilleryID
 * @property integer $StyleID
 *
 * The followings are the available model relations:
 * @property Bottle[] $bottles
 * @property Iso[] $isos
 * @property Distillery $distillery
 * @property Spiritstyle $style
 */
class BaseSpirit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spirit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DistilleryID, StyleID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, DistilleryID, StyleID', 'safe', 'on'=>'search'),
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
			'bottles' => array(self::HAS_MANY, 'Bottle', 'SpiritID'),
			'isos' => array(self::HAS_MANY, 'Iso', 'SpiritID'),
			'distillery' => array(self::BELONGS_TO, 'Distillery', 'DistilleryID'),
			'style' => array(self::BELONGS_TO, 'Spiritstyle', 'StyleID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'DistilleryID' => 'Distillery',
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
		$criteria->compare('DistilleryID',$this->DistilleryID);
		$criteria->compare('StyleID',$this->StyleID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseSpirit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
