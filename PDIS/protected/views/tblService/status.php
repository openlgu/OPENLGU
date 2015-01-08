<div>
<?php
	$deficiencies = array();
	$button = '';
	$requirementsList = array();
	if($model->status==4){
		$requirements = TblServiceRequirements::model()->getRequirements($model->service);
		$d = array();
		for($i=0;$i<sizeof($requirements);$i++)
			$d[] = $requirements[$i]->_number;
		$files = TblRequestFiles::model()->getFiles($model->code,$model->service);
		for($j=0;$j<sizeof($files);$j++)
			for($i=0;$i<sizeof($d);$i++)
				if($files[$j] == $d[$i])
					array_splice($d,$i,1);
		foreach($d as $num)
			array_push($deficiencies, '* ' . TblServiceRequirements::model()->getRequirement($model->service,$num));
		$button = TbHtml::button('Submit Requirement', array(
			'block' => true,
			'color' => TbHtml::BUTTON_COLOR_PRIMARY,
			'size'=>TbHtml::BUTTON_SIZE_LARGE,
			'data-toggle' => 'modal',
			'data-target' => '#UploadModal'
		));
		for($i=0;$i<sizeof($deficiencies);$i++)
			$requirementsList[$d[$i]]=$deficiencies[$i];
	}else if($model->status==2){
		$fees = TblRequestFeesChecklist::model()->getDeficiencies($model->code,$model->service);
		foreach($fees as $fee)
			array_push($deficiencies, '* ' . TblServiceFees::model()->getFee($fee));
	}

	$this->widget('bootstrap.widgets.TbModal', array(
		'id' => 'UploadModal',
		'header' => 'Submit Requirement',
		'content' => '<form action="'.Yii::app()->baseUrl.'/index.php/tblService/checkStatus?id='.$model->service.'&code='.$model->code.'" enctype="multipart/form-data" id="upload-file-form" class="form-horizontal" style="margin:0" method="post">
					<fieldset>'.
					TbHtml::activeDropDownListControlGroup($dbfile, '_number', $requirementsList, array(
						'label'=>'Requirement',
						'empty'=>'',
						'help'=>'Select which requirement you want to submit.'
					)).
					TbHtml::activeFileFieldControlGroup($file, 'file', array(
						'help'=>'.jpg, .jpeg, .png, .pdf, .doc, .docx'
					)).
					'</fieldset>',
		'footer' => TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)).
					TbHtml::button('Cancel', array('data-dismiss' => 'modal')).
					'</form>',
	));

	$attributes=$model->attributeNames();
	foreach($attributes as $attribute){
		if((!$model->$attribute) && $attribute!='status')
			$model->$attribute="(None)";
	}
	if(!$deficiencies)
		array_push($deficiencies, "(None)");
	$this->widget('bootstrap.widgets.TbHeroUnit', array(
		'heading' => 'Status:<br/><span class="text-error">' . $this->displayStatus($model->status) . '</span>',
		'content' => '
			<br/>Remarks: ' . $model->remarks .
			'<br/>Request Code: ' . $model->code .
			'<br/>Service: ' . TblService::model()->getTitle($model->service) .
			'<br/><table>
					<tr>
						<td style="vertical-align:top;">Deficiencies:</td>
						<td>'.implode('<br/>',$deficiencies). '</td>
					</tr>
					<tr>
						<td colspan=2>'.$button.'</td>
					</tr>
				</table>',
	));
?>
</div>