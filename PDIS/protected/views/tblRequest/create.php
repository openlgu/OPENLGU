<?php
$this->breadcrumbs=array(
	'Apply for' . TblService::model()->getTitle($model->service),
);
$this->pageTitle = Yii::app()->name . ' - Apply for ' .  TblService::model()->getTitle($model->service);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<script type="text/javascript">
	document.getElementById("servicesLabel").classList.add("active");
</script>
<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	'id' => 'tbl-request-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype' => 'multipart/form-data')
));?>
 
<fieldset>
 
    <legend><?php echo TblService::model()->getTitle($model->service)?></legend>
	<p>Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->textFieldControlGroup($model, 'first_name',
        array('maxlength'=>45)); ?>
	<?php echo $form->textFieldControlGroup($model, 'middle_name',
        array('maxlength'=>45)); ?>
	<?php echo $form->textFieldControlGroup($model, 'last_name',
        array('maxlength'=>45)); ?>
	<?php echo $form->textAreaControlGroup($model, 'mailing_address',
        array('span' => 4, 'rows' => 4)); ?>
	<?php echo $form->textFieldControlGroup($model, 'email',
        array('maxlength'=>45)); ?>
	<?php echo $form->textFieldControlGroup($model, 'company_name',
        array('maxlength'=>300)); ?>
	<?php echo $form->textAreaControlGroup($model, 'company_address',
        array('span' => 4, 'rows' => 4)); ?>
	<?php echo $form->textFieldControlGroup($model, 'designation',
        array('maxlength'=>200)); ?>
 
</fieldset>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Apply', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>
</div>
<?php $this->endWidget(); ?>