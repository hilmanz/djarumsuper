<?php
//decide which featured article to be shown

//pr($featured_articles);
//$cat = $featured['Category'];
//$MainImg = $featured['MainImg'];
//$article= $featured['Article'];
//$cat['Channel'] = $featured['Channel'];
//$cat['Category'] = $featured['Category'];
$domain = Configure::read("Custom.Domain");
//$tc = $featured['tc'];

//featured article stuff
/*$permalink = $this->Html->url('/articles/'.$featured['Channel'].'/'. 
                            $featured['Category']['name_str'].'/view/'.
                            $featured['Article']['id']);
$picture = $domain.$this->Html->url("/content/images/thumb_".$featured['MainImg'][0]['filename']);
$name = ($featured['Article']['title']);
$caption = "My Adventure";
$description = ($featured['Article']['summary']);
$twittext = substr($description,0,140-strlen($permalink))."... ";
*/
?>
<script type="text/javascript" charset="utf-8">
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
    js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>
<script type="application/javascript">
	
</script>
<div id="container">
    
    <div id="content" class="homePage">
        <div class="w600 fl">
            <div id="hotNews">
            	<div class="titleBox">
                	<h3><?php echo $this->Html->image('/img/new/super_adv.png');?></h3>
                </div><!-- end .titleBox -->
                <div id="slideradv" class="flexslider">
                  <ul class="slides">
                    <?php 
                    foreach($featured_articles as $featured):
                        $permalink = $this->Html->url('/articles/'.$featured['Channel']['name'].'/'. 
                            $featured['Category']['name_str'].'/view/'.
                            $featured['Article']['id']);
                    ?>
                    <li>
              		  <div class="hotNewsImg">
                    <?php echo $this->Html->link($this->Html->image("/content/images/medium_".$featured['MainImg']['filename']),array('controller' => 'articles', 'action' => $featured['Channel']['name'], $featured['Category']['name_str'],'view',$featured['Article']['id']),array('class'=>'hotImages','escape'=>false));?>
                        <div class="entry-hotNews">
                            <p>
                                <?=h($featured['Article']['summary'])?>
                                <a href="<?=$permalink?>" class="readmores">selengkapnya&raquo;</a>
                            </p>
                        </div>
               		  </div><!-- end .hotNewsImg -->
                    </li>
                    
                    <?php endforeach;?>
                  </ul>
                </div><!-- end #slider -->
                <div id="carouseladv" class="flexslider">
                  <ul class="slides">
                    <?php 
                    foreach($featured_articles as $featured):
                       
                    ?>
                    <li>
                   <?php 
                   echo $this->Html->image("/content/images/medium_".$featured['MainImg']['filename']);
                   ?>
                    </li>
                   <?php endforeach;?>
                  </ul>
                </div><!-- end #carousel -->
            </div><!-- end #hotNews -->
        </div><!-- end .w600 -->
        <div class="w300 fr">
            <?php 
            if(!isset($fb_id)):
            ?>
            
        	<div id="loginBox">
            	<h4>MEMBER LOGIN</h4>
                 <a title="login with facebook" class="loginFacebook2" href="javascript:fblogin();">&nbsp;</a>
            </div><!-- end #loginBox -->
            <?php endif;?>
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
        </div><!-- end .w300 -->
        <div class="line"></div>
        <div class="wrapper">
            <div class="w600 fl">
                <div class="titleBox">
                    <h3><?php echo $this->Html->image('/img/new/t_music.png');?></h3>
                </div><!-- end .titleBox -->
                <div id="superMusic" class="trBox">
                    <?php foreach($supermusic as $music):?>
                	<div class="row">
                    	<div class="title-row">
                            <?php
                            $url = $this->Html->url('/articles/music/view/'.$music['Article']['id']);
                            ?>
                        	<h3 class="fl"><a href="<?=$url?>">
                                <?=h($music['Article']['title'])?></a></h3>
                            <span class="date fr"><?=date("d/m/Y",strtotime($music['Article']['created_time']))?></span>
                        </div><!-- end .title-row -->
                        <div class="entry-row">
                        	<p>
                                <?=h($music['Article']['summary'])?>
                                <a href="<?=$url?>" class="readmores">selengkapnya&raquo;</a>
                            </p>
                        </div><!-- end .entry-row -->
                    </div><!-- end .row -->
                    <?php endforeach;?>
                	
                </div><!-- end .trBox -->
            </div><!-- end .w600 -->
            <div class="w300 fr">
            	<div id="videoBox">
           		 <iframe width="300" height="270" src="//www.youtube.com/embed/KYl2MIfaJ2k" frameborder="0" allowfullscreen></iframe>
            	</div>
            </div><!-- end .w300 -->
        </div><!-- end .wrapper -->
        <div class="wrapper">
        	<div class="col2">
            	<div class="col2Box">
      			  <div class="line"></div>
                    <div class="titleBox">
                        <h3><?php echo $this->Html->image('/img/new/t_aktivitas.png');?></h3>
                    </div><!-- end .titleBox -->
                    <div id="activityBox" class="entry-box">
                        <?php foreach($aktifitas as $akt):?>

                        <?php
                            $url = $this->Html->url('/articles/aktifitas/view/'.$akt['Article']['id']);
                        ?>
                    	<div class="row">
                        	<div class="thumbAct">
                            	<a href="<?=$url?>">
                                    <?php 

                                    if(isset($akt['Assets'][0]['filename'])):
                                    echo $this->Html->image("/content/images/small_{$akt['Assets'][0]['filename']}"
                                                      ,array('width'=>150,'height'=>100));
                                    else:
                                        echo $this->Html->image('/content/news/thumb/activity1.jpg');
                                    endif;
                                    ?>

                                </a>
                            </div><!-- end .row -->
                            <div class="entry-activity">
                            	<h3><a href="<?=$url?>"><?=h($akt['Article']['title'])?></a></h3>
                                <span class="date"><?=date("d/m/Y",strtotime($akt['Article']['title']))?></span>
                                <p><?=h($akt['Article']['summary'])?></p>
                                <a href="<?=$url?>" class="readmores">selengkapnya&raquo;</a>
                            </div><!-- end .entry-activity -->
                        </div><!-- end .row -->
                        <?php endforeach;?>
                    </div><!-- end .entry-box -->
                </div><!-- end .col2Box -->
            </div><!-- end .col2 -->
        	<div class="col2">
            	<div class="col2Box">
      			  <div class="line"></div>
                  <div id="datebox" class="trBox">
                  		<div class="datebox">
                        	<div class="day">
                                <span>0</span>
                                <span>0</span>
                            </div>
                        	<div class="month">
                                <span>0</span>
                                <span>0</span>
                            </div>
                        	<div class="year">
                                <span>0</span>
                                <span>0</span>
                            </div>
                        </div><!-- end .datebox -->
                  </div><!-- end #datebox -->

                    <div class="titleBox">
                        <h3><?php echo $this->Html->image('/img/new/t_recent.png');?></h3>
                    </div><!-- end .titleBox -->
                    <div id="embedPost">
                    <div id="fb-root"></div> <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-post" data-href="https://www.facebook.com/photo.php?v=717019921659232" data-width="420"><div class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/photo.php?v=717019921659232">Post</a> by <a href="https://www.facebook.com/mysupersoccer">Supersoccer</a>.</div></div>

                    </div>
                </div><!-- end .col2Box -->
            </div><!-- end .col2 -->
        </div><!-- end .wrapper -->
        <div class="wrapper">
            <div class="galleryBox">
        		<div class="line"></div>
                <div class="titleBox">
                    <h3><?php echo $this->Html->image('/img/new/t_galeri.png');?></h3>
                </div><!-- end .titleBox -->
                <div id="slider" class="flexslider">
                  <ul class="slides">
                    <?php for($i=0;$i<sizeof($gallery);$i++):?> 
                    <?php 
                    $p = $gallery[$i]; 
                    ?> 
                    <li>
                    <?php echo $this->Html->link($this->Html->image('/content/gallery/'.$p['Gallery']['filename']), 
                                                 '/gallery/index', 
                                                 array('title'=>$p['Gallery']['caption'], 
                                                       'class'=>'bigThumb', 
                                                       'escape'=>false 
                                                       ));?> 
                    </li>
                    <?php endfor;?> 
                  </ul>
                </div><!-- end #slider -->
                <div id="carousel" class="flexslider">
                  <ul class="slides">
                    <?php for($i=0;$i<sizeof($gallery);$i++):?> 
                    <?php 
                    $p = $gallery[$i]; 
                    ?> 
                    <li>
                    <?php echo $this->Html->link($this->Html->image('/content/gallery/thumb_'.$p['Gallery']['filename']), 
                                                 '/gallery/index', 
                                                 array('title'=>$p['Gallery']['caption'], 
                                                       'class'=>'smallThumb', 
                                                       'escape'=>false 
                                                       ));?> 
                    </li>
                    <?php endfor;?> 
                  </ul>
                </div><!-- end #carousel -->
            </div><!-- end .galleryBox -->
        </div><!-- end .wrapper -->
    </div><!-- end #content -->
</div><!-- end #container -->

<script type="application/javascript">
  // Define our custom event hanlders
  function onTweet(intent_event) {
    if (intent_event) {
      var label = intent_event.region;
     
       $.ajax({
		  url: '<?=$permalink?>',
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


<script>
fillDtBox();
function fillDtBox(){
    var dt = new Date();
    var day = dt.getDate();
    var dt = new Date();
    var day = ""+dt.getDate();
    var month = ""+(dt.getMonth() + 1);
    var year = ""+(dt.getYear()-100);

    
    if(dt.getDate()<10){
        day = "0"+day.toString();
    }
    if((dt.getMonth()+1)<10){
        month = "0"+month;
    }
    day = day.split("");
    month = month.split("");
    year = year.split("");
    $(".day").html('');
    for(var i in day){
        $(".day").append('<span>'+day[i]+'</span>');
    }
    $(".month").html('');
    for(var i in month){
        $(".month").append('<span>'+month[i]+'</span>');
    }
    $(".year").html('');
    for(var i in year){
        $(".year").append('<span>'+year[i]+'</span>');
    }
}


</script>