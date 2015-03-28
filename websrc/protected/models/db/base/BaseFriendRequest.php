<?php

/**
 * This is the model class for table "friendrequest".
 *
 * The followings are the available columns in table 'friendrequest':
 * @property integer $ID
 * @property integer $UserTo
 * @property integer $UserFrom
 * @property string $SentTime
 *
 * The followings are the available model relations:
 * @property User $userTo
 * @property User $userFrom
 */
class BaseFriendRequest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseFriendRequest the static model class
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
		return 'friendrequest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserTo, UserFrom, SentTime', 'required'),
			array('UserTo, UserFrom', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserTo, UserFrom, SentTime', 'safe', 'on'=>'search'),
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
			'userTo' => array(self::BELONGS_TO, 'User', 'UserTo'),
			'userFrom' => array(self::BELONGS_TO, 'User', 'UserFrom'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserTo' => 'User To',
			'UserFrom' => 'User From',
			'SentTime' => 'Sent Time',
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
		$criteria->compare('UserTo',$this->UserTo);
		$criteria->compare('UserFrom',$this->UserFrom);
		$criteria->compare('SentTime',$this->SentTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}