<?php
 if(@$featured!=null):
?>
<?php
foreach($featured as $f):
	if(!isset($channel_name)){
		$channel_name=$f['Channel'];
	}
?>
<div class="listJournal">
	<div class="titleBox title">
	    <h1><?php echo $this->Html->link("{$f['Article']['title']}","/articles/{$channel_name}/{$f['Category']['name_str']}/view/{$f['Article']['id']}");?></h1>
	</div><!-- end .titleBox -->	
	<div class="w300">
	    <div class="newsImg">
	        <?php echo @$this->Html->image("/content/images/small_".$f['MainImg'][0]['filename'], array(
                                                'url' => array('controller' => 'articles', 
                                                				'action' => $channel_name, 
                                                							$f['Category']['name_str'],
                                                				'view',
                                                				$f['Article']['id'])
                                                ));
                    ?>
	    </div>
	</div><!-- end .w440 -->
	<div class="rows">
	    <div class="rate">
	        <span>Rating :</span>
			<?php
            	$n_rate = intval(@$f['rate']);
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
	    
	    <?php echo $this->Html->link("","/articles/{$channel_name}/{$f['Category']['name_str']}/view/{$f['Article']['id']}",
	    							array('class'=>'readmore'));?>
	</div>
</div><!-- end .listJournal -->
<div class="line"></div>
<?php endforeach;?>
<?php endif; ?>

