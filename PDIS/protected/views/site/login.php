<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<div class="form">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	'id'=>'login-form',
	'enableClientValidation' => true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));?>
<fieldset>
	<legend>Login</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->textFieldControlGroup($model,'username'); ?>

	<?php echo $form->passwordFieldControlGroup($model,'password'); ?>
<fieldset>
<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Login', array('color' => TbHtml::BUTTON_COLOR_PRIMARY))
)); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
