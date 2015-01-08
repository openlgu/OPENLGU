<?php

/**
 * This is the model class for table "tbl_request_files".
 *
 * The followings are the available columns in table 'tbl_request_files':
 * @property string $service
 * @property string $code
 * @property string $filename
 * @property integer $_number
 * @property string $extension
 */
class TblRequestFiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_request_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service, code, filename, _number, extension', 'required'),
			array('_number', 'numerical', 'integerOnly'=>true),
			array('service', 'length', 'max'=>100),
			array('code', 'length', 'max'=>45),
			array('filename', 'length', 'max'=>200),
			array('extension', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('service, code, filename, _number, extension', 'safe', 'on'=>'search'),
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
			'service0' => array(self::BELONGS_TO, 'TblRequest', 'service'),
			'code0' => array(self::BELONGS_TO, 'TblRequest', 'code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'service' => 'Service',
			'code' => 'Code',
			'filename' => 'Filename',
			'_number' => 'Number',
			'extension' => 'Extension',
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

		$criteria->compare('code',$this->code,true);

		$criteria->compare('filename',$this->filename,true);

		$criteria->compare('_number',$this->_number);

		$criteria->compare('extension',$this->extension,true);

		return new CActiveDataProvider('TblRequestFiles', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return TblRequestFiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getFiles($code, $service)
	{
		$files = array();
		$criteria = new CDbCriteria;
		$criteria->select = '_number';
		$criteria->condition = 'code=:code AND service=:service';
		$criteria->params = array(':code'=>$code, ':service'=>$service);

		$models = TblRequestFiles::model()->findAll($criteria);
		
		foreach($models as $model)
			$files[] = $model->_number;
		
		return $files;
	}
}