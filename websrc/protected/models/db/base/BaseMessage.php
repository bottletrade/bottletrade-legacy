<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $ID
 * @property integer $UserTo
 * @property integer $UserFrom
 * @property string $Subject
 * @property string $Body
 * @property integer $IsRead
 * @property integer $IsLeaf
 * @property string $SentTime
 * @property integer $DeletedBySender
 * @property integer $DeletedByReceiver
 *
 * The followings are the available model relations:
 * @property User $userTo
 * @property User $userFrom
 */
class BaseMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserTo, UserFrom, Subject, Body, IsRead, IsLeaf, SentTime, DeletedBySender, DeletedByReceiver', 'required'),
			array('UserTo, UserFrom, IsRead, IsLeaf, DeletedBySender, DeletedByReceiver', 'numerical', 'integerOnly'=>true),
			array('Subject', 'length', 'max'=>60),
			array('Body', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, UserTo, UserFrom, Subject, Body, IsRead, IsLeaf, SentTime, DeletedBySender, DeletedByReceiver', 'safe', 'on'=>'search'),
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
			'Subject' => 'Subject',
			'Body' => 'Body',
			'IsRead' => 'Is Read',
			'IsLeaf' => 'Is Leaf',
			'SentTime' => 'Sent Time',
			'DeletedBySender' => 'Deleted By Sender',
			'DeletedByReceiver' => 'Deleted By Receiver',
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
		$criteria->compare('UserTo',$this->UserTo);
		$criteria->compare('UserFrom',$this->UserFrom);
		$criteria->compare('Subject',$this->Subject,true);
		$criteria->compare('Body',$this->Body,true);
		$criteria->compare('IsRead',$this->IsRead);
		$criteria->compare('IsLeaf',$this->IsLeaf);
		$criteria->compare('SentTime',$this->SentTime,true);
		$criteria->compare('DeletedBySender',$this->DeletedBySender);
		$criteria->compare('DeletedByReceiver',$this->DeletedByReceiver);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
