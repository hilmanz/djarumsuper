<script>
	var imgpath = "<?php echo $this->Html->url('/content/Video');?>";
</script>
<div id="container">
    <div id="content" class="galleryPage">
        <div class="wrapper">
        <div id="tabs2">
              <ul class="navTab">
                <li><a href="<?=$this->Html->url('/gallery')?>">Photo</a></li>
                <li class="current"><a href="<?=$this->Html->url('/video')?>" class="active">Video</a></li>
              </ul>
             
              <div id="galeri-video">
				      <?php foreach($posts as $n=>$p):?>
                    <div class="box">
                        <div class="boxImg">
                        	<span class="iconVideo">&nbsp;</span>
                            <?php echo $this->Html->link($this->Html->image('/content/video/thumb_'.$p['Video']['snapshot']),
                                                        '#popupDetail2',
                                                        array('title'=>$p['Video']['caption'],
                                                              'img-data'=>$p['Video']['snapshot'],
                                                              'place'=>$p['Video']['place'],
                                                              'taken-by'=>$p['Video']['author'],
                                                              'videoID'=>$p['Video']['id'],
                                                              'class'=>'showPopup2',
                                                              'escape'=>false
                                                              ));?>
                           
                        </div><!-- end .boxImg -->
                        <div class="boxEntry">
                            <h3 class="boxTitle">
                                                <?php echo $p['Video']['caption']?>
                                                
                                                </h3>
                            <span class="place"><?php echo $p['Video']['place']?></span>
                            <?php if(strlen($p['Video']['author'])>0):?>
                            <span class="user">By : <?php echo $p['Video']['author']?></span>
                            <?php endif;?>
                        </div><!-- end .boxEntry -->
                    </div><!-- end .box -->
                <?php endforeach;?>
              </div>
            </div>
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
            </div><!-- end .paging -->
        	<div class="line"></div>
        </div><!-- end .wrapper -->
        
    </div><!-- end #content -->
</div><!-- end #container -->
<?php echo $this->element('popup');?>

<?php foreach($posts as $n=>$p):?>
<script type="text/template" id="video-<?=$p['Video']['id']?>">
<?=$p['Video']['html']?>
</script>
<?php endforeach;?>