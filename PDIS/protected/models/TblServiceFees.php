<?php

/**
 * This is the model class for table "tbl_service_fees".
 *
 * The followings are the available columns in table 'tbl_service_fees':
 * @property string $service
 * @property string $fee
 * @property integer $number
 */
class TblServiceFees extends CActiveRecord
{
	protected $max_number;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_service_fees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service, fee, number', 'required'),
			array('number', 'numerical', 'integerOnly'=>true),
			array('service', 'length', 'max'=>100),
			array('fee', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service, fee, number', 'safe', 'on'=>'search'),
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
			'fee' => 'Fee',
			'number' => 'Number',
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

		$criteria->compare('fee',$this->fee,true);

		$criteria->compare('number',$this->number);

		return new CActiveDataProvider('TblServiceFees', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblServiceFees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getFees($service)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'fee';
		$criteria->order = '_number';
		$criteria->condition = 'service=:service';
		$criteria->params = array(':service'=>$service);
		
		$models = TblServiceFees::model()->findAll($criteria);
		
		return $models;
	}
	
	public static function getFee($num)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'fee';
		$criteria->condition = '_number=:num';
		$criteria->params = array(':num'=>$num);
		
		$model = TblServiceFees::model()->find($criteria);
		
		return $model->fee;
	}
	
	public static function getNumberOfFees($service)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'max(_number) AS max_number';
		$criteria->condition = 'service=:service';
		$criteria->params = array(':service'=>$service);
		
		$model = TblServiceFees::model()->find($criteria);
		
		return $model->max_number;
	}
}