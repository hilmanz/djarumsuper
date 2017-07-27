<?php if(isset($dashboard_sidebar_banners)):?>
	<?php
		foreach($dashboard_sidebar_banners as $i=>$v):
			if((Configure::read('DashboardSidebannerLimit')-1)<$i){
				break;
			}
	?>
	<div class="bannerRows">
    	<div class="thumbBanner">
	<?php
			$image =  $this->Html->image("/content/banner/300x250_{$dashboard_sidebar_banners[$i]['Banner']['filename']}");
			if(@eregi("http://",$dashboard_sidebar_banners[$i]['Banner']['urlto'])){
				//this is an external link. so we add attribute target=_blank
				echo $this->Html->link($image,$dashboard_sidebar_banners[$i]['Banner']['urlto'],
					array("escape"=>false));
			}else{
				echo $this->Html->link($image,$dashboard_sidebar_banners[$i]['Banner']['urlto'],
					array("escape"=>false));
			}
	?>
    	</div>
        <div class="summary">
        	<h3><a href="#"><?=h($dashboard_sidebar_banners[$i]['Banner']['name'])?></a></h3>
            <a href="<?=$dashboard_sidebar_banners[$i]['Banner']['urlto']?>" class="readmore2">Read More</a>
        </div>
	</div>
	<?php
		endforeach;
	?>
<?php endif;?>