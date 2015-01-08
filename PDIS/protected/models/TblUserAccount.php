<?php

/**
 * This is the model class for table "tbl_user_account".
 *
 * The followings are the available columns in table 'tbl_user_account':
 * @property string $employee_number
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $designation
 * @property integer $sex
 * @property integer $role
 */
class TblUserAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user_account';
	}
	
	public $sex_list=array('Male','Female','Other');

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_number, username, password, email, first_name, last_name, designation, sex', 'required'),
			array('sex, role', 'numerical', 'integerOnly'=>true),
			array('employee_number', 'length', 'max'=>11),
			array('username, email, first_name, middle_name, last_name, designation', 'length', 'max'=>45),
			array('password', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('employee_number, username, email, first_name, middle_name, last_name, designation, sex, role', 'safe', 'on'=>'search'),
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
			//'tbl_user_account_administers_tbl_requests' => array(self::HAS_MANY, 'TblUserAccountAdministersTblRequest', 'employee_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employee_number' => 'Employee Number',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'designation' => 'Designation',
			'sex' => 'Sex',
			'role' => 'Role',
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

		$criteria->compare('employee_number',$this->employee_number,false);

		$criteria->compare('username',$this->username,false);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('first_name',$this->first_name,true);

		$criteria->compare('middle_name',$this->middle_name,true);

		$criteria->compare('last_name',$this->last_name,true);

		$criteria->compare('designation',$this->designation,true);

		$criteria->compare('sex',$this->sex);

		$criteria->compare('role',$this->role);

		return new CActiveDataProvider('TblUserAccount', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblUserAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}