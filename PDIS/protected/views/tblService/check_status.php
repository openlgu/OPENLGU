<div>
<?php $this->widget('bootstrap.widgets.TbAlert',array(
	'htmlOptions' => array('style'=>'margin-top:20px'),
));
$services = TblService::model()->findAll();
$services = CHtml::listData($services,
                'service','title');
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_HORIZONTAL,'','get'); ?>
	<legend>Check Status</legend>
	<p>Fields with <span class="required">*</span> are required.</p>
	<fieldset>
		<?php echo TbHtml::dropDownListControlGroup('id', $model->service, $services,
			array('label' => 'Service', 'empty' => '-Select Service-')); ?>
		<?php echo TbHtml::textFieldControlGroup('code', $model->code,
			array('label' => 'Code', 'maxlength' => 45)); ?>
		<?php echo TbHtml::formActions(array(
		TbHtml::submitButton('Check', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)))); ?>
	</fieldset>
<?php echo TbHtml::endForm(); ?>
<?php
	if($model->code){
		$this->renderPartial('status',array('model'=>$model, 'dbfile'=>$dbfile, 'file'=>$file));
	}
?>
</div>