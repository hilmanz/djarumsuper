<script type="text/javascript" charset="utf-8">
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>
<script type="application/javascript">
    function postToFeed(url,picture,name,caption,description,tc) {
        // calling the API ...
        var obj = {
          method: 'feed',
          link: url,
          picture: picture,
          name: name,
          caption: caption,
          description: description
        };
        function callback(response) {
          $.ajax({
                  url: url+'?ajax=1&share_type=2&post_id='+response['post_id']+'&tc='+tc,
                  dataType: 'json',
                  success: function( response ) {
                    
                  }
            });
        }
        FB.ui(obj, callback);
      }
</script>
<div id="container">
    <div id="content" class="jurnalPage">
        <div class="wrapper">
            <div id="journal" class="theList">
                <div class="headTitle">
                    <?php
                    if(!isset($air)):$air=null;endif;
                    if(!isset($water)):$water=null;endif;
                    if(!isset($land)):$land=null;endif;
                    if($air){ ?>
                        <h1>AIR</h1>
                        <?php }
                    if($water){ ?>
                        <h1>WATER</h1>
                        <?php }
                    if($land){ ?>
                        <h1>LAND</h1>
                        <?php }
                    ?>
                </div>
                
                <?php if(isset($posts)):foreach($posts as $p):?>
                    <div class="listJournal row2">  
                        <div class="w300 fl">
                            <div class="newsImg">
                                <?php if(!isset($p['MainImg'][0]['filename'])){$p['MainImg'][0]['filename'] = "";}?>
                                <?php echo $this->Html->image("/content/images/thumb_".$p['MainImg'][0]['filename'], array(
                                            'url' => array('controller' => 'articles', 'action' => $channel_name, $p['Category']['name_str'],'view',$p['Article']['id'])
                                            ));
                                ?>
                                <?php
                                if(!isset($air)):$air=null;endif;
                                if(!isset($water)):$water=null;endif;
                                if(!isset($land)):$land=null;endif;
                                if($air){ 
                                    echo $this->Html->image('/imgforum/traveller.jpg',
                                                                array('class'=>'journal-icon','escape'=>false));
                                         }
                                if($water){ 
                                    echo $this->Html->image('/imgforum/water_adventure.jpg',
                                                                    array('class'=>'journal-icon','escape'=>false));
                                         }
                                if($land){ 
                                    echo $this->Html->image('/imgforum/land_adventure.jpg',
                                                                array('class'=>'journal-icon','escape'=>false));
                                   }
                                ?>
                            </div>
                        </div><!-- end .w440 -->
                        <div class="w620 fl">
                            <div class="excerpt">
                                <div class="titleBox title">
                                    <h1><?php echo $this->Html->link($p['Article']['title'],array('controller' => 'articles', 'action' => $channel_name, $p['Province']['name_str'],$p['Category']['name_str'],'view',$p['Article']['id']));?></h1>
                                    <span class="date" style="float:left;margin-top: -12px;"><?=to_date($p['Article']['created_time'],false)?></span>
                                </div><!-- end .titleBox -->
                                <div class="entry">
                                  <p><?php echo $p['Article']['summary']?></p>
                                </div>
                                <div class="rate">
                                   
                                   <?php
                                        $n_rate = intval(@$p['rate']);
                                        if($n_rate<5){
                                            $n_disabled = 5 - $n_rate;
                                        }else{
                                            $n_disabled = 0;
                                        }
                                        for($i=0;$i<$n_rate;$i++){
                                            echo $this->Html->image('/img/star.png');
                                        }
                                        
                                        for($i=0;$i<$n_disabled;$i++){
                                            echo $this->Html->image('/img/star2.png');
                                        }
                                        
                                    ?>
                                </div>
                                <div class="rowsBtn">
                                    <?php echo $this->Html->link("Read More &raquo;",array('controller' => 'articles', 'action' => $channel_name, $p['Province']['name_str'],$p['Category']['name_str'],'view',$p['Article']['id']),array('class'=>'readmore2','escape'=>false));?>
                                    <?php 

                                        $permalink = $domain.$this->Html->url(array('controller' => 'articles', 
                                                                            'action' => $channel_name, 
                                                                                        $p['Province']['name_str'],
                                                                                        $p['Category']['name_str'],
                                                                                        'view',
                                                                                        $p['Article']['id']),
                                                                        array('class'=>'readmore','escape'=>false));
                                        $picture = $domain.$this->Html->url("/content/images/thumb_".$p['MainImg'][0]['filename']);
                                        $name = ($p['Article']['title']);
                                        $caption = "My Adventure";
                                        $description = ($p['Article']['summary']);
                                        $twittext = substr($description,0,140-strlen($permalink))."... ";

                                        ?>
                                </div>
                                <div class="share">
                                   <a href="https://plus.google.com/share?url=<?=$permalink?>" 
                                      onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/>
                                    </a>
                                    <a href="javascript:void(0);return false;" onclick="postToFeed('<?=$permalink?>','<?=$picture?>','<?=$name?>','<?=$caption?>','<?=$description?>','<?=$p['tc']?>');return false;" class="iconFacebook">&nbsp;</a>
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?=$twittext?>" data-size='large' data-count='none' data-url="<?php echo $permalink.""?>" data-via="myadventure" data-hashtags="myadventure"></a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                </div>
                            </div><!-- end .excerpt -->
                        </div><!-- end .w220 -->
                    </div><!-- end .listJournal -->
                <div class="line"></div>
                <?php endforeach;endif;?>
                <?php if(isset($this->Paginator)):?>
                <div class="paging">
                    <!-- Shows the next and previous links -->
                    <div class="pagePrev">
                        <?php echo @$this->Paginator->prev('«', null, null, array('class' => 'disabled')); ?>
                    </div>
                    <!-- Shows the page numbers -->
                    <div class="pageNumber">
                        <?php echo @$this->Paginator->numbers(); ?>
                    </div>
                    <div class="pageNext">
                        <?php echo @$this->Paginator->next('»', null, null, array('class' => 'disabled')); ?> 
                    </div>
                    <!-- prints X of Y, where X is current page and Y is number of pages -->
                    <div class="pageCounter">
                        <?php echo @$this->Paginator->counter(); ?>
                    </div>
                </div><!-- end .paging -->
                <?php endif;?>
            </div><!-- end .theList -->
        </div><!-- end .wrapper -->
    </div><!-- end #content -->
</div><!-- end #container -->

<?php //echo $this->element('sql_dump');?>

<script type="application/javascript">
  // Define our custom event hanlders
  function onTweet(intent_event) {
    if (intent_event) {
      var label = intent_event.region;
      var src = $.deparam(intent_event.target.src);
     
       $.ajax({
          url: src.url+'&ajax=1&share_type=1&post_id='+md5(intent_event.target.baseURI),
          dataType: 'json',
          success: function( response ) {
            //-- do nothing
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

