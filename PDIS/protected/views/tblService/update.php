<?php
$this->breadcrumbs=array(
	'Tbl Services'=>array('index'),
	$model->title=>array('view','id'=>$model->service),
	'Update',
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1>Update Service: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>