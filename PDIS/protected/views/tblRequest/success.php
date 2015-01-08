<?php
$this->pageTitle=Yii::app()->name . ' - Success';
$this->breadcrumbs=array(
	'Success',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<div>
	<br/>
	<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
		'heading' => 'Success!',
		'content' => '<p>You have submitted an application for:<br/><strong>'.$model->service.'</strong>
			<br/>Your request code is ' .
			CHtml::link(TbHtml::button('<strong><span class="text-error">' . $model->code . '</span></strong>'),
			array('tblService/checkStatus','code'=>$model->code,'id'=>$model->service),array('target'=>'_blank'))
			. '</p>',
	));
	?>
</div>