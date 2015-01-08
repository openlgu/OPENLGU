<?php

/**
 * This is the model class for table "tbl_user_account_administers_tbl_request".
 *
 * The followings are the available columns in table 'tbl_user_account_administers_tbl_request':
 * @property string $employee_number
 * @property string $code
 * @property string $service
 * @property string $date
 */
class TblUserAccountAdministersTblRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user_account_administers_tbl_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_number, code, service, date', 'required'),
			array('employee_number', 'length', 'max'=>11),
			array('code', 'length', 'max'=>45),
			array('service', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employee_number, code, service, date', 'safe', 'on'=>'search'),
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
			'employee_number0' => array(self::BELONGS_TO, 'TblUserAccount', 'employee_number'),
			'service0' => array(self::BELONGS_TO, 'TblRequest', 'service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employee_number' => 'Employee Number',
			'code' => 'Code',
			'service' => 'Service',
			'date' => 'Date',
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

		$criteria->compare('employee_number',$this->employee_number,true);

		$criteria->compare('code',$this->code,true);

		$criteria->compare('service',$this->service,true);

		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider('TblUserAccountAdministersTblRequest', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblUserAccountAdministersTblRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}