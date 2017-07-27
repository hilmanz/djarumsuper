<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_banners_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Banner Categories</h4>
			</div>
			<div class="row">
				<a href="#" class="btn btn-success fr" data-toggle="modal" data-target="#mcreate">Add Category</a>
			</div>
			<div class="row">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>
						Name
					</th>
					<th>
						Description
					</th>
					<th>
						Size Limit
					</th>
					<th>
						Action
					</th>
				</thead>
				<?php if(isset($categories)):?>
				<tbody>
					<?php foreach($categories as $category):?>
					<tr>
						
						<td>
							<?=h($category['BannerCategory']['name'])?>
						</td>
						<td>
							<?=h($category['BannerCategory']['description'])?>
						</td>
						<td>
							<?=h($category['BannerCategory']['size_limit'])?>
						</td>
						<td>
							<a href="<?=$this->Html->url('/adm/ccake/banners/edit_category/'.$category['BannerCategory']['id'])?>" class="btn btn-warning">Edit</a> 
							<a href="<?=$this->Html->url('/adm/ccake/banners/delete_category/'.$category['BannerCategory']['id'])?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<?php else:?>
				<tbody>
					<tr>
						<td colspan='4'>
							No Categories available yet
						</td>
						
					</tr>
				</tbody>
				<?php endif;?>	
			</table>
			<?php 
				if(isset($categories)):
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
    <h4 id="myModalLabel">Add Category</h4>
  </div>
  <div class="modal-body">
  	<form action="" method="POST" enctype="application/x-www-form-urlencoded">
  		<div>
  			<input type="text" name="name" class="form-control" placeholder="Category Name" value=""/>
  		</div>
  		<div>
  			<input type="text" name="description" class="form-control" placeholder="Description.." value=""/>
  		</div>
  		<div>
  			<input type="text" name="width" class="form-control" 
  					placeholder="Width in Pixels" value=""  style="width:80px;" value="300"/>
  		X
  		<input type="text" name="height" class="form-control" 
  				placeholder="Height in Pixels" value="" style="width:80px;" value="250"/>Pixels
  		</div>
  		<input type='submit' name='btn' value="Create" class="btn btn-warning"/>
  	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>