<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Performance Pledge';
$this->breadcrumbs=array(
	'Performance Pledge',
);
$this->menu = array_merge(
		TblService::model()->getItems(),
		array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
	);
?>
<h1>Performance Pledge</h1>

<p style="margin-right: 30%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We as public servants of the Municipality of Los Ba&ntilde;os,
commit to the people that we will render public service with utmost
integrity, responsibility and honesty. We wil:</p>
<p style="margin-right: 30%"><table>
	<tr><td width="8%"></td>
	<td>
		<ul class="noMarker">
			<li>Be consistent in applying the rules.</li>
			<li>Provide feedback mechanism.</li>
			<li>Be polite and courteous.</li>
			<li>Demonstrate sensitivity and appropriate behaviour and professionalism.</li>
			<li>Work beyond office hours if necessary.</li>
			<li>Respond immediately to complaints.</li>
			<li>Provide comfortable waiting areas.</li>
			<li>Practice fairness and equality.</li>
		</ul>
	</td></tr>
</table></p>
<p style="margin-right: 30%">And to bear in mind that we are accountable to people cause&mdash;
<br/>PUBLIC OFFICE IS A PUBLIC TRUST.</p>