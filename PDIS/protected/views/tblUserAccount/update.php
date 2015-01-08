<?php
$this->breadcrumbs=array(
	'Tbl User Accounts'=>array('index'),
	$model->employee_number=>array('view','id'=>$model->employee_number),
	'Update',
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1>Update TblUserAccount <?php echo $model->employee_number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>