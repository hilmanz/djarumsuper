<div id="header">
    <div id="banner" class="grad">
    	<div class="slider">
    		<?php if(isset($top_banners)):foreach($top_banners as $top_banner):?>
    		<?php 
				$image =  $this->Html->image("/content/banner/big_{$top_banner['Banner']['filename']}");
				if(@eregi("http://",$banners['Banner']['urlto'])){
					//this is an external link. so we add attribute target=_blank
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("target"=>"_blank","escape"=>false))."</div>";
				}else{
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("escape"=>false))."</div>";
				}
			?>
			<?php endforeach;endif;?>
    	</div>
    </div><!-- end #banner -->
</div><!-- end #header -->
<div id="container">
    <div id="content">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<div id="fb-root"></div>
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
			         FB.logout(function(response) {console.log('logout');});
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
                <div class="logoutBox">
                     <h1>Anda sudah berhasil logout.</h1>
                     <p>Jangan lupa kembali lagi untuk terus menambah nilai poin Anda.</p>
                </div>
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
    	<!--merchandise-->
        <?php echo $this->element('merchandise');?>
        <!--bannerSmall-->
        <?php echo $this->element('small_banner');?>
    </div><!-- end #sidebar -->
</div><!-- end #container -->