<?php
/* @var $this TblServiceController */
$this->pageTitle=Yii::app()->name . ' - Manage Requests';
$this->breadcrumbs=array(
	'Manage Requests',
);
$services = TblService::model()->findAll();
$services = CHtml::listData($services,
                'service','title');
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<?php
	echo '<br/>'.TbHtml::well('
		Status Legend:
		<br/>&nbsp;&nbsp;&nbsp;0 - '.$this->displayStatus(0).
		'<br/>&nbsp;&nbsp;&nbsp;1 - '.$this->displayStatus(1).
		'<br/>&nbsp;&nbsp;&nbsp;2 - '.$this->displayStatus(2).
		'<br/>&nbsp;&nbsp;&nbsp;3 - '.$this->displayStatus(3).
		'<br/>&nbsp;&nbsp;&nbsp;4 - '.$this->displayStatus(4));
?>
<?php
	$this->widget('bootstrap.widgets.TbGridView', array(
	   'dataProvider' => $model->search(),
	   'filter' => $model,
	   'template' => "{items}\n{pager}",
	   'columns' => array(
			array(
				'name' => 'service'
			),
			array(
				'name' => 'code'
			),
			array(
				'name' => 'status',
				'htmlOptions' => array('style' =>'width: 100px'),
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}{delete}',
				'viewButtonUrl'=>'Yii::app()->createUrl("tblRequest/view", array("code"=>$data->code,"id"=>$data->service))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("tblRequest/delete", array("code"=>$data->code,"id"=>$data->service))',
			),
		),
	));
?>
<?php echo TbHtml::well(TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE,array('/tblRequest/create'),'get').
	'<fieldset>'.
	TbHtml::dropDownList('id', $model->service, $services,
		array('label' => 'Service', 'empty' => '-Select Service-')).
	'&nbsp;&nbsp;'.
	TbHtml::submitButton('Add Request', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)).
	'</fieldset>'.
	TbHtml::endForm()
); ?>