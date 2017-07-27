<div id="header"> 
    <div id="banner" class="grad">
      <div class="slider">
      	<?php foreach($posts as $n=>$p):?>
        <div><?php echo $this->Html->image('/content/gallery/medium_'.$p['Gallery']['filename']);?></div>
        <?php endforeach;?>
      </div><!-- end .slider -->
    </div><!-- end #banner -->
</div><!-- end #header -->
<div id="container">
    <div id="content" class="photographPage">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<?php foreach($posts as $n=>$p):?>
                <div class="picBox">
					<?php echo $this->Html->link($this->Html->image('/content/gallery/thumb_'.$p['Gallery']['filename']),
												'/content/gallery/'.$p['Gallery']['filename'],
												array('title'=>$p['Gallery']['caption'],
													  'rel'=>'gallery',
													  'class'=>'thumb',
													  'escape'=>false
													  ));?>
                </div><!-- end .picBox -->
    			<?php endforeach;?>
    			 <!--paging-->
          	  <?php if(isset($this->Paginator)):?>
                <div class="paging">
                	<!-- Shows the next and previous links -->
                    <div class="pagePrev">
                		<?php echo @$this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
                    </div>
                	<!-- Shows the page numbers -->
                    <div class="pageNumber">
                		<?php echo @$this->Paginator->numbers(); ?>
                    </div>
                    <div class="pageNext">
                		<?php echo @$this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?> 
                    </div>
                	<!-- prints X of Y, where X is current page and Y is number of pages -->
                    <div class="pageCounter">
                		<?php echo @$this->Paginator->counter(); ?>
                	</div>
                </div><!-- end .paging -->
                <?php endif;?>
            <!-- end of paging-->
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
        <!--merchandise-->
        <?php echo $this->element('merchandise');?>
        <!--bannerSmall-->
    	 <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/trip_advisor.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'trip','index')
										));
			?>
        </div><!-- end .box -->
         <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/onthego.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'on_the_go','index')
										));
		  ?>
        </div><!-- end .box -->
    </div><!-- end #sidebar -->
</div><!-- end #container -->