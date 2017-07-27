<div class="provincename">
	<strong><?php echo strtoupper($province['name']);?>
		<?php if(intval($dest_count)>0):echo " - ".intval($dest_count)." Destinations";endif;?> </strong>
</div>
<div>
	<?php
		$total_land = number_format($categories['land']);
		$total_water = number_format($categories['water']);
		$total_air = number_format($categories['air']);
		//pr($posts);
		if((sizeof($posts))>0):

	?>
	<div class="contentCount">
		<?php foreach($posts as $n=>$p):?>
		<?php
			if(isset($p['Article'])):
		?>
		<span class="trip_content">
			<h4>
				<?php 
					switch($n){
						case 1:
							echo "Water";break;
						case 2:
							echo "Air";break;
						default:
							echo "Land";break;
					}
				?>
			</h4>
			<div class="img"> 
				<?php echo $this->Html->image("/content/images/thumb_".@$p['MainImg'][0]['filename'], array(
                                            'url' => array('controller' => 'articles', 'action' => $channel_name, $p['Province']['name_str'],$p['Category']['name_str'],'view',$p['Article']['id'])
                                            
                                            ));
				?>
			</div>
			<div class="judul">
				<?php echo $this->Html->link($p['Article']['title'],array('controller' => 'articles', 'action' => $channel_name, $p['Province']['name_str'],$p['Category']['name_str'],'view',$p['Article']['id']));?></div>
			<div class="tempat"><?=$p['Province']['name']?></div>
			<div class="oleh">By : <?=$p['Author']['name']?></div>
		</span>
		<?php endif;?>
		<?php endforeach;?>
	</div>
	<div class="viewAllbtn">
		<?php echo $this->Html->link('Lihat Semua &raquo;',"/articles/trip/{$province['name_str']}/all",array("class"=>"viewAll","escape"=>false));?>
	</div>
	<?php else:?>
		<div class="contentCount tripNoArticle"><a href="#">Belum ada Artikel untuk daerah <?=$province['name']?>.</a></div>
	<?php endif;?>
	
</div>
