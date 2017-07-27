<?php if(isset($banners)):?>
<div class="box grad bannerBig">
	<?php 
		$image =  $this->Html->image("/content/banner/{$banners[0]['Banner']['filename']}");
		if(@eregi("http://",$banners[0]['Banner']['urlto'])){
			//this is an external link. so we add attribute target=_blank
			echo $this->Html->link($image,$banners[0]['Banner']['urlto'],array("target"=>"_blank","escape"=>false));
		}else{
			echo $this->Html->link($image,$banners[0]['Banner']['urlto'],array("escape"=>false));
		}
	?>
</div><!-- end .box -->
<?php endif;?>