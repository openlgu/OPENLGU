<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php \Yii::app()->bootstrap->register(); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="topBar">
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
				'color' => TbHtml::NAVBAR_COLOR_INVERSE,
				'brandLabel' => '<img src="'. Yii::app()->baseUrl . '/images/Republic Seal.png"/>',
				'brandUrl' => '',
				'brandOptions' => array('id'=>'republicSeal'),
				'collapse' => true,
				'display' => TbHtml::NAVBAR_DISPLAY_STATICTOP,
				'items' => array(
					array(
						'class' => 'bootstrap.widgets.TbNav',
						'activateParents' => true,
						'items' => array(
							TbHtml::navBarMenuDivider(),
							array('label' => 'Home', 'url' => array('/site/index')),
							TbHtml::navBarMenuDivider(),
							array('label' => 'Transparency', 'items' => array(
								array('label' => 'About Us', 'url' => '#', 'disabled' => true),
								array('label' => 'Mission and Vision', 'url' => array('/site/page', 'view'=>'mission-vision')),
								array('label' => 'Performance Pledge', 'url' => array('/site/page', 'view'=>'pledge')),
							)),
							TbHtml::navBarMenuDivider(),
							array('label' => 'Services',
								'htmlOptions'=>array('id'=>'servicesLabel'),
								'items' => array_merge(
									TblService::model()->getItems(),
									array(array('label' => 'Check Status', 'url' => array('/tblService/checkStatus')))
								)
							),
						),
					),
					array(
						'class' => 'bootstrap.widgets.TbNav',
						'activateParents' => true,
						'htmlOptions'=>array('pull'=>TbHtml::PULL_RIGHT),
						'items' => array(
							array('label' => 'Contact Us', 'url' => array('/site/page', 'view'=>'contact')),
						)
					)
				)
			));
		?>
	</div>
	<div id="masthead">
		<?php $this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<img src="'. Yii::app()->baseUrl . '/images/Los Banos Seal.png" class="img-responsive"/>', 'url'=>array('/site/index'))
			)
		)); ?>
	</div>
	<div id="banner">
	</div>
	<div id="layout">
		<?php
			echo $content;
		?>
	</div>
	<div id="agencyFooter">
	</div>
	<div id="standardFooter">
	</div>
</div><!-- page -->

</body>
</html>