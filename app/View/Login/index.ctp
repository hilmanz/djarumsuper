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
            	<!--
			    <?php if(!isset($is_fb_login)):?>
            	<div id="loginFacebook">
            		<h1>Anda hanya perlu mengaktifkan account facebook dan klik tombol login di bawah ini untuk bergabung</h1>
            		<div class="fb-login-button" scope="read_stream,publish_stream,email,user_likes" data-redirect-uri="<?php echo Configure::read('Facebook.redirect_url')."?ok=1&rand=".rand(1000,999);?>">
				        Login with Facebook
				    </div>
            	</div>
            	<?php else:?>
            	<div class="myPoint">
            		<div class="headUser">
	            		<div class="thumbPhoto"><img src="https://graph.facebook.com/<?php echo $me['fb_id'];?>/picture"/></div>
                        <div class="userInfo">
	            		<span class="welcome">Halo <?php echo $me['name'];?></span>
						<span>Anda Memiliki <?php echo number_format(intval($point));?> poin</span>
                        </div>
				        <a class="logout" href="<?php echo $this->Html->url('/login/session_end');?>">Logout</a>
					</div>
					<div class="entry">
						<p>Anda dapat memperoleh poin dengan mengisi komentar artikel, men"share" artikel melalui facebook dan twitter, mengirim artikel melalui email.</p>
						<p>Silahkan keliling situs untuk membaca artikel terbaru kami, tentunya sambil menambah perolehan poin Anda.</p>
					</div>
            	</div>
            	<?php endif;?>
            -->
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
    	
    </div><!-- end #sidebar -->
</div><!-- end #container -->