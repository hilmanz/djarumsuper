<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_banners_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Edit Category</h4>
			</div>
			
			<div class="row">
				<form action="<?=$this->Html->url('/adm/ccake/banners/edit_category/'.$category['BannerCategory']['id'])?>" method="POST" enctype="application/x-www-form-urlencoded">
			  		<div>
			  			<input type="text" name="name" class="form-control" placeholder="Category Name" 
			  			value="<?=$category['BannerCategory']['name']?>"/>
			  		</div>
			  		<div>
			  			<input type="text" name="description" class="form-control" placeholder="Description.." value="<?=$category['BannerCategory']['description']?>"/>
			  		</div>
			  		<div>
			  			<?php
			  				$arr = explode("x",$category['BannerCategory']['size_limit']);
			  				$width = trim($arr[0]);
			  				$height = trim($arr[1]);
			  			?>
			  			<input type="text" name="width" class="form-control" 
			  					placeholder="Width in Pixels"  style="width:80px;" value="<?=$width?>"/>
			  		X
			  		<input type="text" name="height" class="form-control" 
			  				placeholder="Height in Pixels" style="width:80px;" value="<?=$height?>"/>Pixels
			  		</div>
			  		<input type='submit' name='btn' value="SAVE" class="btn btn-warning"/>
			  	</form>
			</div>
		</div>

		
	</div>
</div>

