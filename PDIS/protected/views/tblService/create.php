<?php
$this->breadcrumbs=array(
	'Tbl Services'=>array('index'),
	'Create',
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1>Create TblService</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>