<?php

class TblRequestFilesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/layout', meaning
	 * using two-column layout. See 'protected/views/layouts/layout.php'.
	 */
	public $layout='//layouts/layout';

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionView()
	{
		if(isset($_GET['id']) && isset($_GET['code'])){
			if(TblRequest::model()->exists(
				'service=:service AND code=:code',
				array('service'=>$_GET['id'], 'code'=>$_GET['code'])
			)){
				$model = TblRequestFiles::model()->findAllByAttributes(array('service'=>$_GET['id'],'code'=>$_GET['code']));
				$this->render('view',array(
					'model'=>$model,
					'service'=>$_GET['id'],
					'code'=>$_GET['code'],
				));
			}else
				throw new CHttpException(404,'The request does not exist.');
		}else
			throw new CHttpException(404,'The requested page does not exist.');
	}
	
	public function actionDelete()
	{
		if(isset($_GET['id']) && isset($_GET['code']) && isset($_GET['filename']) && isset($_GET['extension'])){
			$model = TblRequestFiles::model()->findByPk(array(
				'service'=>$_GET['id'],
				'code'=>$_GET['code'],
				'filename'=>$_GET['filename'],
				'extension'=>$_GET['extension']
			));
			if($model){
				$file = $model;
				if($model->delete()){
					unlink(Yii::app()->basePath."/uploads/".$this->generateValidFileName($file->service)."/".$file->code."/".$file->filename.".".$file->extension);
					TblRequestRequirementsChecklist::model()->accomplish($file->service, $file->code, $file->_number, 0);
					TblRequest::model()->updateStatus($file->code, $file->service);
					$this->redirect(array('view', 'id'=>$_GET['id'], 'code'=>$_GET['code']));
				}
			}else
				throw new CHttpException(404,'The request does not exist.');
		}
	}
	
	public function generateValidFileName($service)
	{
		$service = preg_replace('/\/+/', '', $service);
		return $service;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
}
?>