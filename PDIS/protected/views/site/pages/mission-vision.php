<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Mission and Vision';
$this->breadcrumbs=array(
	'Mission and Vision',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<h1>Mission</h1>

<p style="margin-right: 30%">The new Municipal Government of Los Ba&ntilde;os is committed
to the development of an eco-tourism community through competent
human resources guided by responsible, effective, accountable and
God-fearing leadership sustained by empowered citizenry.</p>

<br/><br/>

<h1>Vision</h1>

<p style="margin-right: 30%">&ldquo;An eco-tourism friendly municipality utilizing potential
resources and technology giving a new face towards a globally
competitive and responsive new Los Ba&ntilde;os&rdquo;</p>