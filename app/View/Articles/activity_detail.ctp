
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
<div id="container">
    <div id="content" class="jurnalPageDetail">
        <div class="wrapper">
            <div class="w960 fl">
                <div id="hotNews">
                    <div class="titleBox title">
                        <h1 style="font-size:19px;"><a href="index.php?menu=journal-detail"><?php echo strip_tags($article['title'])?></a></h1>
                    </div><!-- end .titleBox -->
                    <div class="hotNewsImg">
                        <?php if(isset($MainImg)&&sizeof($MainImg)>0):
                              echo $this->Html->image("/content/images/big_{$MainImg[0]['filename']}"
                                                      ,array("width"=>"912px",
                                                            "style"=>"border:4px solid #333"));endif;?>
                    </div>
                </div>
            </div><!-- end .w960 -->
            <div class="line"></div>
            <div class="w600 fl">
                <div class="entry-post" style="padding:20px 0 10px 0">
                    <?php 
                        $LEGACY_PATH = Configure::read('Custom.LegacyPath');
                  
                        $article['content'] = from_legacy($article['content'],$LEGACY_PATH,Configure::read('Custom.DocumentRoot'));
                      
                      if(strlen($article['youtube_video'])>0){
                        echo "<div style=\"width:600px;float:left;margin-bottom: 10px;\">{$article['youtube_video']}</div>";
                       }
                       echo ($article['content']);
                      
                       ?>
                </div><!-- end .entry-info -->
                <div class="related-widget">
                	<h3 class="widget-title"><span>Artikel Terkait</span></h3>
                    <ul>
                    	<?php foreach($related_articles as $related):?>
                      
                      <?php $permalink = $this->Html->url('/articles/'.
                                        $related['Channel']['name_str'].
                                          '/'.$related['Category'][0]['name_str'].'/view/'.
                                          $related['Article']['id']);
                      ?>
                       <li>
                          <a href="<?=$permalink?>">
                            <?=h($related['Article']['title'])?>
                          </a>
                          <span class="date">19/01/2014</span>
                        </li>
                      <?php endforeach;?>
                    </ul>
                </div><!-- end #related-widget -->
                
               
                <div class="fb-comments" data-href="<?php echo $this->Html->url( "/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}", true ); ?>" data-num-posts="10" data-width="600"></div>
            </div><!-- end .w600 -->
            <div class="w300 fr">
                <div id="destinaionBox">
                    <h3><?php echo $this->Html->image('/img/new/t_adv_map.png');?></h3>
                    <h3><?=h($destination[0]['Article']['title'])?></h3>
                      <div class="newsImg">
                        <a href="<?=$this->Html->url($destination[0]['permalink'])?>">
                             <img src="<?=$this->Html->url('/content/images/thumb_'.
                                        $destination[0]['MainImg'][0]['filename'])?>" alt="">
                        </a>                                
                        <img src="<?=$this->Html->url('/imgforum/land_adventure.jpg')?>" class="journal-icon" alt=""> 
                        <div class="rate">
                            <?php for($i=0;$i<$destination[0]['ratings'];$i++):?>
                            <img src="<?=$this->Html->url('/img/star.png')?>" alt="">
                            <?php endfor;?>
                            <?php for($i=0;$i<(5-$destination[0]['ratings']);$i++):?>
                            <img src="<?=$this->Html->url('/img/star2.png')?>" alt="">
                            <?php endfor;?>
                            

                        </div><!-- end .rate -->                           
                    </div><!-- end .newsImg -->
                </div><!-- end #destinaionBox -->
                <div class="recent-widget widgets">
                	<h3 class="widget-title"><span>Recent News SuperAdventure</span></h3>
                    <ul>
                    	<?php foreach($adventure as $adv):?>
                      
                      <?php $permalink = $this->Html->url('/articles/'.
                                        $adv['Channel']['name_str'].
                                          '/'.$adv['Category'][0]['name_str'].'/view/'.
                                          $adv['Article']['id']);
                      ?>
                       <li>
                          <a href="<?=$permalink?>">
                            <?=h($adv['Article']['title'])?>
                          </a>
                          <span class="date">19/01/2014</span>
                        </li>
                      <?php endforeach;?>
                    </ul>
                </div><!-- end #journal-widget -->
                <div class="sideBanner widgets">
                    <?php echo $this->element('small_banner');?>
                </div>
                <div class="recent-widget widgets">
                	<h3 class="widget-title"><span>Recent News SuperMusic</span></h3>
                    <ul>
                    	<?php foreach($supermusic as $music):?>
                      <?php $permalink = $this->Html->url('/articles/music/view/'.
                                          $music['Article']['id']);
                      ?>
                       <li>
                          <a href="<?=$permalink?>">
                            <?=h($music['Article']['title'])?>
                          </a>
                          <span class="date">19/01/2014</span>
                        </li>
                      <?php endforeach;?>
                    </ul>
                </div><!-- end #journal-widget -->
                <div class="galeri-widget widgets">
                    <div id="tabs">
                          <ul>
                            <li><a href="#galeri-photo">Gallery Photo</a></li>
                            <li><a href="#galeri-video">Gallery Video</a></li>
                          </ul>
                          <div id="galeri-photo">
                            <?php foreach($gallery as $g):?>
                            <div class="boxImg">
                            <a  href="#" title="<?=h($g['Gallery']['caption'])?>" >
                              <img src="<?=$this->Html->url('/content/gallery/thumb_'.
                                    $g['Gallery']['filename'])?>" alt=""></a>                           
                             </div><!-- end .boxImg -->
                            <?php endforeach;?>
                          </div><!-- end #galeri-photo -->
                          <div id="galeri-video">
                            <?php foreach($video as $v):?>
                            <div class="boxImg">
                            <a  href="#" title="<?=h($v['Video']['caption'])?>" >
                              <img src="<?=$this->Html->url('/content/video/thumb_'.
                                    $v['Video']['snapshot'])?>" alt=""></a>                           
                             </div><!-- end .boxImg -->
                            <?php endforeach;?>
                            
                          </div><!-- end #galeri-video -->
                        </div>
                </div><!-- end #journal-widget -->
                <div id="journal-widget" class="widgets">
                  <?php echo $this->element('subscription');?>
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
		  url: '<?php echo $domain.$this->Html->url("/articles/{$cat['Channel']['name_str']}/{$cat['Category']['name_str']}/view/{$article['id']}");?>'+'?ajax=1&share_type=1&post_id='+intent_event.target.baseURI+'&tc=<?php echo "{$tc}";?>',
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