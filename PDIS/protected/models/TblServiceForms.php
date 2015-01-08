<?php

/**
 * This is the model class for table "tbl_service_forms".
 *
 * The followings are the available columns in table 'tbl_service_forms':
 * @property string $service
 * @property string $name
 * @property string $filename
 * @property string $extension
 * @property string $isonline
 */
class TblServiceForms extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_service_forms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service, name, filename, extension', 'required'),
			array('service', 'length', 'max'=>100),
			array('name, filename', 'length', 'max'=>200),
			array('extension', 'length', 'max'=>5),
			array('isonline', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service, name, filename, extension, isonline', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'filename' => 'Filename',
			'extension' => 'Extension',
			'isonline' => 'Isonline',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('filename',$this->filename,true);

		$criteria->compare('extension',$this->extension,true);

		$criteria->compare('isonline',$this->isonline,true);

		return new CActiveDataProvider('TblServiceForms', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblServiceForms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}