<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport "/>
<META NAME="description" CONTENT="Djarum Supper Soccer.">
<title>DJARUM SUPER</title>
<?php echo $this->Html->charset('utf-8'); ?>
<?php echo $this->Html->meta('icon', 'img/favicon.ico');?>
<?php echo $this->Html->css(array('djarum','skin','minimalist/jquery.slider','jquery.ui.datepicker.css','jquery.ui.theme.css','jquery.ui.core.css')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('php.default.min','jquery-1.4.3.min','underscore-min','backbone-min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack','jquery.ui.core.js','jquery.ui.widget.js','jquery.ui.datepicker.js'));?>
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

<body>

<?php if(!isset($container_style)){$container_style="homePage";}?>
<div id="<?php echo $container_style;?>">
	<div id="top">
    	<div class="w960">
		<?php if(isset($back_url)):?>
			<a class="btnBack" href="<?php echo $back_url;?>" title="back">&nbsp;</a>
		<?php endif;?>
		<?php echo $this->Html->link(' ','/',array('id'=>'logo'));?><a title="login with facebook" class="loginFacebook" href="<?php echo $this->Html->url('/login');?>">&nbsp;</a>
        </div>
    </div><!-- end #top -->
	<div id="body">
    	<div id="wrapper">
   			<?php echo $this->element('navigation');?>
			<?php echo $this->fetch("content");?>
        </div><!-- end #wrapper -->
    </div><!-- end #body -->
	<div id="hw2">
    	<div id="hwText"></div>
    </div><!-- end #hw -->
</div><!-- end #land -->
</body>
</html>
