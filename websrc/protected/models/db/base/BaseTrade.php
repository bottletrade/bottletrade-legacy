<?php

/**
 * This is the model class for table "trade".
 *
 * The followings are the available columns in table 'trade':
 * @property integer $ID
 * @property integer $Status
 * @property string $CreatedTime
 * @property string $CompletedTime
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property Bottletrade[] $bottletrades
 * @property Review[] $reviews
 * @property Trademessage[] $trademessages
 * @property Usertradeinfo[] $usertradeinfos
 */
class BaseTrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseTrade the static model class
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
		return 'trade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Status, CreatedTime, LastUpdateTime', 'required'),
			array('Status', 'numerical', 'integerOnly'=>true),
			array('CompletedTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Status, CreatedTime, CompletedTime, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'bottletrades' => array(self::HAS_MANY, 'Bottletrade', 'TradeID'),
			'reviews' => array(self::HAS_MANY, 'Review', 'TradeID'),
			'trademessages' => array(self::HAS_MANY, 'Trademessage', 'TradeID'),
			'usertradeinfos' => array(self::HAS_MANY, 'Usertradeinfo', 'TradeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Status' => 'Status',
			'CreatedTime' => 'Created Time',
			'CompletedTime' => 'Completed Time',
			'LastUpdateTime' => 'Last Update Time',
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
		$criteria->compare('Status',$this->Status);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);
		$criteria->compare('CompletedTime',$this->CompletedTime,true);
		$criteria->compare('LastUpdateTime',$this->LastUpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}