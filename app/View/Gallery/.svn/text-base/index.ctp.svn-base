<script>
	var imgpath = "<?php echo $this->Html->url('/content/gallery');?>";
</script>
<div id="container">
    <div id="content" class="galleryPage">
        <div class="wrapper">
        <div >
              <ul class="navTab">
                <li class="current"><a href="<?=$this->Html->url('/gallery')?>">Photo</a></li>
                <li><a href="<?=$this->Html->url('/video')?>" class="active">Video</a></li>
              </ul>
              <div id="galeri-photo">
				      <?php foreach($posts as $n=>$p):?>
                    <div class="box">
                        <div class="boxImg">
                            <?php echo $this->Html->link($this->Html->image('/content/gallery/thumb_'.$p['Gallery']['filename']),
                                                        '#popupDetail',
                                                        array('title'=>$p['Gallery']['caption'],
                                                              'img-data'=>$p['Gallery']['filename'],
                                                              'place'=>$p['Gallery']['place'],
                                                              'taken-by'=>$p['Gallery']['author'],
                                                              'class'=>'showPopup',
                                                              'escape'=>false
                                                              ));?>
                           
                        </div><!-- end .boxImg -->
                        <div class="boxEntry">
                            <h3 class="boxTitle">
                                                <?php echo $p['Gallery']['caption']?>
                                                
                                                </h3>
                            <span class="place"><?php echo $p['Gallery']['place']?></span>
                            <?php if(strlen($p['Gallery']['author'])>0):?>
                            <span class="user">By : <?php echo $p['Gallery']['author']?></span>
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