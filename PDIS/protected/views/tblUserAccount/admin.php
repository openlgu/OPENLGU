<?php
$this->breadcrumbs=array(
	'Tbl User Accounts'=>array('index'),
	'Manage',
);

$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-user-account-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tbl User Accounts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tbl-user-account-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'employee_number',
		'username',
		'password',
		'email',
		'first_name',
		'middle_name',
		/*
		'last_name',
		'designation',
		'sex',
		'role',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
