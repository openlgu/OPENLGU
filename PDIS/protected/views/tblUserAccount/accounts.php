<?php
/* @var $this TblServiceController */
$this->pageTitle=Yii::app()->name . ' - Manage Accounts';
$this->breadcrumbs=array(
	'Manage Accounts',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<?php
	$this->widget('bootstrap.widgets.TbGridView', array(
	   'dataProvider' => $model->search(),
	   'filter' => $model,
	   'template' => "{items}\n{pager}",
	   'columns' => array(
			array(
				'name' => 'employee_number',
				'header' => 'Employee Number',
				'htmlOptions' => array('style' =>'width: 120px'),
			),
			array(
				'name' => 'username',
				'header' => 'Username',
				'htmlOptions' => array('style' =>'width: 120px'),
			),
			array(
				'name' => 'last_name',
				'header' => 'Last Name',
				'htmlOptions' => array('style' =>'width: 120px'),
			),
			array(
				'name' => 'first_name',
				'header' => 'First Name',
				'htmlOptions' => array('style' =>'width: 120px'),
			),
			array(
				'class'=>'CButtonColumn',
				'updateButtonLabel'=>'Edit',
				'viewButtonUrl'=>'Yii::app()->createUrl("tblUserAccount/view", array("id"=>$data->employee_number))',
				'viewButtonOptions'=>array('target'=>'_blank'),
			),
		),
	));
	echo CHtml::link(TbHtml::button('Add Account', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)), array('/tblUserAccount/create'));
?>