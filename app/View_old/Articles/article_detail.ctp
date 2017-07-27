<script type="text/javascript" charset="utf-8">
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>
<div id="header">
    <div id="banner" class="grad">
    	<?php if(isset($MainImg)):echo $this->Html->image("/content/images/{$MainImg[0]['filename']}");endif;?>
    </div><!-- end #banner -->
</div><!-- end #header -->
<div id="container">
	 <div id="fb-root"></div>
    <div id="content">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
                <div class="title">
                    <h1><?php echo strip_tags($article['title'])?></h1>
                    <span class="author">Penulis : <?php echo $author['name'];?></span>
                    <span class="dates"><?php echo date("d.m.Y",strtotime($article['created_time']));?></span>
                </div>
                <div class="entry entry-detail">
                   <?php 
                   //we need to check the source of images and videos path for article imported from old website.
                  ///uploads
				  //fileadmin/user_uploads/
				  	
					$LEGACY_PATH = Configure::read('Custom.LegacyPath');
					if(!@eregi("src=\"http\:\/\/", $article['content'])){
	                   $article['content'] = str_replace("/uploads/","___uploads/",$article['content']);
					   $article['content'] = str_replace("___uploads/","{$LEGACY_PATH}/uploads/",$article['content']);
					   $article['content'] = str_replace("fileadmin/user_uploads/","{$LEGACY_PATH}/fileadmin/user_uploads/",$article['content']);
					}
				  // $article['content'] = iconv("UTF-8", "UTF-16LE//TRANSLIT", $article['content']);
                   echo utf8tohtml($article['content']);
                  // echo ($article['content']);
				   if(strlen($article['youtube_video'])>0){
				   	echo $article['youtube_video'];
				   }
                   ?>
                </div>
                <div class="social">
                	<div class="twitThis">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $this->Html->url( "/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}", true ); ?>" data-via="djarum" data-hashtags="djarum">Tweet</a>
        				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div><!-- end .twitThis -->
                    <div class="fbLike">
                       
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo Configure::read('Facebook.appId');?>";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <script type="application/javascript">
                        	function postToFeed() {
						        // calling the API ...
						        var obj = {
						          method: 'feed',
						          link: '<?php echo $domain.$this->Html->url("/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}");?>',
						          picture: '<?php if(isset($MainImg[0]['filename'])):echo $domain.$this->Html->url("/content/images/thumb_{$MainImg[0]['filename']}");endif;?>',
						          name: '<?php echo $article['title'];?>',
						          caption: '<?php echo "http://www.djarum-super.com";?>',
						          description: '<?php echo ($article['summary']);?>'
						        };
						        function callback(response) {
						          $.ajax({
										  url: '<?php echo $this->Html->url("/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}");?>'+'?ajax=1&share_type=2&post_id='+response['post_id']+'&tc=<?php echo "{$tc}";?>',
										  dataType: 'json',
										  success: function( response ) {
											console.log("share tracked");
										  }
									});
						        }
						        FB.ui(obj, callback);
						      }
                        </script>
                    	<!--<div class="fb-send" data-href="<?php echo $this->Html->url( "/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}", true ); ?>"></div>-->
                    	<!--<div class="fb-send" data-href="http://www.google.com"></div>-->
                    	<a href="javascript:void(0);return false;" onclick="postToFeed();return false;" class="shareFB">&nbsp;</a>
                    </div><!-- end .fbLike -->
                    
                    <div class="emailBox">
                    	<?php $article_link = $crypto->urlencode64($this->Html->url("/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}",true));?>
                    	<a href="<?php echo $this->Html->url("/share/send/{$article['id']}?r=".$article_link,true);?>" class="emailIcon">&nbsp;</a>
                    </div>
                </div><!-- end .social -->
                <div class="social">
                	<div class="fb-comments" data-href="<?php echo $this->Html->url( "/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}", true ); ?>" data-num-posts="5" data-width="470"></div>
                </div>
            </div><!-- end .paper -->
        </div><!-- end .content -->
    </div><!-- end #content -->
    <div id="sidebar">
    	<?php if(!$air):?>
    	<div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/air.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'air')
										));
			?>
        </div><!-- end .box -->
        <?php endif;?>
        <?php if(!$water):?>
        <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/water.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'water')
										));
			?>
        </div><!-- end .box -->
        <?php endif;?>
        <?php if(!$land):?>
        <div class="box grad bannerSmall">
          <?php echo $this->Html->image("/content/banner/land.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'land')
										));
			?>
        </div>
        <?php endif;?>
        <!-- end .box -->
       <!-- widget lainnya -->
       <?php echo $this->element('other_feature');?>
    </div><!-- end #sidebar -->
</div><!-- end #container -->
<!--twitter events-->

<script type="application/javascript">
  // Define our custom event hanlders
  function onTweet(intent_event) {
    if (intent_event) {
      var label = intent_event.region;
      //console.log(intent_event);
      //console.log("tweet nih");
       $.ajax({
		  url: '<?php echo $this->Html->url("/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}");?>'+'?ajax=1&share_type=1&post_id='+intent_event.target.baseURI+'&tc=<?php echo "{$tc}";?>',
		  dataType: 'json',
		  success: function( response ) {
			//console.log("share tracked");
		  }
	});
    };
  }	
 // Wait for the asynchronous resources to load
 twttr.ready(function (twttr) {
 // Now bind our custom intent events
  twttr.events.bind('tweet',onTweet);
});
</script>