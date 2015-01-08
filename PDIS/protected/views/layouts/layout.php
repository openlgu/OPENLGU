<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
		'color' => TbHtml::NAVBAR_COLOR_INVERSE,
		'brandLabel' => false,
		'collapse' => true,
		'display' => TbHtml::NAVBAR_DISPLAY_STATICTOP,
		'items' => array(
			array(
				'class' => 'bootstrap.widgets.TbNav',
				'activateParents' => true,
				'htmlOptions'=>array('pull'=>TbHtml::PULL_RIGHT),
				'items' => array(
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Account Privileges', 'visible'=>!Yii::app()->user->isGuest,
						'htmlOptions'=>array('id'=>'accountPrivileges'),
						'items'=>array(
							array('label' => 'Accounts', 'url' => array('/tblUserAccount/manage')),
							array('label' => 'Requests', 'url' => array('/tblRequest/manage')),
							array('label' => 'Services', 'url' => array('/tblService/manage')),
							//array('label' => 'Files', 'url' => array('/tblFiles/manage')),
							//array('label' => 'Announcements', 'url' => array('/tblAnnouncements/manage')),
							//array('label' => 'Feedbacks', 'url' => '#'),
						)			
					),
					TbHtml::navBarMenuDivider(),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
			),
		),
	));
?>
<div class="span9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span2 last" style="margin-top:2%">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Services',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>