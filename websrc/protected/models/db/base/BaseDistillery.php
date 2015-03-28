<?php

/**
 * This is the model class for table "distillery".
 *
 * The followings are the available columns in table 'distillery':
 * @property integer $ID
 * @property string $Name
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property string $State
 * @property string $Code
 * @property string $Country
 * @property string $Phone
 * @property string $Established
 * @property string $Website
 * @property string $ImagePath
 * @property string $Description
 * @property integer $UserAdded
 * @property string $CreatedTime
 * @property string $LastUpdateTime
 *
 * The followings are the available model relations:
 * @property User $userAdded
 * @property Iso[] $isos
 * @property Spirit[] $spirits
 */
class BaseDistillery extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'distillery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, CreatedTime, LastUpdateTime', 'required'),
			array('UserAdded', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>60),
			array('Address1, Address2, City, State, Country', 'length', 'max'=>64),
			array('Code', 'length', 'max'=>25),
			array('Phone', 'length', 'max'=>48),
			array('Website, ImagePath', 'length', 'max'=>255),
			array('Established, Description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Name, Address1, Address2, City, State, Code, Country, Phone, Established, Website, ImagePath, Description, UserAdded, CreatedTime, LastUpdateTime', 'safe', 'on'=>'search'),
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
			'userAdded' => array(self::BELONGS_TO, 'User', 'UserAdded'),
			'isos' => array(self::HAS_MANY, 'Iso', 'DistilleryID'),
			'spirits' => array(self::HAS_MANY, 'Spirit', 'DistilleryID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => 'Name',
			'Address1' => 'Address1',
			'Address2' => 'Address2',
			'City' => 'City',
			'State' => 'State',
			'Code' => 'Code',
			'Country' => 'Country',
			'Phone' => 'Phone',
			'Established' => 'Established',
			'Website' => 'Website',
			'ImagePath' => 'Image Path',
			'Description' => 'Description',
			'UserAdded' => 'User Added',
			'CreatedTime' => 'Created Time',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Address1',$this->Address1,true);
		$criteria->compare('Address2',$this->Address2,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('State',$this->State,true);
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Established',$this->Established,true);
		$criteria->compare('Website',$this->Website,true);
		$criteria->compare('ImagePath',$this->ImagePath,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('UserAdded',$this->UserAdded);
		$criteria->compare('CreatedTime',$this->CreatedTime,true);
		$criteria->compare('LastUpdateTime',$this->LastUpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseDistillery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
