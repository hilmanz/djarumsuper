<?php
 if(@$featured!=null):
?>
<div id="moreArticle" class="paperSide">
  <div class="moreArticle">
  	<div class="widgetContent">
        <div class="widgetTitle">
            <h1><a>Feature Lainnya</a></h1>
        </div><!-- end .widgetTitle -->
        <div class="entry">
        	<?php
			foreach($featured as $f):
			?>
            <div class="row">
                <p><?php echo $this->Html->link("{$f['Article']['title']}","/articles/{$channel_name}/{$f['Category']['name_str']}/view/{$f['Article']['id']}");?></p>
                <span class="date"><?php echo date("d.m.Y / H:i",strtotime($f['Article']['created_time']));?></span>
            </div><!-- end .row -->
            <?php endforeach;?>
        </div><!-- end .entry -->
    </div><!-- end .widgetContent -->
  </div><!-- end .moreArticle -->
</div><!-- end #moreArticle -->
<?php
endif;
?>