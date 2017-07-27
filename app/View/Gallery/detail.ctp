<script>
	var imgpath = "<?php echo $this->Html->url('/content/gallery');?>";
</script>
<div id="container">
    <div id="content" class="galleryPage">
        <div class="wrapper">
            <div class="galleryBox">
        		<div class="line"></div>
                <div id="slider" class="flexslider">
                  <ul class="slides">
					<?php foreach($posts as $n=>$p):?>
                            <li>
                            	<div class="bigPhoto">
                                <?php echo $this->Html->link($this->Html->image('/content/gallery/'.$p['Gallery']['filename']),
                                                            '#popupDetail',
                                                            array('title'=>$p['Gallery']['caption'],
                                                                  'img-data'=>$p['Gallery']['filename'],
                                                                  'place'=>$p['Gallery']['place'],
                                                                  'taken-by'=>$p['Gallery']['author'],
                                                                  'class'=>'showPopup',
                                                                  'escape'=>false
                                                                  ));?>
                       
                                    <div class="boxEntrycaption">
                                    	<div class="pad102">
                                        <h3 class="boxTitle">
                                                            <?php echo $p['Gallery']['caption']?>
                                                            
                                                            </h3>
                                        <span class="place"><?php echo $p['Gallery']['place']?></span>
                                        <?php if(strlen($p['Gallery']['author'])>0):?>
                                        <span class="user">By : <?php echo $p['Gallery']['author']?></span>
                                        <?php endif;?>
                                        <?php
                                        if(isset($fb_id)):
                                        ?>
                                        <a class="download" no="1" href="#" target="_blank">1280x768</a> | 
                                        <a class="download" no="2" href="#" target="_blank">800x600</a>
                                        <?php else:?>
                                        <div class="signMessage">
                                            <span><a href="javascript:fblogin();">Login</a> to download wallpaper.</span>
                                        </div>
                                        <?php endif;?>
                                      	</div><!-- end .pad102 -->
                                    </div><!-- end .boxEntrycaption -->
                               </div><!-- end .bigPhoto -->
                            </li>
                    <?php endforeach;?>

                  </ul>
                </div><!-- end #slider -->
                <div id="carousel" class="flexslider">
                  <ul class="slides">
					<?php foreach($posts as $n=>$p):?>
                            <li>
                                <?php echo $this->Html->link($this->Html->image('/content/gallery/thumb_'.$p['Gallery']['filename']),
                                                            '#popupDetail',
                                                            array('title'=>$p['Gallery']['caption'],
                                                                  'img-data'=>$p['Gallery']['filename'],
                                                                  'place'=>$p['Gallery']['place'],
                                                                  'taken-by'=>$p['Gallery']['author'],
                                                                  'class'=>'',
                                                                  'escape'=>false
                                                                  ));?>
                               
                            </li>
                    <?php endforeach;?>
                  </ul>
                </div><!-- end #carousel -->
            </div><!-- end .galleryBox -->
            
        	<div class="line"></div>
        </div><!-- end .wrapper -->
        
    </div><!-- end #content -->
</div><!-- end #container -->