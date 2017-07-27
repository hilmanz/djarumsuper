<div class="provincename">
	<strong><?php echo strtoupper($province['name']);?></strong>
</div>
<div>
	<div class="summaryContent"><?php echo $province['description'];?></div>
	<?php
		$total_land = number_format($categories['land']);
		$total_water = number_format($categories['water']);
		$total_air = number_format($categories['air']);
		if(($total_land+$total_air+$total_water)>0):
	?>
	<div class="contentCount">
		<?php if($total_land>0):echo $this->Html->link("Land ({$total_land} Posts)","/articles/trip/{$province['name_str']}/land",array("class"=>"viewCategoryLand"));endif;?>
		<?php if($total_water>0):echo $this->Html->link("Water ({$total_water} Posts)","/articles/trip/{$province['name_str']}/water",array("class"=>"viewCategoryLand"));endif;?>
		<?php if($total_air>0):echo $this->Html->link("Air ({$total_air} Posts)","/articles/trip/{$province['name_str']}/air",array("class"=>"viewCategoryLand"));endif;?>
	</div>
	<div class="viewAllbtn">
		<?php echo $this->Html->link('Lihat Semua &raquo;',"/articles/trip/{$province['name_str']}/all",array("class"=>"viewAll","escape"=>false));?>
	</div>
	<?php else:?>
		<div class="contentCount"><a href="#">Tidak ada post untuk daerah ini.</a></div>
	<?php endif;?>
	
</div>
