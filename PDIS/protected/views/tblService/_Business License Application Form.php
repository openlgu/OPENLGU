<script type="text/javascript">
	document.getElementById("servicesLabel").classList.add("active");
</script>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
	'id' => 'tbl-business-license-application-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<legend>Business Application Form</legend>
<p>Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
<fieldset>
	<?php echo $form->textFieldControlGroup($model,'name_of_applicant',array('help'=> 'Last, First, Middle'));?>
	<?php echo $form->textAreaControlGroup($model,'address_of_applicant');?>
	<?php echo $form->textFieldControlGroup($model,'name_of_corporation');?>
	<?php echo $form->textAreaControlGroup($model,'address_of_corporation');?>
	<?php echo $form->textFieldControlGroup($model,'name_of_authorized_representative');?>
	<?php echo $form->textAreaControlGroup($model,'address_of_authorized_representative');?>
	<?php echo $form->textFieldControlGroup($model,'project_type');?>
	<?php echo $form->radioButtonListControlGroup($model,'project_nature',$model->projectNature);?>
	<?php echo $form->textFieldControlGroup($model,'project_nature_others');?>
	<?php echo $form->textFieldControlGroup($model,'project_location', array('help'=> 'No. St. Bgy. Municipality Province'));?>
	<?php echo $form->textFieldControlGroup($model,'project_area_lot_area');?>
	<?php echo $form->textFieldControlGroup($model,'project_area_building_or_improvement_area');?>
	<?php echo $form->radioButtonListControlGroup($model,'right_over_land',$model->rightOverLand);?>
	<?php echo $form->textFieldControlGroup($model,'right_over_land_others');?>
	<?php echo $form->radioButtonListControlGroup($model,'project_tenure',$model->projectTenure);?>
	<?php echo $form->textFieldControlGroup($model,'project_tenure_temporary');?>
	<?php echo $form->radioButtonListControlGroup($model,'existing_land_uses_of_project_site',$model->existingLandUsesOfProjectSite);?>
	<?php echo $form->textFieldControlGroup($model,'existing_land_uses_of_project_site_others');?>
	<?php echo $form->textFieldControlGroup($model,'project_cost_or_capitalization',array('help'=>'In PESOS, write in words and figures'));?>
	<?php echo $form->radioButtonListControlGroup($model,'from_this_commission',$model->fromThisCommission);?>
	<p>If yes, please answer the following:</p>
	<?php echo $form->textFieldControlGroup($model,'from_this_commission_a');?>
	<?php echo $form->textFieldControlGroup($model,'from_this_commission_b');?>
	<?php echo $form->textFieldControlGroup($model,'from_this_commission_c');?>
	<?php echo $form->radioButtonListControlGroup($model,'with_order',$model->withOrder);?>
	<?php echo $form->textFieldControlGroup($model,'with_order_a');?>
	<?php echo $form->textFieldControlGroup($model,'with_order_b');?>
	<?php echo $form->textFieldControlGroup($model,'with_order_c');?>
	<?php echo $form->radioButtonListControlGroup($model,'preferred_mode_of_release_of_decision',$model->preferredModeOfReleaseOfDecision);?>
</fieldset>
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Export to PDF', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>

<?php $this->endWidget(); ?>
<script type="text/javascript">
	window.onload = function(){
		if(!document.getElementById('BusinessLicenseApplicationForm_project_nature_2').checked)
			document.getElementById('BusinessLicenseApplicationForm_project_nature_others').disabled = true;
		if(!document.getElementById('BusinessLicenseApplicationForm_right_over_land_2').checked)
			document.getElementById('BusinessLicenseApplicationForm_right_over_land_others').disabled = true;
		if(!document.getElementById('BusinessLicenseApplicationForm_project_tenure_1').checked)
			document.getElementById('BusinessLicenseApplicationForm_project_tenure_temporary').disabled = true;
		if(!document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_8').checked)
			document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_others').disabled = true;
		if(!document.getElementById('BusinessLicenseApplicationForm_from_this_commission_0').checked){
			document.getElementById('BusinessLicenseApplicationForm_from_this_commission_a').disabled = true;
			document.getElementById('BusinessLicenseApplicationForm_from_this_commission_b').disabled = true;
			document.getElementById('BusinessLicenseApplicationForm_from_this_commission_c').disabled = true;
		}
		if(!document.getElementById('BusinessLicenseApplicationForm_with_order_0').checked){
			document.getElementById('BusinessLicenseApplicationForm_with_order_a').disabled = true;
			document.getElementById('BusinessLicenseApplicationForm_with_order_b').disabled = true;
			document.getElementById('BusinessLicenseApplicationForm_with_order_c').disabled = true;
		}
		document.getElementById('BusinessLicenseApplicationForm_project_nature').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_project_nature_2').checked){
				document.getElementById('BusinessLicenseApplicationForm_project_nature_others').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_project_nature_others').required = true;
			}else
				document.getElementById('BusinessLicenseApplicationForm_project_nature_others').disabled = true;
		}
		document.getElementById('BusinessLicenseApplicationForm_right_over_land').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_right_over_land_2').checked){
				document.getElementById('BusinessLicenseApplicationForm_right_over_land_others').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_right_over_land_others').required = true;
			}else
				document.getElementById('BusinessLicenseApplicationForm_right_over_land_others').disabled = true;
		}
		document.getElementById('BusinessLicenseApplicationForm_project_tenure').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_project_tenure_1').checked){
				document.getElementById('BusinessLicenseApplicationForm_project_tenure_temporary').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_project_tenure_temporary').required = true;
			}else
				document.getElementById('BusinessLicenseApplicationForm_project_tenure_temporary').disabled = true;
		}
		document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_8').checked){
				document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_others').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_others').required = true;
			}else
				document.getElementById('BusinessLicenseApplicationForm_existing_land_uses_of_project_site_others').disabled = true;
		}
		document.getElementById('BusinessLicenseApplicationForm_from_this_commission').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_from_this_commission_0').checked){
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_a').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_b').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_c').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_a').required = true;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_b').required = true;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_c').required = true;
			}else{
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_a').disabled = true;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_b').disabled = true;
				document.getElementById('BusinessLicenseApplicationForm_from_this_commission_c').disabled = true;
			}
		}
		document.getElementById('BusinessLicenseApplicationForm_with_order').onclick = function(){
			if(document.getElementById('BusinessLicenseApplicationForm_with_order_0').checked){
				document.getElementById('BusinessLicenseApplicationForm_with_order_a').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_with_order_b').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_with_order_c').disabled = false;
				document.getElementById('BusinessLicenseApplicationForm_with_order_a').required = true;
				document.getElementById('BusinessLicenseApplicationForm_with_order_b').required = true;
				document.getElementById('BusinessLicenseApplicationForm_with_order_c').required = true;
			}else{
				document.getElementById('BusinessLicenseApplicationForm_with_order_a').disabled = true;
				document.getElementById('BusinessLicenseApplicationForm_with_order_b').disabled = true;
				document.getElementById('BusinessLicenseApplicationForm_with_order_c').disabled = true;
			}
		}
	}
</script>