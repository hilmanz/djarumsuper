<div id="header">
    <div id="banner" class="grad">
    	<div class="slider">
    		<?php foreach($posts as $p):?>
    			<?php foreach($p['MainImg'] as $pic):?>
    				<?php if(isset($pic)&&$pic['is_main']==1):?>
    				<div><?php echo $this->Html->image("/content/images/{$pic['filename']}");?></div>
    				<?php endif;?>
    			<?php endforeach;?>
    		<?php endforeach;?>
    	</div>
    </div><!-- end #banner -->
</div><!-- end #header -->
<div id="container">
    <div id="content">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<?php foreach($posts as $p):?>
                <div class="row">
                    <div class="post">
                    	<?php if(isset($p['MainImg'][0]['filename'])):?>
                        <div class="thumb">
                        	<?php echo $this->Html->image("/content/images/thumb_".$p['MainImg'][0]['filename'], array(
    									'url' => array('controller' => 'articles', 'action' => $channel_name, $p['Category']['name_str'],'view',$p['Article']['id'])
										));
							?>
                        </div><!-- end .thumb -->
                        <?php endif;?>
                        <div class="entry">
                            <h1 class="title">
                            	<?php echo $this->Html->link($p['Article']['title'],array('controller' => 'articles', 'action' => $channel_name, $p['Category']['name_str'],'view',$p['Article']['id']));?>
                            </h1>
                            <p><?php echo $p['Article']['summary']?></p>
                            <?php echo $this->Html->link("more &raquo;",array('controller' => 'articles', 'action' => $channel_name, $p['Category']['name_str'],'view',$p['Article']['id']),array('escape'=>false));?>
                        </div><!-- end .entry -->
                    </div><!-- end .post -->
                </div><!-- end .row -->
                <?php endforeach;?>
                <!--paging-->
                <div class="paging">
                	<!-- Shows the next and previous links -->
                    <div class="pagePrev">
                		<?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
                    </div>
                	<!-- Shows the page numbers -->
                    <div class="pageNumber">
                		<?php echo $this->Paginator->numbers(); ?>
                    </div>
                    <div class="pageNext">
                		<?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?> 
                    </div>
                	<!-- prints X of Y, where X is current page and Y is number of pages -->
                    <div class="pageCounter">
                		<?php echo $this->Paginator->counter(); ?>
                	</div>
                </div><!-- end .paging -->
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
    	
        <!-- end .box -->
       <!-- widget lainnya -->
       <?php echo $this->element('other_feature');?>
    </div><!-- end #sidebar -->
</div><!-- end #container -->