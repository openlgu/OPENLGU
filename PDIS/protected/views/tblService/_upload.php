<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	'id' => 'upload-file-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));?>
<legend>Submit Requirement</legend>
<fieldset>
	<?php echo $form->dropDownListControlGroup($model, '_number', $requirementsList, array(
			'label'=>'Requirement',
			'empty'=>'',
			'help'=>'Select which requirement you want to submit.'
		));?>
</fieldset>
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))
)); ?>

<?php $this->endWidget(); ?>
</div>

<div>