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
<?php echo $this->Html->css(array('djarum','skin','minimalist/jquery.slider','jquery.ui.datepicker.css','jquery.ui.theme.css','jquery.ui.core.css')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('php.default.min','jquery-1.4.3.min','underscore-min','backbone-min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack','jquery.ui.core.js','jquery.ui.widget.js','jquery.ui.datepicker.js','jquery.ba-bbq.min'));?>
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
<script type="application/javascript">
tripUrl = "<?php echo $this->Html->url('/articles/trip');?>";	
imgpath = "<?php echo $this->Html->url('/content/images');?>";	
</script>

</head>

<body>
<div id="fb-root"></div>
 
<?php if(!isset($container_style)){$container_style="homePage";}?>
<div id="homePage" class="<?php echo $container_style;?>">
	<div id="universal">
        <div id="top">
        	<span id='top_banner1'>
          <?php if(isset($top_banners)):?>
        <?php 
          $image =  $this->Html->image("/content/banner/726x100_{$top_banners[0]['Banner']['filename']}");
          if(@eregi("http://",$top_banners[0]['Banner']['urlto'])){
            //this is an external link. so we add attribute target=_blank
            echo $this->Html->link($image,$top_banners[0]['Banner']['urlto'],array("target"=>"_blank","escape"=>false));
          }else{
            echo $this->Html->link($image,$top_banners[0]['Banner']['urlto'],array("escape"=>false));
          }
        ?>

        <?php endif;?>
        </span>
         <span id='top_banner2'>
        <?php if(isset($top_banners_small)&&sizeof($top_banners_small)>0):
       
        ?>
        <?php 
          $image =  $this->Html->image("/content/banner/254x100_{$top_banners_small[0]['Banner']['filename']}");
          if(@eregi("http://",$top_banners_small[0]['Banner']['urlto'])){
            //this is an external link. so we add attribute target=_blank
            echo $this->Html->link($image,$top_banners_small[0]['Banner']['urlto'],array("target"=>"_blank","escape"=>false));
          }else{
            echo $this->Html->link($image,$top_banners_small[0]['Banner']['urlto'],array("escape"=>false));
          }
        ?>
        
        <?php endif;?>
        </span>
        </div><!-- end #top -->
        <div id="header">
        	<div class="headerImg">
        		<?php if(isset($head_banners)&&sizeof($head_banners)>0):?>
        			<?php 
						$image =  $this->Html->image("/content/banner/980x425_{$head_banners[0]['Banner']['filename']}");
						if(@eregi("http://",$head_banners[0]['Banner']['urlto'])){
							//this is an external link. so we add attribute target=_blank
							echo $this->Html->link($image,$head_banners[0]['Banner']['urlto'],array("target"=>"_blank","escape"=>false));
						}else{
							echo $this->Html->link($image,$head_banners[0]['Banner']['urlto'],array("escape"=>false));
						}
					?>
        		<?php else:?>			
                	<?php echo $this->Html->image('/content/banner/head_banner.jpg');?>
                <?php endif;?>
               <!-- <?php echo $this->Html->image("/img/cloud.png", array("class" => "cloud")); ?>-->
            </div>
            <div class="headerText">
            	<h1><span>MY</span>ADVENTURE<small>.co.id</small></h1>
                <h2>Where adventurers gather</h2>
            </div>
			<?php if(isset($fb_id)):?>
                <div class="authorProfile">
                    <div class="thumbFoto">
                        <?php echo $this->Html->image("https://graph.facebook.com/{$profile['Login']['fb_id']}/picture");?>
                    </div><!-- end .thumbFoto -->
                    <div class="detailProfile">
                        <span class="username"><?php echo $profile['Login']['name']?> - <a href="<?=$fb_logout_url?>" class="logout">Logout</a></span>
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
                  <div id="tripContainer">
                      <div id="peta">
                          <?php echo $this->Html->image("indonesia.jpg",array("border"=>0,
                                                    "usemap"=>"#Map"));
                      ?>
                            <map name="Map" id="Map">
                              <area class="viewPopup showPopup" shape="rect" coords="46,60,83,73" href="#mapGallery" onclick="open_article(1);return false;" data-city="1"/>
                              <area class="viewPopup showPopup" shape="rect" coords="98,94,157,121" href="#mapGallery" onclick="open_article(2);return false;" data-city="2"/>
                              <area class="viewPopup showPopup" shape="rect" coords="92,181,153,208" href="#mapGallery" onclick="open_article(3);return false;" data-city="3"/>
                              <area class="viewPopup showPopup" shape="rect" coords="150,146,184,159" href="#mapGallery" onclick="open_article(4);return false;" data-city="4"/>
                              <area class="viewPopup showPopup" shape="rect" coords="171,188,211,204" href="#mapGallery" onclick="open_article(5);return false;" data-city="5"/>
                              <area class="viewPopup showPopup" shape="rect" coords="123,228,185,243" href="#mapGallery" onclick="open_article(6);return false;" data-city="6"/>
                              <area class="viewPopup showPopup" shape="rect" coords="202,217,259,242" href="#mapGallery" onclick="open_article(7);return false;" data-city="7"/>
                              <area class="viewPopup showPopup" shape="rect" coords="235,118,299,145" href="#mapGallery" onclick="open_article(8);return false;" data-city="8"/>
                              <area class="viewPopup showPopup" shape="rect" coords="328,157,396,184" href="#mapGallery" onclick="open_article(9);return false;" data-city="9"/>
                              <area class="viewPopup showPopup" shape="rect" coords="266,196,322,223" href="#mapGallery" onclick="open_article(10);return false;" data-city="10"/>
                              <area class="viewPopup showPopup" shape="rect" coords="379,195,448,220" href="#mapGallery" onclick="open_article(11);return false;" data-city="11"/>
                              <area class="viewPopup showPopup" shape="rect" coords="445,226,514,252" href="#mapGallery" onclick="open_article(12);return false;" data-city="12"/>
                              <area class="viewPopup showPopup" shape="rect" coords="484,195,538,223" href="#mapGallery" onclick="open_article(13);return false;" data-city="13"/>
                              <area class="viewPopup showPopup" shape="rect" coords="442,125,517,155" href="#mapGallery" onclick="open_article(14);return false;" data-city="14"/>
                              <area class="viewPopup showPopup" shape="rect" coords="545,131,611,145" href="#mapGallery" onclick="open_article(15);return false;" data-city="15"/>
                              <area class="viewPopup showPopup" shape="rect" coords="621,99,682,127" href="#mapGallery" onclick="open_article(16);return false;" data-city="16"/>
                              <area class="viewPopup showPopup" shape="rect" coords="661,167,711,194" href="#mapGallery" onclick="open_article(17);return false;" data-city="17"/>
                              <area class="viewPopup showPopup" shape="rect" coords="581,240,645,268" href="#mapGallery" onclick="open_article(18);return false;" data-city="18"/>
                              <area class="viewPopup showPopup" shape="rect" coords="551,172,612,203" href="#mapGallery" onclick="open_article(19);return false;" data-city="19"/>
                              <area class="viewPopup showPopup" shape="rect" coords="812,181,878,215" href="#mapGallery" onclick="open_article(20);return false;" data-city="20"/>
                              <area class="viewPopup showPopup" shape="rect" coords="919,242,964,259" href="#mapGallery" onclick="open_article(21);return false;" data-city="21"/>
                              <area class="viewPopup showPopup" shape="rect" coords="694,261,746,281" href="#mapGallery" onclick="open_article(22);return false;" data-city="22"/>
                              <area class="viewPopup showPopup" shape="rect" coords="493,257,555,281" href="#mapGallery" onclick="open_article(23);return false;" data-city="23"/>
                              <area class="viewPopup showPopup" shape="rect" coords="564,356,652,379" href="#mapGallery" onclick="open_article(24);return false;" data-city="24"/>
                              <area class="viewPopup showPopup" shape="rect" coords="473,314,566,341" href="#mapGallery" onclick="open_article(25);return false;" data-city="25"/>
                              <area class="viewPopup showPopup" shape="rect" coords="435,330,465,345" href="#mapGallery" onclick="open_article(26);return false;" data-city="26"/>
                              <area class="viewPopup showPopup" shape="rect" coords="378,314,417,342" href="#mapGallery" onclick="open_article(27);return false;" data-city="27"/>
                              <area class="viewPopup showPopup" shape="rect" coords="317,298,364,326" href="#mapGallery" onclick="open_article(28);return false;" data-city="28"/>
                              <area class="viewPopup showPopup" shape="rect" coords="260,286,313,298" href="#mapGallery" onclick="open_article(29);return false;" data-city="29"/>
                              <area class="viewPopup showPopup" shape="rect" coords="257,326,294,353" href="#mapGallery" onclick="open_article(30);return false;" data-city="30"/>
                              <area class="viewPopup showPopup" shape="rect" coords="303,349,379,370" href="#mapGallery" onclick="open_article(31);return false;" data-city="31"/>
                              <area class="viewPopup showPopup" shape="rect" coords="176,262,233,276" href="#mapGallery" onclick="open_article(32);return false;" data-city="32"/>
                              <area class="viewPopup showPopup" shape="rect" coords="203,309,251,329" href="#mapGallery" onclick="open_article(33);return false;" data-city="33"/>
                            </map>
                      </div>
                    <div class="tagline">
                      <h1>Klik Kota Untuk Melihat Pengalaman-Pengalaman Seru!</h1>
                    </div>
                    <!--
                    mini counters
                    -->
                    <div class="minicounts">
                     
                      <span class='ctLand'>
                    
                        <?php
                        echo $this->Html->image('/imgforum/land_adventure.jpg',
                                                array('class'=>'journal-icon','escape'=>false,'style'=>'width:20px;'));
                        ?> <span class="ctCount">Land (<?=$trip_count['land']?>)</span>
                      </span>
                      <span class='ctAir'>
                        <?php
                        echo $this->Html->image('/imgforum/traveller.jpg',
                                                array('class'=>'journal-icon','escape'=>false,'style'=>'width:20px;'));
                        ?> <span class="ctCount">Air (<?=$trip_count['air']?>)</span>
                      </span>
                      <span class='ctWater'>
                        <?php
                        echo $this->Html->image('/imgforum/water_adventure.jpg',
                                                array('class'=>'journal-icon','escape'=>false,'style'=>'width:20px;'));
                        ?> <span class="ctCount">Water (<?=$trip_count['water']?>)</span>
                      </span>
                    </div>

                </div>
                <div id="mapGallery" class="popup" style="display:none;">
                    <div class="popupContent2">
                        <a class="popupClose" href="#">X</a>
                        <div class="contentPopup">
                            <?php echo $this->Html->image('/content/trip/thumb/1.jpg');?>
                            <?php echo $this->Html->image('/content/trip/thumb/2.jpg');?>
                            <?php echo $this->Html->image('/content/trip/thumb/3.jpg');?>
                            <?php echo $this->Html->image('/content/trip/thumb/4.jpg');?>
                            <?php echo $this->Html->image('/content/trip/thumb/5.jpg');?>
                            <?php echo $this->Html->image('/content/trip/thumb/6.jpg');?>
                            <div class="summaryContent">
                             <p>Menghabiskan waktu pergantian tahun di puncak bayangan Gunung Penanggungan, ditemani gemerlap kembang api yang menyatu dengan lampu kota.</p>
                             <a href="#" class="viewAll">Lihat Semua &raquo;</a>
                            </div>
                        </div><!-- end .contentPopup -->
                    </div><!-- end .popupContent -->
                </div><!-- end #mapGallery -->
                <div id="bgPopup"></div>
            </div><!-- end #wrapper -->
        </div><!-- end #body -->
    </div><!-- end #universal -->
    <div id="hw">
        <div id="hwText"></div>
    </div><!-- end #hw -->
    <div id="footBottom"></div>
</div><!-- end #homePage -->
<!--mini popup counter -->
<div class="minipopup" style="position:absolute;top:100px;left:100px;min-width:130px;height:130px;background-color:#000;border: 3px solid #333;display:none; padding:10px;">
  <div class="ctLoader">
    Loading...
  </div>
  <div class='ctLand'>
    <?php
    echo $this->Html->image('/imgforum/land_adventure.jpg',
                            array('class'=>'journal-icon','escape'=>false,'style'=>'width:35px;'));
    ?> Land (<span class="ctCount">0</span>)
  </div>
  <div class='ctAir'>
    <?php
    echo $this->Html->image('/imgforum/traveller.jpg',
                            array('class'=>'journal-icon','escape'=>false,'style'=>'width:35px;'));
    ?> Air (<span class="ctCount">0</span>)
  </div>
  <div class='ctWater'>
    <?php
    echo $this->Html->image('/imgforum/water_adventure.jpg',
                            array('class'=>'journal-icon','escape'=>false,'style'=>'width:35px;'));
    ?> Water (<span class="ctCount">0</span>)
  </div>
</div>
<script>
var is_open = false;
var current_id = 0;
$('area').live('mouseover',function(event){
  if(!is_open){
    if(current_id!=parseInt($(this).data('city'))){
      article_counts(parseInt($(this).data('city')));
      current_id = parseInt($(this).data('city'));
    }
    $(".minipopup").css('top',event.pageY-50);
    $(".minipopup").css('left',event.pageX+50);
    $(".minipopup").fadeIn();
    is_open = true;
  }
});
$('area').live('mouseout',function(event){
  if(is_open){
    $(".minipopup").hide();
    is_open = false;
  }
});
</script>
</body>
</html>
