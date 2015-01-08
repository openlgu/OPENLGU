<?php
$path = Yii::app()->basePath.'/sources';
$forms='';
if($model){
		foreach($model as $form){
			$forms = $forms . '<tr><td>' . $form->name . '</td></tr><tr><td>'.
			CHtml::link(TbHtml::button('View', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
				Yii::app()->assetManager->publish($path)."/".$form->filename.$form->extension,
				array('target'=>'_blank')).
			'&nbsp;';
			if($form->isonline == 1)
				$forms = $forms .
				CHtml::link(TbHtml::button('Fill Out', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
					array('/tblService/form', 'id'=>$form->service, 'form'=>$form->name));
			$forms = $forms . '</td></tr>';
		}
	}
	else
		$forms = TbHtml::em('Sorry, there are no available forms for the service.', array('color' => TbHtml::TEXT_COLOR_ERROR));
	echo TbHtml::well(
		'<legend>Manage Forms for '.TblService::model()->getTitle($_GET['id']).'</legend>'.
		'<table>'.
			$forms.
		'</table>'
		,
		array('style'=>'margin-top:20px; padding-top:20px;'));

$this->widget('bootstrap.widgets.TbModal', array(
		'id' => 'UploadFormModal',
		'header' => 'Add Form',
		'content' => '<form action="'.Yii::app()->baseUrl.'/index.php/tblService/manageForms?id='.$_GET['id'].'" enctype="multipart/form-data" id="upload-form-form" class="form-horizontal" style="margin:0" method="post">
					<fieldset>'.
					TbHtml::activeFileFieldControlGroup($file, 'file', array(
						'help'=>'.jpg, .jpeg, .png, .pdf, .doc, .docx'
					)).
					'</fieldset>',
		'footer' => TbHtml::submitButton('Upload', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)).
					TbHtml::button('Cancel', array('data-dismiss' => 'modal')).
					'</form>',
	));
?>