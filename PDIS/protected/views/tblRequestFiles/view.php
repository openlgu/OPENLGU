<?php
$this->pageTitle=Yii::app()->name . ' - ' . $_GET['id'] . '-' . $_GET['code'] . ' Files';
$this->breadcrumbs=array(
	$_GET['id'] . '-' . $_GET['code'] . ' Files'
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<?php
	$path = Yii::app()->basePath.'/uploads';
	$files = '';
	if($model){
		foreach($model as $file){
			$files = $files . '<tr><td>' . $file->filename . "." . $file->extension . '</td><td>'.
			CHtml::link(TbHtml::button('View', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
				Yii::app()->assetManager->publish($path)."/".$this->generateValidFileName($file->service)."/".$file->code."/".$file->filename.".".$file->extension,
				array('target'=>'_blank')) . '&nbsp;' .
			CHtml::link(TbHtml::button('Delete', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
				array('delete','id'=>$file->service,'code'=>$file->code,'filename'=>$file->filename,'extension'=>$file->extension)
			) . '</td></tr>';
		}
	}
	else
		$files = TbHtml::em('Sorry, there are no available files for the request.', array('color' => TbHtml::TEXT_COLOR_ERROR));
	echo TbHtml::well(
		'<legend>Service: '.TblService::model()->getTitle($service).'<br/>Code: '.$code.'</legend>'.
		'<table>'.
			$files.
		'</table>'
		,
		array('style'=>'margin-top:20px; padding-top:20px;'));
?>
<br/>
<br/>