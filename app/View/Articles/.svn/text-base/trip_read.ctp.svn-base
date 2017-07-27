<script type="text/javascript" charset="utf-8">
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>
<script type="application/javascript">


	function postToFeed() {
        // calling the API ...
        var obj = {
          method: 'feed',
          link: '<?php echo $domain.$this->Html->url("/articles/trip/{$Province['name_str']}/{$category}/view/{$article['id']}");?>',
          picture: '<?php if(isset($MainImg[0]['filename'])):echo $domain.$this->Html->url("/content/images/thumb_{$MainImg[0]['filename']}");endif;?>',
          name: '<?php echo $article['title'];?>',
          caption: '<?php echo "http://www.djarum-super.com";?>',
          description: '<?php echo (addslashes(($article['summary'])));?>'
        };
        function callback(response) {
          $.ajax({
				  url: '<?php echo $this->Html->url("/articles/trip/{$Province['name_str']}/{$category}/view/{$article['id']}");?>'+'?ajax=1&share_type=2&post_id='+response['post_id']+'&tc=<?php echo "{$tc}";?>',
				  dataType: 'json',
				  success: function( response ) {
					console.log("share tracked");
				  }
			});
        }
        FB.ui(obj, callback);
      }
</script>
<div id="container">
    <div id="content" class="jurnalPageDetail">
        <div class="wrapper">
            <div class="w600 fl">
                <div id="hotNews">
                    <div class="titleBox title">
                        <h1><?php echo strip_tags($article['title'])?></h1>
                    </div><!-- end .titleBox -->
                    <div class="hotNewsImg">
                        <?php if(isset($MainImg)):
                        echo $this->Html->image("/content/images/medium_{$MainImg[0]['filename']}",
                                                array('width'=>'580px'));endif;?>
                    </div>
                </div>
            </div><!-- end .w600 -->
            <div class="w300 fr">
                <div id="advMaps">
                    <div class="title">
                       <!-- <h1 style="font-size:18px;">&raquo; <?=$Province['name']?></h1>-->
                        <h2 class="titleBox">ADVENTURE MAP</h2>
                    </div><!-- end .title -->
                    <div class="entry">
                       <iframe width="300" height="225" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&saddr=<?=$article['lat']?>,<?=$article['lon']?>+&aq=&sll=<?=$article['lat']?>,<?=$article['lat']?>&sspn=0.012096,0.021136&ie=UTF8&t=m&z=6&ll=<?=$article['lat']?>,<?=$article['lon']?>&output=embed"></iframe>
                    </div><!-- end .entry -->
                </div><!-- end #advMap -->
                <div class="post-info">
              <div class="author">
                  <span>Author : </span>
                    <span class="author-name"><?php echo $author['name'];?></span>
                </div>
               <div class="rate">
                    <span>Level Tantangan :</span>
                    <?php 
                      if(isset($rate)){
                          for($i=0;$i<$rate;$i++){
                         echo $this->Html->image('/img/star.png');
                        }
                     }else{
                      for($i=0;$i<5;$i++){
                        echo $this->Html->image('/img/star2.png');
                      }
                    }
                    ?>
                </div><!-- end .rate -->
                <div class="rate rateThis">
                    <span>Beri Level :</span>
          <div class="rateme"></div>
          <script>
            $(".rateme").rateme({disableAfterClick:true,source:"<?=$this->Html->url('/img/')?>",onComplete:function(response){
              console.log(response);
              $.ajax({
                url: '<?=$this->Html->url("/articles/rate?id={$article['id']}")?>&point='+response,
                dataType: 'json',
                success: function(rs){
                  if(rs.status==1){
                    console.log('voted');
                  }
                }});
            }});
          </script>
                </div><!-- end .rate -->
                <?php

                   $permalink = $this->Html->url( "/articles/trip/{$Province['name_str']}/{$category}/view/{$article['id']}", true ); 
                    ?>
                <div class="share">
                    <a href="https://plus.google.com/share?url=<?=$permalink?>" 
                                      onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/>
                                    </a>
                    <a href="javascript:void(0);return false;" onclick="postToFeed();return false;" class="iconFacebook">&nbsp;</a>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?=$article['summary']?>" data-size='large' data-count='none' data-url="<?php echo $permalink?>" data-via="myadventure" data-hashtags="myadventure"></a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div><!-- end .share -->
            </div><!-- end .post-info -->
            </div><!-- end .w300 -->
            
            <div class="line"></div>
            <div class="w600 fl">
                <div class="entry-post">
                    <?php 
                       //we need to check the source of images and videos path for article imported from old website.
                      ///uploads
                      //fileadmin/user_uploads/
                        
                        $LEGACY_PATH = Configure::read('Custom.LegacyPath');
                        
                      
                        $article['content'] = from_legacy($article['content'],$LEGACY_PATH,Configure::read('Custom.DocumentRoot'));
                         if(strlen($article['youtube_video'])>0){
                        echo "<div style=\"width:600px;float:left;margin-bottom: 10px;\">{$article['youtube_video']}</div>";
                       }
                       echo utf8tohtml($article['content']);
                      
                       
                       ?>
                       <a href="<?=$this->Html->url('/articles/submit/trip')?>" class="submitArticle">Submit Article</a>
                </div><!-- end .entry-info -->
               
                <!-- review comments here -->

                <!--widget daftar komentar -->
                 <?php echo $this->element('comment_widget',array('article_id'=>$article['id']));?>

                <!-- end of widget daftar komentar -->
                <?php if(isset($fb_id)):?>
                  <div id="respond" class="replies form-review hide">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
                      <thead>
                          <tr>
                              <th colspan="3">
                                  <span>Kirim Review</span>
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td valign="top">
                      <?php echo $this->Form->create(null,array('url'=>'/articles/send_comment','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'replyForm theForm'));?>
                                      <div class="row">
                                          <label>Subject :</label>
                                          <input name="subject" type="text"/>
                                      </div>
                                      <div class="row">
                                          <label>Rating Artikel :</label>
                                          <select name="rating">
                                            <option value="1">Jelek Sekali</option>
                                            <option value="2">Jelek</option>
                                            <option value="3">Lumayan</option>
                                            <option value="4">Bagus</option>
                                            <option value="5">Bagus Sekali</option>
                                          </select>
                                      </div>
                                      <div class="row">
                                          <label>Komentar Kamu :</label>
                                          <textarea name="message"></textarea>
                                      </div>
                                      <div class="rowSubmit">
                                          <input type="hidden" name="fb_id" value="<?php echo $fb_id;?>"/>
                                          <input type="hidden" id="post_id" 
                                              name="post_id" value="<?php echo $article['id']?>"/>
                                          <input type="hidden" name="return" value="<?=$this->request->here?>"/>
                                          <input type="submit" value="KIRIM" />
                                      </div>
                                  <?php echo $this->Form->end();?>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                  </div><!-- end .replies -->
                 <?php else:?>
                  <div class="notLoginMessage">Untuk bisa mengirimkan review, silahkan <a href="javascript:fblogin();">Login</a> terlebih dahulu.</div>
                  <?php endif;?>
                <!-- end of review comments -->
               <?php echo $this->element('on_the_go_widget');?>
            </div><!-- end .w600 -->
            <div class="w300 fr">
                <div class="sideBanner">
                    
                    <?php echo $this->element('small_banner');?>
                </div>
                <div id="journal-widget">
                	<?php echo $this->element('other_trip_feature');?>
                </div><!-- end #journal-widget -->
            </div><!-- end .w600 -->
        </div><!-- end .wrapper -->
    </div><!-- end #content -->
</div><!-- end #container -->
<script type="application/javascript">
  // Define our custom event hanlders
  function onTweet(intent_event) {
    if (intent_event) {
      var label = intent_event.region;
     
       $.ajax({
		  url: '<?php echo $domain.$this->Html->url("/articles/trip/{$category}/view/{$article['id']}");?>'+'?ajax=1&share_type=1&post_id='+intent_event.target.baseURI+'&tc=<?php echo "{$tc}";?>',
		  dataType: 'json',
		  success: function( response ) {
			console.log("share tracked");
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