<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport "/>
<META NAME="description" CONTENT="Djarum Supper Soccer.">
<title>DJARUM SUPER</title>
<?php if (Configure::read('debug') == 0) { ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php } ?>
<link href="img/favicon.ico" rel="icon" type="image/x-icon" />
<?php echo $this->Html->css(array('djarum','skin','minimalist/jquery.slider')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('jquery-1.4.3.min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack'));?>

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

<div id="homePage">
	<div id="top">
    	<a id="logo" href="index.php">&nbsp;</a>
    </div><!-- end #top -->
	<div id="body">
    	<div id="wrapper">
   			<div class="msgbox">
				<p><a href="<?php echo $url; ?>"><?php echo $message; ?></a></p>
			</div>
        </div><!-- end #wrapper -->
    </div><!-- end #body -->
	<div id="hw2">
    	<div id="hwText"></div>
    </div><!-- end #hw -->
</div><!-- end #land -->
</body>
</html>