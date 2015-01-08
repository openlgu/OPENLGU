<?php
$this->breadcrumbs=array(
	'Tbl User Accounts'=>array('index'),
	'Create',
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1>Create TblUserAccount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>