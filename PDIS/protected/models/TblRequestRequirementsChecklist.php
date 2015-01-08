<?php

/**
 * This is the model class for table "tbl_request_requirements_checklist".
 *
 * The followings are the available columns in table 'tbl_request_requirements_checklist':
 * @property string $code
 * @property string $service
 * @property integer $_number
 * @property string $accomplished
 */
class TblRequestRequirementsChecklist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_request_requirements_checklist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, service, _number', 'required'),
			array('_number', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>45),
			array('service', 'length', 'max'=>100),
			array('accomplished', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, service, _number, accomplished', 'safe', 'on'=>'search'),
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
			'code0' => array(self::BELONGS_TO, 'TblRequest', 'code'),
			'service0' => array(self::BELONGS_TO, 'TblRequest', 'service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => 'Code',
			'service' => 'Service',
			'_number' => 'Number',
			'accomplished' => 'Accomplished',
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

		$criteria->compare('code',$this->code,true);

		$criteria->compare('service',$this->service,true);

		$criteria->compare('_number',$this->_number);

		$criteria->compare('accomplished',$this->accomplished,true);

		return new CActiveDataProvider('TblRequestRequirementsChecklist', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblRequestRequirementsChecklist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/*public static function getDeficiencies($code, $service)
	{
		$deficiencies = array();
		$criteria = new CDbCriteria;
		$criteria->select = '_number';
		$criteria->condition = 'code=:code AND service=:service AND accomplished=:accomplished';
		$criteria->params = array(':code'=>$code, ':service'=>$service,':accomplished' => 0);

		$models = TblRequestRequirementsChecklist::model()->findAll($criteria);
		
		foreach($models as $model)
			$deficiencies[] = $model->_number;
		
		return $deficiencies;
	}*/
	
	public static function getDeficiencies($code, $service)
	{
		$deficiencies = array();
		$criteria = new CDbCriteria;
		$criteria->select = '_number';
		$criteria->condition = 'code=:code AND service=:service AND accomplished=:accomplished';
		$criteria->params = array(':code'=>$code, ':service'=>$service,':accomplished' => 0);

		$models = TblRequestRequirementsChecklist::model()->findAll($criteria);
		
		foreach($models as $model)
			$deficiencies[] = $model->_number;
		//print_r($deficiencies);
		return $deficiencies;
	}
	
	public static function accomplish($service, $code, $num, $val)
	{
		$requirement = TblRequestRequirementsChecklist::model()->findByPk(array('service'=>$service, 'code'=>$code, '_number'=>$num));
		$requirement->accomplished = $val;
		$requirement->update();
		TblRequest::model()->updateStatus($requirement->code,$requirement->service);
	}
}