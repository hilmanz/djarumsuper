<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_banners_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Ad Zones</h4>
				<a href="#" class="btn btn-success fr" data-toggle="modal" data-target="#mcreate">
					Create Zone
				</a>
			</div>
			
			<div class="row">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					
					<th>
						Name
					</th>
					<th>Slug</th>
					
					<th>
						Action
					</th>
				</thead>
				<?php if(isset($rs) && sizeof($rs) > 0):?>
				<tbody>
					<?php foreach($rs as $r):?>
					
					<tr>
						
						<td>
							<?=h($r['BannerZone']['name'])?>
						</td>
						
						<td>
							<?=h($r['BannerZone']['binded_slug'])?>
						</td>
						<td>
							<a href="<?=$this->Html->url('/adm/ccake/banners/delete_zone/'.
										$r['BannerZone']['id'])?>" class="btn btn-danger">
								Delete
							</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<?php else:?>
				<tbody>
					<tr>
						<td colspan='4'>
							No Zone available yet
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

<!-- popup -->
<div id="mcreate" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">Create Zone</h4>
  </div>
  <div class="modal-body">
  	<form action="<?=$this->Html->url('/adm/ccake/banners/add_zone')?>" method="post" enctype="multipart/form-data">
		<table width="400">
		<tr>
			<td>Name</td><td><input type="text" name="name"/></td>
		</tr>
		<tr>
			<td>Binded Slug</td><td><input type="text" name="binded_slug" placeholder="optional"/></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="btn" value="Save" class="btn btn-warning" style="float:right"/>
			</td>
		</tr>
	</table>
	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>

<!-- end of popup -->