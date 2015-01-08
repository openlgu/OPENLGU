<?php

/**
 * This is the model class for table "tbl_service".
 *
 * The followings are the available columns in table 'tbl_service':
 * @property string $service
 * @property string $title
 * @property string $availability
 * @property string $customers
 */
class TblService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service, title, availability, customers', 'required'),
			array('service', 'length', 'max'=>100),
			array('title', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service, title, availability, customers', 'safe', 'on'=>'search'),
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
			'tbl_requests' => array(self::HAS_MANY, 'TblRequest', 'service'),
			'tbl_service_fees' => array(self::HAS_MANY, 'TblServiceFees', 'service'),
			'tbl_service_requirements' => array(self::HAS_MANY, 'TblServiceRequirements', 'service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service' => 'Shorthand Name (Database Key)',
			'title' => 'Service',
			'availability' => 'Schedule of Availability of Service',
			'customers' => 'Who May Avail of Service',
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

		$criteria->compare('title',$this->title,true);

		$criteria->compare('availability',$this->availability,true);

		$criteria->compare('customers',$this->customers,true);

		return new CActiveDataProvider('TblService', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getItems()
	{
		$items = array();
		$criteria = new CDbCriteria;
		$criteria->select = array('service');
		$models = TblService::model()->findAll($criteria);

		foreach($models as $model)
			$items[]= array('label' => $model->service, 'url' => array('/tblService/view', 'id'=>$model->service));

		return $items;
	}
	
	public static function getTitle($service)
	{
		$model = TblService::model()->findByPk($service);

		return $model->title;
	}
}