
<div id="container">
	<a href="<?=$this->Html->url('/articles/submit/trip')?>" class="submitArticle">Submit Article</a>
  <div class="wrapper clear">
    <?php foreach($posts as $p):?>
        <div class="box">
            <div class="boxImg">
             
                <?php echo $this->Html->image("/content/images/thumb_".@$p['MainImg'][0]['filename'], array(
                                                'url' => array('controller' => 'articles', '
                                                  action' => 'trip', $p['Province']['name_str'],
                                                  $p['Category']['name_str'],'view',$p['Article']['id'])                                               
                                                ));
                                    ?>
            </div><!-- end .boxImg -->
            <div class="boxEntry">
                <h3 class="boxTitle"><?php echo $this->Html->link($p['Article']['title'],array('controller' => 'articles', 'action' => 'trip', $p['Province']['name_str'],$p['Category']['name_str'],'view',$p['Article']['id']));?></h3>
                <span class="place"><?=strtoupper($p['Province']['name'])?></span>
                <?php if(!isset($p['original_author_name'])):?>
                <span class="user">By : <?=$p['Author']['name']?></span>
                <?php else:?>
                <span class="user">By : <?=h($p['original_author_name'])?></span>
                <?php endif;?>
            </div><!-- end .boxEntry -->
        </div><!-- end .box -->
        <?php endforeach;?>
        <!--paging-->
        <div class="paging">
            <!-- Shows the next and previous links -->
            <div class="pagePrev">
                <?php echo $this->Paginator->prev('«', null, null, array('class' => 'disabled')); ?>
            </div>
            <!-- Shows the page numbers -->
            <div class="pageNumber">
                <?php echo $this->Paginator->numbers(); ?>
            </div>
            <div class="pageNext">
                <?php echo $this->Paginator->next('»', null, null, array('class' => 'disabled')); ?> 
            </div>
            <!-- prints X of Y, where X is current page and Y is number of pages -->
            <div class="pageCounter">
                <?php echo $this->Paginator->counter(); ?>
            </div>
        </div><!-- end .paging -->
        <div class="line"></div>
        <?php echo $this->element('on_the_go_widget');?>
    </div><!-- end .wrapper -->
    <div class="wrapper">
        <div id="sideBanner" class="w300 fr">
             <?php echo $this->element('small_banner');?>
        </div>
    </div><!-- end .wrapper -->
</div><!-- end #container -->

<?php //echo $this->element('sql_dump'); ?>