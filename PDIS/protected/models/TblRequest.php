<?php

/**
 * This is the model class for table "tbl_request".
 *
 * The followings are the available columns in table 'tbl_request':
 * @property string $code
 * @property string $service
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $mailing_address
 * @property string $email
 * @property string $company_name
 * @property string $company_address
 * @property string $designation
 * @property integer $status
 * @property string $remarks
 */
class TblRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, service, first_name, last_name, mailing_address', 'required'),
			array('email', 'email'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code, first_name, middle_name, last_name, email', 'length', 'max'=>45),
			array('service', 'length', 'max'=>100),
			array('company_name', 'length', 'max'=>300),
			array('designation', 'length', 'max'=>200),
			array('company_address, remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('code, service, first_name, middle_name, last_name, mailing_address, email, company_name, company_address, designation, status, remarks', 'safe', 'on'=>'search'),
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
			'tbl_request_fees_checklists' => array(self::HAS_MANY, 'TblRequestFeesChecklist', 'service'),
			'tbl_request_requirements_checklists' => array(self::HAS_MANY, 'TblRequestRequirementsChecklist', 'service'),
			'tbl_user_account_administers_tbl_requests' => array(self::HAS_MANY, 'TblUserAccountAdministersTblRequest', 'service'),
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
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'mailing_address' => 'Mailing Address',
			'email' => 'Email',
			'company_name' => 'Company/ Agency Name',
			'company_address' => 'Company/ Agency Address',
			'designation' => 'Designation',
			'status' => 'Status',
			'remarks' => 'Remarks',
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

		$criteria->compare('code',$this->code,false);

		$criteria->compare('service',$this->service,true);

		$criteria->compare('first_name',$this->first_name,true);

		$criteria->compare('middle_name',$this->middle_name,true);

		$criteria->compare('last_name',$this->last_name,true);

		$criteria->compare('mailing_address',$this->mailing_address,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('company_name',$this->company_name,true);

		$criteria->compare('company_address',$this->company_address,true);

		$criteria->compare('designation',$this->designation,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider('TblRequest', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function updateStatus($code, $service){
		$request = TblRequest::model()->findByPk(array('code'=>$code,'service'=>$service));
		/*if($request->status==4)
			if(!TblRequestRequirementsChecklist::model()->getDeficiencies($code,$service))
				$request->status = 3;
		else if($request->status==2)
			if(!TblRequestFeesChecklist::model()->getDeficiencies($code,$service))
				$request->status = 2;*/
		if($request->status==2){
			if(!TblRequestFeesChecklist::model()->getDeficiencies($code,$service))
				$request->status = 2;
		}else if($request->status==3 || $request->status==4){
			if(!TblRequestRequirementsChecklist::model()->getDeficiencies($code,$service))
				$request->status = 3;
			else
				$request->status = 4;
		}
		$request->update();
	}
	
	protected function beforeDelete()
	{
		$models = TblRequestFiles::model()->findAllByAttributes(array('service'=>$this->service, 'code'=>$this->code));
		foreach($models as $model)
			$model->delete();
		$models = TblRequestRequirementsChecklist::model()->findAllByAttributes(array('service'=>$this->service, 'code'=>$this->code));
		foreach($models as $model)
			$model->delete();
		$models = TblRequestFeesChecklist::model()->findAllByAttributes(array('service'=>$this->service, 'code'=>$this->code));
		foreach($models as $model)
			$model->delete();
		return true;
	}
}