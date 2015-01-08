<?php

/**
 * This is the model class for table "tbl_service_requirements".
 *
 * The followings are the available columns in table 'tbl_service_requirements':
 * @property string $service
 * @property string $requirement
 * @property integer $number
 * @property string $optional
 */
class TblServiceRequirements extends CActiveRecord
{
	protected $max_number;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_service_requirements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service, requirement, number', 'required'),
			array('number', 'numerical', 'integerOnly'=>true),
			array('service', 'length', 'max'=>100),
			array('requirement', 'length', 'max'=>300),
			array('optional', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service, requirement, number, optional', 'safe', 'on'=>'search'),
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
			'service0' => array(self::BELONGS_TO, 'TblService', 'service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service' => 'Service',
			'requirement' => 'Requirement',
			'number' => 'Number',
			'optional' => 'Optional',
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('service',$this->service,true);

		$criteria->compare('requirement',$this->requirement,true);

		$criteria->compare('number',$this->number);

		$criteria->compare('optional',$this->optional,true);

		return new CActiveDataProvider('TblServiceRequirements', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblServiceRequirements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getRequirements($service)
	{
		$criteria = new CDbCriteria;
		$criteria->select = '_number, requirement';
		$criteria->order = '_number';
		$criteria->condition = 'service=:service';
		$criteria->params = array(':service'=>$service);
		
		$models = TblServiceRequirements::model()->findAll($criteria);
		
		return $models;
	}
	
	public static function getRequirement($service,$num)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'requirement';
		$criteria->condition = 'service=:service AND _number=:num';
		$criteria->params = array(':service'=>$service,':num'=>$num);
		
		$model = TblServiceRequirements::model()->find($criteria);
		
		return $model->requirement;
	}
	
	public static function getNumberOfRequirements($service)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'max(_number) AS max_number';
		$criteria->condition = 'service=:service';
		$criteria->params = array(':service'=>$service);
		
		$model = TblServiceRequirements::model()->find($criteria);
		
		return $model->max_number;
	}
}