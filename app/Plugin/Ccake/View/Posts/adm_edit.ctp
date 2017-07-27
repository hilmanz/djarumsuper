<?php $this->Html->css(array("Ccake.ccake","admin"),null,array('inline'=>false)); ?>
<?php $this->Html->script(array("Ccake.ccake"),array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span2 adm-sidebar">
		<?php echo $this->element('adm_posts_sidebar');?>
	</div>
	<div class="span10">
		<div class="content">
			<div>
				<h4>Edit Post</h4>
			</div>
			<div class="row">
				<div class="span4">
					
				</div>
				<div class="span4">
					
				</div>
			</div>
			<div class="row">
				<form action name="<?=$this->Html->url('/adm/ccake/posts/edit/'.$post_id)?>" method="POST" enctype="application/x-www-form-urlencoded">
					<label>Title</label>
					<input type="text" name="title" value="<?=$post['Page']['title']?>" class="form-control input-lg"/>
					<label>Summary</label>
					<input type="text" name="summary" value="<?=$post['Post']['summary']?>" class="form-control input-lg"/>
					<label>Category</label>
					<div style="width:300px;">
					<select name="category" class="select-block">
						 <option value="0">
			            	Choose Category
			            </option>
			            <?php
			            	if(isset($categories)):
			            		foreach($categories as $category):
			            			if($category['PostCategory']['id']==$post['Post']['post_category_id']){
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
					<label>Content</label>
					<textarea name="content" class="form-control"><?=$post['Page']['content']?></textarea>
					<div>
					<input type="submit" name="btn" value="Save" class="form-control"/>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</div>
 <script>
$("select").selectpicker({style: 'btn btn-primary', menuStyle: 'dropdown-inverse'});
 </script>
<?php
echo $this->element('misc');
?>