<?php
$this->breadcrumbs=array(
	'Tbl User Accounts'=>array('index'),
	$model->employee_number,
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1>Employee Number: <?php echo $model->employee_number; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
		'first_name',
		'middle_name',
		'last_name',
		'designation',
		'sex',
		'role',
	),
)); ?>
