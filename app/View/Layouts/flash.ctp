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
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport "/>
<META NAME="description" CONTENT="Djarum Supper Soccer.">
<title>MY ADVENTURE</title>
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
<script>
var is_login = <?php if(isset($is_fb_login)): echo 1;else: echo 0;endif;?>;
window.fbAsyncInit = function() {
  FB.init({
    appId      : '<?php echo Configure::read('Facebook.appId');?>', // App ID
    channelUrl : '<?php echo Configure::read('Facebook.channel');?>', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });
  // Additional initialization code here
  
  FB.getLoginStatus(function(response) {
	if (response.authResponse) {
		var accessToken = response.authResponse.accessToken;
		document.cookie="ac_tk=" + accessToken + ";path=/";
		console.log('login nih');
	}else{
		console.log('nggak login nih');
		//del_cookie('ac_tk');
		deleteAllCookies();
		
	}
  });
 
  	
	 FB.Event.subscribe('auth.authResponseChange', function(response) {
 	 console.log(response.status);
	 if (response.status === 'connected' && is_login==0) {
	    window.top.location = '<?php echo Configure::read('Facebook.redirect_url')."?ok=1&rand=".rand(1000,999);?>';
	 }
	});
	FB.Event.subscribe('message.send', function(response) {
 	 	//console.log('message send');
	});
	
};
// Load the SDK Asynchronously
(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));
</script>
<script>
function fblogin() {
	try{
		FB.login(function(response) {
		  console.log(response.authResponse);
		}, {scope:'read_stream,publish_stream,email,user_likes'});
	}catch(e){}
}
</script>
</head>

<body>
<div id="fb-root"></div>
 
<?php if(!isset($container_style)){$container_style="homePage";}?>
<div id="homePage" class="<?php echo $container_style;?>">
	<div id="universal">
        <div id="top">
        	<a href="#"><?php echo $this->Html->image('/content/banner/top_banner.jpg');?></a>
        </div><!-- end #top -->
        <div id="header">
        	<div class="headerImg">
                <?php echo $this->Html->image('/content/banner/head_banner.jpg');?>
               <!-- <?php echo $this->Html->image("/img/cloud.png", array("class" => "cloud")); ?>-->
            </div>
            <div class="headerText">
            	<h1><span>MY</span>ADVENTURE<small>.co.id</small></h1>
                <h2>Where adventurer gathers</h2>
            </div>
			<?php if(isset($fb_id)):?>
                <div class="authorProfile">
                    <div class="thumbFoto">
                        <?php echo $this->Html->image("https://graph.facebook.com/{$profile['Login']['fb_id']}/picture");?>
                    </div><!-- end .thumbFoto -->
                    <div class="detailProfile">
                        <span class="username"><?php echo $profile['Login']['name']?> - <a href="#" class="logout">Logout</a></span>
                        <span class="joinDate">Bergabung Sejak <?php echo date("d/m/Y",strtotime($profile['Login']['register_date']))?></span>
                        <span class="totalPoint"><?php echo number_format($point);?> Points</span>
                    </div>
                </div><!-- end .authorProfile -->
       		<?php else:?>
          	  <a title="login with facebook" class="loginFacebook" href="javascript:fblogin();">&nbsp;</a>
            <?php endif;?>
        	<a href="#" id="logo"><?php echo $this->Html->image('/img/logo.png');?></a>
			<?php if(isset($back_url)):?>
                <a class="btnBack" href="<?php echo $back_url;?>" title="back">&laquo; BACK</a>
            <?php endif;?>
        </div>
		<?php echo $this->element('navigation');?>
        <div id="body">
            <div id="wrapper">
               <?php echo $this->element('not_found');?>
            </div><!-- end #wrapper -->
        </div><!-- end #body -->
        <div id="hw">
            <div id="hwText"></div>
        </div><!-- end #hw -->
    </div><!-- end #universal -->
</div><!-- end #homePage -->

</body>
</html>