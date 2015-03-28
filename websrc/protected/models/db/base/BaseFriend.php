<?php

/**
 * This is the model class for table "friend".
 *
 * The followings are the available columns in table 'friend':
 * @property integer $ID
 * @property integer $User1
 * @property integer $User2
 * @property string $CreatedTime
 *
 * The followings are the available model relations:
 * @property User $user1
 * @property User $user2
 */
class BaseFriend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BaseFriend the static model class
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
		return 'friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User1, User2, CreatedTime', 'required'),
			array('User1, User2', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, User1, User2, CreatedTime', 'safe', 'on'=>'search'),
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
			'user1' => array(self::BELONGS_TO, 'User', 'User1'),
			'user2' => array(self::BELONGS_TO, 'User', 'User2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'User1' => 'User1',
			'User2' => 'User2',
			'CreatedTime' => 'Created Time',
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
		$criteria->compare('User1',$this->User1);
		$criteria->compare('User2',$this->User2);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}