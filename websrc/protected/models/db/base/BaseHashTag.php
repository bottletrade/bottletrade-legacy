<?php

/**
 * This is the model class for table "hashtag".
 *
 * The followings are the available columns in table 'hashtag':
 * @property integer $ID
 * @property string $Tag
 * @property integer $BottleID
 * @property string $SentTime
 *
 * The followings are the available model relations:
 * @property Bottle $bottle
 */
class BaseHashTag extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hashtag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Tag, SentTime', 'required'),
			array('BottleID', 'numerical', 'integerOnly'=>true),
			array('Tag', 'length', 'max'=>60),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Tag, BottleID, SentTime', 'safe', 'on'=>'search'),
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
			'Tag' => 'Tag',
			'BottleID' => 'Bottle',
			'SentTime' => 'Sent Time',
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
		$criteria->compare('Tag',$this->Tag,true);
		$criteria->compare('BottleID',$this->BottleID);
		$criteria->compare('SentTime',$this->SentTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseHashTag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
