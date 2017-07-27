<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Restricted</title>
		<?php echo $this->Html->css(array('djarumadmin','djarumlogin','reveal')); ?>
		<?php echo $this->Html->script(array('php.default.min','jquery-1.4.3.min','underscore-min','backbone-min','hoverIntent',
								 'superfish','jquery.flexslider-min','jquery.ui.core.js','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack','jquery.ui.core.js','jquery.ui.widget.js','jquery.ui.datepicker.js','jquery.reveal.js'));?>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<?php
		clearCache();
		?>
	</head>
	<body>
		<div id="navigation"><?php if($this->Session->check('userlogin')){echo $this->element('admin_navigation');}?></div>
		<?php if(isset($msg)):?>
			<div class="msg"><?php echo $msg;?></div>
		<?php endif;?>
		<?php
			$msg = $this->Session->flash();
			if(strlen($msg)>0):
		?>
		<div class="msg"><?php echo $msg?></div>
		<?php endif;?>
		<!--nocache-->
		<div id="container">
			<?php echo $this->fetch("content");?>
		</div>
		<!--/nocache-->
		<div class="adminfooter">
		</div>
	</body>
</html>