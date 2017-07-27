<?php $this->Html->css("Ccake.ccake",null,array('inline'=>false)); ?>
<?php $this->Html->script("Ccake.ccake",array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_posts_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div class="row">
				<h4>Article / Blog Posts</h4>
			</div>
			<div class="row">
				<div class="span4">
					<select name="category" class="select-block">
						 <option value="0">
			            	Choose Category
			            </option>
			            <?php
			            	if(isset($categories)):
			            		foreach($categories as $category):
			            			if($category['PostCategory']['id']==$category_id){
			            				$selected = "selected='selected'";
			            			}else{
			            				$selected = '';
			            			}
			            ?>
			            <option value="<?=intval($category['PostCategory']['id'])?>" <?=$selected?>>
			            	<?=h($category['PostCategory']['name'])?>
			            </option>
			        <?php endforeach;endif;?>
		          	</select>
				</div>
				<div class="span4">
					
				</div>
			</div>
			<div class="row">
				<table width="100%" cellpadding="10" class="table table-striped table-bordered table-hover table-condensed">
				<thead>
					<th>
						<?php 
							if(isset($posts)):
								echo $this->Paginator->sort('title', 'Title');
							else:
								echo "Page Name";
							endif;
						?>
					</th>
					<th>
						Summary
					</th>
					<th>
						Action
					</th>
				</thead>
				<?php if(isset($posts)):?>
				<tbody>
					<?php foreach($posts as $page):?>
					<tr>
						
						<td>
							<?=h($page['Page']['title'])?>
						</td>
						<td>
							<?=h($page['Post']['summary'])?>
						</td>
						<td>
							<a href="<?=$this->Html->url('/adm/ccake/posts/edit/'.$page['Post']['id'])?>" class="btn btn-warning">Edit</a> 
							<a href="<?=$this->Html->url('/adm/ccake/posts/delete/'.$page['Post']['id'])?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
				<?php else:?>
				<tbody>
					<tr>
						<td colspan='4'>
							No Page available yet
						</td>
						
					</tr>
				</tbody>
				<?php endif;?>	
			</table>
			<?php 
				if(isset($posts)):
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
 <script>
$("select").selectpicker({style: 'btn btn-primary', menuStyle: 'dropdown-inverse'});
$("select[name=category]").change(function(e){
	var cid = $(this).val();
	if(cid!='0'){
		document.location = "<?=$this->Html->url('/adm/ccake/posts?category_id=')?>"+$(this).val();
	}
	
});
 </script>