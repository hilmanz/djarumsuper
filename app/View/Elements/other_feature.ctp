
<div class="otherFeature">
	<h3>
	<?php
     if(@$featured!=null):
    ?>
    <?php
    foreach($featured as $f):
        if(!isset($channel_name)){
            $channel_name=$f['Channel'];
        }
    ?>
    <div class="widget">
        <div class="date">
            <span style="font-size:14px;color:#F0FF00;"><?=to_date($f['Article']['created_time'],false)?></span>
        </div>
        <div class="widget-title">
            
            <?php if($channel_name!='music' && $channel_name!='aktifitas' && $channel_name!='products'):?>
            <h1><?php echo $this->Html->link("{$f['Article']['title']}","/articles/{$channel_name}/{$f['Category']['name_str']}/view/{$f['Article']['id']}",array('style'=>'color:white;font-size:16px;'));?></h1>
            <?php else:?>
            <h1><?php echo $this->Html->link("{$f['Article']['title']}","/articles/{$channel_name}/view/{$f['Article']['id']}",array('style'=>'color:white;font-size:16px;'));?></h1>
            <?php endif;?>
        </div><!-- end .titleBox -->	
       
    </div><!-- end .widget -->
    <div class="line"></div>
    <?php endforeach;?>
    <?php endif; ?>
</div>
