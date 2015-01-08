<?php
$this->breadcrumbs=array(
	'Services'=>array('index'),
	$model->title,
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>

<h1><?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'availability',
			'customers',
		),
	));
	$s = TblServiceRequirements::getRequirements($model->service);
	for($i=1;$i<=sizeof($s);$i++)
		if($i>1)
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$s[$i-1],
		'attributes'=>array(
			array(
				'name'=>'requirement',
				'label'=>$i . '.'
			),
		),
	));
	else
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$s[$i-1],
		'attributes'=>array(
			array(
				'name'=>'requirement',
				'label'=>'Requirement(s): ' . $i . '.'
			),
		),
	));
	$s = TblServiceFees::getFees($model->service);
	for($i=1;$i<=sizeof($s);$i++)
		if($i>1)
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$s[$i-1],
		'attributes'=>array(
			array(
				'name'=>'fee',
				'label'=>$i . '.'
			),
		),
	));
	else
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$s[$i-1],
		'attributes'=>array(
			array(
				'name'=>'fee',
				'label'=>'Fee(s): ' . $i . '.'
			),
		),
	));
?>
