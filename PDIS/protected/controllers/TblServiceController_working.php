<?php

class TblServiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
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
				'actions'=>array('index','view','forms','form','apply','checkStatus','upload','createpdf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCheckStatus()
	{
		$this->layout='//layouts/layout';
		$model = new TblRequest('search');
		$dbfile = new TblRequestFiles;
		$file = new FileUpload;
		if(isset($_GET['code']) && isset($_GET['id'])){
			if(isset($_POST['TblRequestFiles']) && isset($_POST['FileUpload'])){
				$dbfile->attributes = $_POST['TblRequestFiles'];
				$dbfile->service = $_GET['id'];
				$dbfile->code = $_GET['code'];
				if($file->validate()){
					$uploadedFile = CUploadedFile::getInstance($file,'file');
					$dbfile->filename = substr($uploadedFile->name, 0, strrpos($uploadedFile->name,'.'));
					$dbfile->extension = $uploadedFile->extensionName;
					if(!file_exists(Yii::app()->basePath.'/uploads/'.$dbfile->service))
						mkdir(Yii::app()->basePath.'/uploads/'.$dbfile->service);
					if(!file_exists(Yii::app()->basePath.'/uploads/'.$dbfile->service.'/'.$dbfile->code))
						mkdir(Yii::app()->basePath.'/uploads/'.$dbfile->service.'/'.$dbfile->code);
					$uploadedFile->saveAs(Yii::app()->basePath.'/uploads/'.$dbfile->service.'/'.$dbfile->code.'/'.$uploadedFile->name);
					if(!TblRequestFiles::model()->exists(
						'service=:service AND
						code=:code AND
						filename=:filename AND
						extension=:extension',
						array(
							'service'=>$dbfile->service,
							'code'=>$dbfile->code,
							'filename'=>$dbfile->filename,
							'extension'=>$dbfile->extension
						)
					)){
						if($dbfile->save()){
							Yii::app()->user->setFlash(
								TbHtml::ALERT_COLOR_SUCCESS,
								'<strong>Success!</strong> You have submited the requirement.');
							TblRequestRequirementsChecklist::model()->accomplish($dbfile->service,$dbfile->code,$dbfile->_number,1);
						}
					}else
							Yii::app()->user->setFlash(
								TbHtml::ALERT_COLOR_ERROR,
								'<strong>Error!</strong> The file already exists.');
				}else
					Yii::app()->user->setFlash(
						TbHtml::ALERT_COLOR_ERROR,
						'<strong>Error!</strong> Please upload a valid file.');
			}
			$model = TblRequest::model()->findByPk(array('code'=>$_GET['code'], 'service'=>$_GET['id']));
		}
		if($model)
			$this->render('check_status',array('model'=>$model, 'dbfile'=>$dbfile, 'file'=>$file));
		else
			throw new CHttpException(400,'Your request does not exist.');
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

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}
	
	public function actionForms()
	{
		if(isset($_GET['id'])){
			if(TblService::model()->exists(
				'service=:service',
				array('service'=>$_GET['id'])
			))
			{
				$model = TblServiceForms::model()->findAllByAttributes(array('service'=>$_GET['id']));
				$this->render('forms',array('model'=>$model, 'service'=>$_GET['id']));
			}
			else
				throw new CHttpException(404,'The requested service does not exist.');
		}else
			throw new CHttpException(404,'The requested page does not exist.');
	}
	
	public function actionForm()
	{
		if(isset($_GET['form']) && isset($_GET['id'])){
			$formModel = $this->formModel($_GET['form']);
			$model = $formModel['formModel'];
			if(isset($_POST[$formModel['formModelName']])){
				$model->attributes = $_POST[$formModel['formModelName']];
				$m = $model;
				$names = $m->attributeNames();
				$labels = $m->attributeLabels();
				for($i=0;$i<sizeof($names);$i++)
					if(array_key_exists($names[$i], $labels))
						if($labels[$names[$i]]=='(Specify)'){
							if($m[$names[$i]]){
							$m->$names[$i-1] = $m->$names[$i-1] . ' (Specify) ' . $m->$names[$i];
							}
						}else if($labels[$names[$i]]=='(Specify Years)'){
							if($m[$names[$i]]){
							$m->$names[$i-1] = $m->$names[$i-1] . ' (Specify Years) ' . $m->$names[$i];
							}
						}
				Yii::app()->user->setState('formModel', $m);
				if($model->validate())
					print_r($m);
					//$this->redirect(array('createPdf', 'form'=>$_GET['form']));
			}
			$this->render('_'.$_GET['form'],array('model'=>$model));
		}else
			throw new CHttpException(404,'The requested page does not exist.');
	}
	
	public function formModel($form)
	{
		$form = preg_replace('/\s+/', '', $form);
		$formModel = new $form;
		return array('formModel'=>$formModel, 'formModelName'=>$form);
	}
	
	public function actionCreatepdf(){
		$model = Yii::app()->user->getState('formModel');
		if(isset($_GET['form']) && $_GET['form'] == 'Business License Application Form'){
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase','autoload'));
 
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
 
		$pdf->SetTitle("Business Licence Application Form");
        $pdf->SetHeaderData(
			PDF_HEADER_LOGO,
			PDF_HEADER_LOGO_WIDTH,
			"Republic of the Philippines<br/>PROVINCE OF LAGUNA<br/><strong>MUNICIPALITY OF LOS BA&Ntilde;OS</strong><br/>",
			"<strong>Office of the Zoning Administrator</strong>",'',array(255,255,255));
		$pdf->setHeaderFont(Array('dejavusans', '', 10));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('dejavusans', '', 8.5);
        $pdf->SetTextColor(0,0,0);
        $pdf->AddPage();
		
		$html = '<table>
			<tr>
				<td style="border-top:0.1px solid #000;border-right:0.1px solid #000;border-left:0.1px solid #000">&nbsp;&nbsp;&nbsp;Application No.</td>
			</tr>
			<tr>
				<td style="border:0.1px solid #000">&nbsp;&nbsp;&nbsp;Date of Receipt</td>
			</tr>
		</table>';
		
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->SetFont('helvetica', '', 9);
		$html = '<strong>APPLICATION FOR LOCATIONAL CLEARANCE/ CERTIFICATE OF ZONING COMPLIANCE</strong>';
		$pdf->writeHTML($html, true, false, true, false, 'C');
        $pdf->SetFont('dejavusans', '', 9);
		$html = '<table cellpadding="3px">';
		$labels = $model->attributeLabels();
		$ctr = 1;
		foreach($model->attributeNames() as $data){
			if(array_key_exists($data, $labels))
				if($model[$data] && $labels[$data] != '(Specify)' && $labels[$data] != '(Specify Years)'){
					if($data != 'from_this_commission_a' && $data != 'from_this_commission_b' && $data != 'from_this_commission_c' && $data != 'with_order_a' && $data != 'with_order_b' && $data != 'with_order_c'){
					$html = $html . '<tr><td border="0.1px">' . $ctr . '. ' . $labels[$data] . '<br/>&nbsp;&nbsp;&nbsp;'.$model[$data].'</td></tr>';
					$ctr++;
					}else
						$html = $html . '<tr><td border="0.1px">&nbsp;&nbsp;&nbsp;' . $labels[$data] . '<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$model[$data].'</td></tr>';
				}
		}
		$html = $html . '</table><br/>Republic of the Philippines&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
		<br/>Province of Laguna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) S.S.
		<br/>MUNICIPALITY OF LOS BA&Ntilde;OS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
		<br/>X - - - - - - - - - - - - - - - - - - - - - X
		<br/>SUBSCRIBED AND SWORN TO before me this ____________day of ____________________, 20__________, at the Municipality of
		<br/>Los Ba&ntilde;os, Laguna, affiant exhibited to me his/her Community Tax Certificate No. ___________________________ issued at
		<br/>_________________________ on ________________, 20__________.
		<br/><br/>Doc. No. __________________________
		<br/>Page No. __________________________
		<br/>Book No. __________________________
		<br/>Series of __________________________
		<br/><br/><br/>revised feb 2014';
		$pdf->writeHTML($html, true, false, true, false, '');
		//$html = 'Republic of the Philippines';
		//$pdf->writeHTML($html, true, false, true, false, '');
		
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output($_GET['form'], 'I');
        Yii::app()->end();
		}else
			throw new CHttpException(404,'The requested page does not exist.');
    }
	
	public function getArray($name){
		for($i=1;$i<strlen($name);$i++)
			if($name[$i-1]=='_')
				$name[$i] = strtoupper($name[$i]);
		$name = preg_replace('/_+/', '', $name);
		return $name;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TblService;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblService']))
		{
			$model->attributes=$_POST['TblService'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->service));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TblService']))
		{
			$model->attributes=$_POST['TblService'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->service));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout='//layouts/layout';
		$dataProvider=new CActiveDataProvider('TblService');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TblService('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TblService']))
			$model->attributes=$_GET['TblService'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=TblService::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tbl-service-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
