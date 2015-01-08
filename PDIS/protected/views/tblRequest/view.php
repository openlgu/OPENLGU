<?php
$this->pageTitle=Yii::app()->name . ' - View Request';
$this->breadcrumbs=array(
	'View Request',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<br/>
<?php

$status = array();
for($i=0;$i<5;$i++)
	array_push($status, $i . ' - ' . $this->displayStatus($i));

	$deficiencies = array();
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
	}else if($model->status==2){
		$fees = TblRequestFeesChecklist::model()->getDeficiencies($model->code,$model->service);
		foreach($fees as $fee)
			array_push($deficiencies, '* ' . TblServiceFees::model()->getFee($fee));
	}
	
$attributes=$model->attributeNames();
	foreach($attributes as $attribute){
		if((!$model->$attribute) && $attribute!='status')
			$model->$attribute="(None)";
	}
if(!$deficiencies)
		array_push($deficiencies, "(None)");
$this->widget('bootstrap.widgets.TbHeroUnit', array(
		'heading' => 'Status:<br/><span class="text-error">' . $model->status . ' - ' .$this->displayStatus($model->status) . '</span>',
		'content' => '
			<br/>Remarks: ' . $model->remarks .
			'<br/>Request Code: ' . $model->code .
			'<br/>Service: ' . TblService::model()->getTitle($model->service).
			'<table>
					<tr>
						<td style="vertical-align:top;">Deficiencies:</td>
						<td>'.implode('<br/>',$deficiencies). '</td>
					</tr>
				</table>' .
			TbHtml::formActions(
				array(
					TbHtml::button('Update Status', array(
						'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
						'data-toggle' => 'modal',
						'data-target' => '#UpdateStatusModal'
					)),
					TbHtml::button('Edit Remarks', array(
						'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
						'data-toggle' => 'modal',
						'data-target' => '#EditRemarksModal'
					)),
					CHtml::link(TbHtml::button('View Submitted Documents', array(
						'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
					)),array('/tblRequestFiles/view','id'=>$model->service,'code'=>$model->code), array('target'=>'_blank'))
				))
	));
	
$this->widget('bootstrap.widgets.TbModal', array(
	'id' => 'UpdateStatusModal',
	'header' => 'Update Status',
	'content' => '<form action="'.Yii::app()->baseUrl.'/index.php/tblRequest/view?id='.$model->service.'&code='.$model->code.'"id="update-status-form" class="form-horizontal" style="margin:0" method="post">' .
		TbHtml::activeDropDownList($model, 'status', $status, array('block'=>true)),
	'footer' => TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)).
				TbHtml::button('Cancel', array('data-dismiss' => 'modal')).
				'</form>',
));

$this->widget('bootstrap.widgets.TbModal', array(
	'id' => 'EditRemarksModal',
	'header' => 'Edit Remarks',
	'content' => '<form action="'.Yii::app()->baseUrl.'/index.php/tblRequest/view?id='.$model->service.'&code='.$model->code.'"id="edit-remarks-form" class="form-horizontal" style="margin:0" method="post">' .
		TbHtml::activeTextArea($model, 'remarks',array('block'=>true)),
	'footer' => TbHtml::submitButton('Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)).
				TbHtml::button('Cancel', array('data-dismiss' => 'modal')).
				'</form>',
));
?>
<p>Other Request Details:</p>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'last_name',
		'first_name',
		'middle_name',
		'mailing_address',
		'email',
		'company_name',
		'company_address',
		'designation',
	)
));?>
