<?php
/* @var $this TblServiceController */
$this->pageTitle=Yii::app()->name . ' - Manage Services';
$this->breadcrumbs=array(
	'Manage Services',
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
				'name' => 'title',
				'header' => 'Services',
				'htmlOptions' => array('color' =>'width: 60px'),
			),
			array(
				'class'=>'CButtonColumn',
				'updateButtonLabel'=>'Edit',
				'viewButtonUrl'=>'Yii::app()->createUrl("tblService/view", array("id"=>$data->service))',
				'viewButtonOptions'=>array('target'=>'_blank'),
			),
		),
	));
//	echo CHtml::link(TbHtml::button('Add Service', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)), array('/tblService/create'));
?>