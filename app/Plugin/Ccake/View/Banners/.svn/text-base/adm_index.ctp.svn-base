<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_banners_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Web Banners</h4>
				<a href="#" class="btn btn-success fr" data-toggle="modal" data-target="#mcreate">Upload Banner</a>
			</div>
			<div class="row">
				<div class="span4">
					<select name="category" class="select-block">
						 <option value="0">
			            	Choose Category
			            </option>
			            <?php
			            	foreach($categories as $category):
			            		
			            		if($category['BannerCategory']['id'] == $category_id){
			            			$selected = "selected='selected'";
			            		}else{
			            			$selected = '';
			            		}
			            ?>
			            	<option 
			            		value="<?=$category['BannerCategory']['id']?>"
			            		<?php if($selected!=''): echo $selected;endif;?>
			            	>
			            		<?=$category['BannerCategory']['name']?> (<?=$category['BannerCategory']['size_limit']?> Pixels)
			            	</option>
			            	<?php
			            		endforeach;
			            	?>
		          	</select>
				</div>
				<div class="span4">
					
				</div>
			</div>
			<div class="row">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>
						<?php echo $this->Paginator->sort('id', 'ID');?>
					</th>
					<th>
					</th>
					<th>
						<?php 
							if(isset($banners)):
								echo $this->Paginator->sort('name', 'Name');
							else:
								echo "Name";
							endif;
						?>
					</th>
					<th>Size</th>
					<th>
						Slot
					</th>
					<th>
						Zone
					</th>
					<th>
						Views
					</th>
					<th>
						Clicks
					</th>
					<th>
						CTR
					</th>
					<th>
						Action
					</th>
				</thead>
				<?php if(isset($banners)):?>
				<tbody>
					<?php foreach($banners as $banner):?>
					<?php
						$img_url = Configure::read('UPLOAD_DIR_WWW').'banners/'.$banner['Banner']['file'];
					?>
					<tr>
						<td>
							<?=h($banner['Banner']['id'])?>
						</td>
						<td>
							<a href="<?=$this->Html->url($img_url)?>" target="_blank">
								<img src="<?=$this->Html->url($img_url)?>" style="height:50px;"/>
							</a>
						</td>
						<td>
							<?=h($banner['Banner']['name'])?>
						</td>
						<td>
							<?=h($banner['BannerCategory']['size_limit'])?> Pixels
						</td>
						<td>
							<?=h($banner['Banner']['slot'])?>
						</td>
						<td>
							<?=h($banner['BannerZone']['name'])?>
						</td>
						<td>
							<?=intval($banner['stats']['imp'])?>
						</td>
						<td>
							<?=intval($banner['stats']['click'])?>
						</td>
						<td>
							<?php if($banner['stats']['imp'] > 0):?>
							<?=round(($banner['stats']['click']/$banner['stats']['imp'])*100,2)?> %
							<?php else: echo '0%';endif;?>
						</td>
						<td>
							<a href="<?=$this->Html->url('/adm/ccake/banners/edit/'.$banner['Banner']['id'])?>" class="btn btn-warning">Edit</a> 
							<a href="<?=$this->Html->url('/adm/ccake/banners/delete/'.$banner['Banner']['id'])?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<?php else:?>
				<tbody>
					<tr>
						<td colspan='4'>
							No Banners available yet
						</td>
						
					</tr>
				</tbody>
				<?php endif;?>	
			</table>
			<?php 
				if(isset($banners)):
			?>
			<div class="pagination">
			  <ul>
			  	<?php echo $this->Paginator->prev(h('Previous'),array('tag'=>'li',
			  													  'disabledTag'=>'a'),'',
			  												array('tag'=>'li',
			  														'class' => 'disabled',
			  														'disabledTag'=>'a'));?>
			  	<?php echo $this->Paginator->numbers(array('tag'=>'li',
			  											  'separator'=>'',
			  											  'currentTag'=>'a',
			  											  'currentClass'=>'active'));?>
			    <?php echo $this->Paginator->next(h('Next'),array('tag'=>'li',
			  													  'disabledTag'=>'a'),'',
			  												array('tag'=>'li',
			  														'class' => 'disabled',
			  														'disabledTag'=>'a'));?>
			  </ul>
			</div>
			<?php endif;?>
			</div>
		</div>

		
	</div>
</div>


<div id="mcreate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Upload Banner</h4>
  </div>
  <div class="modal-body">
  	<form action="<?=$this->Html->url('/adm/ccake/banners/upload')?>" method="post" enctype="multipart/form-data">
	<table width="400">
	<tr>
		<td>File</td><td><input type="file" name="file"/></td>
	</tr>
	<tr>
		<td>Category</td>
		<td>
			<select name="banner_category_id" class="select-block">
	            <?php
	            	foreach($categories as $category):
	            ?>
	            	<option value="<?=$category['BannerCategory']['id']?>">
	            		<?=$category['BannerCategory']['name']?> (<?=$category['BannerCategory']['size_limit']?> Pixels)
	            	</option>
	            	<?php
	            		endforeach;
	            	?>
          	</select>
		</td>
	</tr>
	<tr>
		<td>Zone</td>
		<td>
			<select name="banner_zone_id" class="select-block">
	            <?php
	            	foreach($zones as $zone):
	            ?>
	            	<option value="<?=$zone['BannerZone']['id']?>">
	            		<?=$zone['BannerZone']['name']?> (<?=$zone['BannerZone']['binded_slug']?>)
	            	</option>
	            	<?php
	            		endforeach;
	            	?>
          	</select>
		</td>
	</tr>
	<tr>
		<td>Name</td><td><input type="text" name="name"/></td>
	</tr>
	<tr>
		<td>URL</td><td><input type="text" name="url" placeholder="http://"/></td>
	</tr>
	<tr>
		<td>SLOT</td>
		<td>
			<select name="slot">
				<option value="FRONTPAGE">FRONTPAGE</option>
				<option value="SIDEBAR_SMALL">SIDEBAR_SMALL</option>
				<option value="SIDEBAR_LARGE">SIDEBAR_LARGE</option>
				<option value="LONGBANNER_TOP">LONGBANNER_TOP</option>
				<option value="LONGBANNER_BOTTOM">LONGBANNER_TOP</option>
				<option value="SMALL_LONG">SMALL_LONG</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<span style="float:left;width:300px;">File Max : 1 MB</span>
			<input type="submit" name="btn" value="Upload" class="btn btn-warning" style="float:right"/>
		</td>
	</tr>
</table>
</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>


<script>
$("select[name=category]").change(function(e){
	document.location = "<?=$this->Html->url('/adm/ccake/banners?category_id=')?>"+$(this).val();
});
</script>