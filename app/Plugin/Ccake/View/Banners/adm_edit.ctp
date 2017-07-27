<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_banners_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Edit Banner</h4>
			</div>
			
			<div class="row">
				<form action="<?=$this->Html->url('/adm/ccake/banners/edit/'.$rs['Banner']['id'])?>" 
						method="post" enctype="multipart/form-data">
					<table width="400">
					<tr>
						<td colspan="2">
							<?php
								$img_url = Configure::read('UPLOAD_DIR_WWW').
											'banners/'.
											$rs['Banner']['file'];
							?>
							<img src="<?=$this->Html->url($img_url)?>" style="height:50px;"/>
						</td>
					</tr>
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
						<td>Name</td><td><input type="text" name="name" value="<?=$rs['Banner']['name']?>"/></td>
					</tr>
					<tr>
						<td>URL</td><td><input style="width:400px;" type="text" name="url" placeholder="http://" value="<?=$rs['Banner']['url']?>"/></td>
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
							<input type="submit" name="btn" value="Update" class="btn btn-warning" style="float:right"/>
						</td>
					</tr>
				</table>
				<script>
					$('select[name=banner_zone_id]').val(<?=intval($rs['Banner']['banner_zone_id'])?>);
					$('select[name=banner_category_id]').val(<?=intval($rs['Banner']['banner_category_id'])?>);
					$('select[name=slot]').val(<?=($rs['Banner']['slot'])?>);
				</script>
				</form>
			</div>
		</div>

		
	</div>
</div>

