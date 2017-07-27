<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport,adventure,travel,indonesia "/>
<META NAME="description" CONTENT="My Adventure - Where Adventurers Gather,Travel Indonesia, Adventure Indonesia">
<title>My Adventure - Where Adventurers Gather,Travel Indonesia, Adventure Indonesia</title>
<?php echo $this->Html->charset('utf-8'); ?>
<?php echo $this->Html->meta('icon', 'img/favicon.ico');?>
<?php echo $this->Html->css(array('skin','flexslider','minimalist/jquery.slider','jquery.ui.datepicker.css','jquery.ui.theme.css','jquery.ui.core.css','djarum')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('php.default.min','jquery-1.10.2','underscore-min','backbone-min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min','prefixfree.min','jquery.flexslider-min','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack','jquery.ui.core.js','jquery.ui.widget.js','jquery.ui.datepicker.js','string.min'));?>
                                 
<?php echo $this->fetch('css');?>
<?php echo $this->fetch('script');?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
<?php $login_next_url = Configure::read('Facebook.redirect_url')."?ok=1&rand=".rand(1000,999);?>
function fblogin() {
	try{
		FB.login(function(response) {
		    if (response.authResponse) {
           console.log('Welcome!  Fetching your information.... ');
           FB.api('/me', function(response) {
              console.log('Good to see you, ' + response.name + '.');
              window.location = window.location;
              document.location = '<?=$login_next_url?>';
           });
         } else {
            console.log('User cancelled login or did not fully authorize.');
             document.location = "<?=$this->Html->url('/')?>";
         }
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
         <?php echo $this->Html->image('/img/new/header.jpg');?>
        </div><!-- end #top -->
        <div id="header">
        	<div class="headerImg">
                  <div class="flexslider">
                      <ul class="slides">
							<?php if(isset($head_banners)&&sizeof($head_banners)>0):?>
                                <?php 
                          for($i=0;$i<sizeof($head_banners);$i++):
                          ?>
                          <li>
                          <?php
                                      $image =  $this->Html->image("/content/banner/980x425_{$head_banners[$i]['Banner']['filename']}");
            
                                        if(@eregi("http://",$head_banners[$i]['Banner']['urlto'])){
                                            //this is an external link. so we add attribute target=_blank
                                            echo $this->Html->link($image,$head_banners[$i]['Banner']['urlto'],array("target"=>"_blank","escape"=>false));
                                        }else{
                                            echo $this->Html->link($image,$head_banners[$i]['Banner']['urlto'],array("escape"=>false));
                                        }
                          ?>
                          </li>
                               <?php endfor;?>
							<?php else:?>	
                                        <li>
                                            <a href="#" title="Slide 3" target="_blank"><?php echo $this->Html->image('/content/banner/head_banner2.jpg');?></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Slide 3" target="_blank"><?php echo $this->Html->image('/content/banner/head_banner.jpg');?></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Slide 3" target="_blank"><?php echo $this->Html->image('/content/banner/head_banner3.jpg');?></a>
                                        </li>
                            <?php endif;?>
                        </div>
                    </ul>
                  </div>
			     <?php if(isset($fb_id)):?>
                <div class="authorProfile">
                    <div class="thumbFoto">
                        <?php echo $this->Html->image("https://graph.facebook.com/{$profile['Login']['fb_id']}/picture");?>
                    </div><!-- end .thumbFoto -->
                    <div class="detailProfile">
                        <span class="username"><?php echo $profile['Login']['name']?> - <a href="<?=$fb_logout_url?>" class="logout">Logout</a></span>
                        <span class="user-badges">
                          <?php
                            $badges = array(0,3,5);
                          ?>
                            <?php for($i=0;$i<$badges[$profile['Login']['role']];$i++):?>
							             <?php echo $this->Html->image('/img/star.png');?>
                            <?php endfor;?>
                        </span>
                        <span class="joinDate">Bergabung Sejak <?php echo date("d/m/Y",strtotime($profile['Login']['register_date']))?></span>
                        <span class="totalPoint"><?php echo number_format($point);?> Points</span>
                    </div>
                </div><!-- end .authorProfile -->
       		<?php else:?>
              <!--   <div class="loginbox">
          	 		 <a title="login with facebook" class="loginFacebook" href="javascript:fblogin();">&nbsp;</a>
                </div> end .loginbox -->
            <?php endif;?>
			<?php if(isset($back_url)):?>
                <a class="btnBack" href="<?php echo $back_url;?>" title="back">&laquo; BACK</a>
            <?php endif;?>
        </div>
		<?php 
      if(!$hide_navigation):
        echo $this->element('navigation');
      endif;
    ?>
        <div id="body">
            <div id="wrapper">
                <?php echo $this->fetch("content");?>
            </div><!-- end #wrapper -->
        </div><!-- end #body -->
    </div><!-- end #universal -->
    <div id="hw">
        <div id="hwText"></div>
    </div><!-- end #hw -->
    <div id="footBottom"></div>
</div><!-- end #homePage -->
<?php if(!$age_verified):?>
  <div id="popup-verification">
    <div class="popup-content">
        <h3>Situs ini hanya diperuntukkan pengunjung usia 18 tahun keatas, Saya berumur 18 tahun atau lebih</h3>
          <a href="#" class="button btn-age-yes">Yes</a> <a href="#" class="button btn-age-no">No</a>
      </div><!-- end .popup-content -->
  </div><!-- end #popup-verification -->
  <div id="bgPopup2"></div>
  <script type="text/javascript">
        
            $("a.btn-age-yes").click(function(e){
              api_call('<?=$this->Html->url('/profile/age_verification/1')?>',function(response){
                if(response.status==1){
                    $("#popup-verification").hide();
                    $("#bgPopup2").hide();
                }
              });
            });
            $("a.btn-age-no").click(function(e){
              api_call('<?=$this->Html->url('/profile/age_verification/0')?>',function(response){
                if(response.status==1){
                    //jQuery("#popup-verification").hide();
                    document.location="<?=$this->Html->url('/pages/age_invalid')?>";
                }
              });
            });
        
    </script> 
<?php endif;?>
  <?php echo $this->element('sql_dump'); ?>
</body>
</html>
