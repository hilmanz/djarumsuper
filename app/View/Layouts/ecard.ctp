<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport "/>
<META NAME="description" CONTENT="Djarum Supper Soccer.">
<title>DJARUM SUPER</title>
<?php echo $this->Html->meta('icon', 'img/favicon.ico');?>
<?php echo $this->Html->css(array('djarum','skin','minimalist/jquery.slider')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4','ecard','reveal'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('php.default.min','jquery-1.4.3.min','jquery-ui-1.8.23.custom.min','underscore-min','backbone-min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack','underscore-min','backbone-min',
								 'flowplayer-3.2.11.min',
								 'ecard','swfobject','jquery.reveal.js'));?>

<!--[if IE 6]>
<?php echo $this->Html->css(array('minimalist/jquery.slider.ie6'),'stylesheet'); ?>
<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .grad {
       filter: none;
    }
  </style>
<![endif]-->

</head>

<body id="tripPage">
<div id="trip-advisor">
	<div id="top">
    	<?php echo $this->Html->link(' ','/',array('id'=>'logo'));?>
    </div><!-- end #top -->
	<div id="tripContainer">
    	<?php echo $this->fetch("content");?>
    </div>
	<div id="hw">
    	<div id="hwText"></div>
    </div><!-- end #hw -->
</div><!-- end #land -->
<div id="bgPopup"></div>
</body>
</html>
