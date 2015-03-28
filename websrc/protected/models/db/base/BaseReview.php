<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $ID
 * @property integer $TradeID
 * @property integer $UserTo
 * @property integer $UserFrom
 * @property integer $Rating
 * @property string $Message
 *
 * The followings are the available model relations:
 * @property Trade $trade
 * @property User $userTo
 * @property User $userFrom
 */
class BaseReview extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TradeID, UserTo, UserFrom, Rating, Message', 'required'),
			array('TradeID, UserTo, UserFrom, Rating', 'numerical', 'integerOnly'=>true),
			array('Message', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, TradeID, UserTo, UserFrom, Rating, Message', 'safe', 'on'=>'search'),
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
			'trade' => array(self::BELONGS_TO, 'Trade', 'TradeID'),
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
			'TradeID' => 'Trade',
			'UserTo' => 'User To',
			'UserFrom' => 'User From',
			'Rating' => 'Rating',
			'Message' => 'Message',
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
		$criteria->compare('TradeID',$this->TradeID);
		$criteria->compare('UserTo',$this->UserTo);
		$criteria->compare('UserFrom',$this->UserFrom);
		$criteria->compare('Rating',$this->Rating);
		$criteria->compare('Message',$this->Message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseReview the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
