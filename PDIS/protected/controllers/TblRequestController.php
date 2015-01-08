<?php

class TblRequestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/service_layout', meaning
	 * using two-column layout. See 'protected/views/layouts/service_layout.php'.
	 */
	public $layout='//layouts/service_layout';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','success'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'manage', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->layout='//layouts/layout';
		$model = $this->loadModel();
		if(isset($_POST['TblRequest'])){
			$model->attributes = $_POST['TblRequest'];
			$model->update();
		}
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function displayStatus($status)
	{
		$displayStatus = array(
			'Approved (Documents are Available for Release)',
			'Pending (Document Validation, MPDC/ Deputized Zoning Administrator)',
			'Pending (Deficiency: Fee/s)',
			'Pending (Submitted Documents for Verification)',
			'Pending (Deficiency: Requirement/s)',
		);
		
		return $displayStatus[$status];
	}
	
	public function actionManage()
	{
		$this->layout = '//layouts/layout';
		$model = new TblRequest('search');
        $model->unsetAttributes();
        if(isset($_GET['TblRequest']))
            $model->attributes=$_GET['TblRequest'];
		$this->render('requests',array('model'=>$model));
	}
	
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionCreate()
	{
		if(isset($_GET['id'])){
			$model = new TblRequest;
			$model->service = TblService::model()->findByPk($_GET['id']);
			if($model->service){
				$model->service = $model->service->service;
				if(isset($_POST['TblRequest'])){
					$model->attributes=$_POST['TblRequest'];
					for(;;){
						$model->code = $this->generateCode();
						if(!TblRequest::model()->findByPk(array('code'=>$model->code,'service'=>$model->service)))
							break;
					}
					if($model->save())
						$this->redirect(array('success','code'=>$model->code, 'id'=>$model->service));
				}
				$this->render('create',
					array('model'=>$model)
				);
			}else throw new CHttpException(404,'The requested service does not exist.');
		}else throw new CHttpException('','Please select a service to apply.');
	}
	
	public function generateCode()
	{
		$length = 10;
		$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
		shuffle($chars);
		$code = implode(array_slice($chars, 0, $length));
		return $code;
	}
	
	public function actionSuccess()
	{
		$model = TblRequest::model()->findByPk(array('code'=>$_GET['code'], 'service'=>$_GET['id']));
		if($model){
			if(!TblRequestRequirementsChecklist::model()->findByAttributes(array('code'=>$_GET['code'], 'service'=>$_GET['id'])) &&
				!TblRequestFeesChecklist::model()->findByAttributes(array('code'=>$_GET['code'], 'service'=>$_GET['id']))
			){
				$requirements = array();
				$fees = array();
				$number = TblServiceRequirements::getNumberOfRequirements($_GET['id']);
				if($number!=NULL)
					for($i=0;$i<=$number;$i++){
						$requirements[] = new TblRequestRequirementsChecklist;
						$requirements[$i]->code = $model->code;
						$requirements[$i]->service = $model->service;
						$requirements[$i]->_number = $i;
						$requirements[$i]->save();
					}
				$number = TblServiceFees::getNumberOfFees($_GET['id']);
				if($number!=NULL)
					for($i=0;$i<=$number;$i++){
						$fees[] = new TblRequestFeesChecklist;
						$fees[$i]->code = $model->code;
						$fees[$i]->service = $model->service;
						$fees[$i]->_number = $i;
						$fees[$i]->save();
					}
			}
			$this->render('success',array('model'=>$model));
		}else
			throw new CHttpException(400,'Your request does not exist.');
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']) && isset($_GET['code']))
				$this->_model=TblRequest::model()->findbyPk(array('code'=>$_GET['code'],'service'=>$_GET['id']));
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
