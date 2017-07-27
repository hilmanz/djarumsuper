
<div id="subBar">
    <h3 class="titleModule">Article Management</h3>
    <div class="subnav">
		<?php
         echo $this->element('article_admin_navigation');
        ?>
    </div>
</div><!-- end #subBar -->

<div class="content">
	<h4 class="titlePage">Edit Article</h4>
	<?php echo $this->element('tinymce'); ?>
    	<div class="addForm">
		<?php echo $this->Form->create('Article',array('action'=>'edit','type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
		<div class="row">
        <div>
        <label>Permanent Links (*)</label>
        </div>
        <div class="row">
        <?php foreach($channels as $ch):?>
        	<h4><?php echo "{$ch['Channel']['name']} - {$ch['Category']['name']}";?></h4>
        	<div><?php echo $this->Html->url("/articles/{$ch['Channel']['name_str']}/{$ch['Category']['name_str']}/view/{$post['Article']['id']}");?></div>
		<?php endforeach;?>
        </div>
		<div class="row">
        	<label>Categories</label>
        	<div class="categoryList row">
        	</div>
			<select id="category" name="category_id">
				<?php
					foreach($category as $c):
				?>
				<option value="<?php echo $c['Category']['id']?>"><?php echo $c['Channel']['name']."-".$c['Category']['name']?></option>
				<?php
					endforeach;
				?>
			</select>
			<input type="button" name="btnSubmit" value="Set Category" id="btnSetCategory"/>
			<span>click [Set Category] to assign categories for these article.</span>
		</div>
		<div class="row">
			<label>Province / Location</label>
		</div>
		<div class="row">
			<select id="province_id" name="province_id">
				<?php
					foreach($provinces as $p):
				?>
				<option value="<?php echo $p['Province']['id']?>" <?php if($post['Province']['id']==$p['Province']['id']): echo "selected='selected'";endif;?>><?php echo $p['Province']['name'];?></option>
				<?php
					endforeach;
				?>
			</select> *) Optional
		</div>
		<div class="row">
        	<label>Title</label>
		<input type="text" id="title" name="title" value="<?php echo $post['Article']['title']?>" size="50"/>
		</div>
		<div class="row">
        	<label>Summary</label>
		<textarea id="summary" name="summary" cols="50" rows="5"><?php echo $post['Article']['summary']?></textarea>
		</div>
		<div class="row">
        	<label>Content</label>
		<textarea id="content" name="content" cols="100" rows="20" class="tinymce">
			<?php 
			if(!eregi("\<br",$post['Article']['content'])){
				$post['Article']['content'] = nl2br($post['Article']['content']);
			}
			$LEGACY_PATH = Configure::read('Custom.LegacyPath');
			if(!@eregi("src=\"http\:\/\/",$post['Article']['content'])){
           		$post['Article']['content'] = str_replace("/uploads/","___uploads/",$post['Article']['content']);
		   		$post['Article']['content']= str_replace("___uploads/","{$LEGACY_PATH}/uploads/",$post['Article']['content']);
		   		$post['Article']['content'] = str_replace("fileadmin/user_uploads/","{$LEGACY_PATH}/fileadmin/user_uploads/",$post['Article']['content']);
			}
			echo htmlentities($post['Article']['content']);
			
			?>
			</textarea>
		</div>
		<?php if(strlen($post['Article']['youtube_video'])>0):?>
		<div class="row">
			Youtube Video
		</div>
		<div class="row">
			<?php echo $post['Article']['youtube_video'];?>
		</div>
		<?endif;?>
		<div class="row">
			Youtube Embed Script (optional):
		</div>
		<div class="row">
			<textarea id="youtube" name="youtube"><?php echo $post['Article']['youtube_video'];?></textarea>
		</div>
		<div class="row">
        	<label>Status</label>
			<input type="radio" name="status" value="1" <?php if($post['Article']['n_status']==1):echo "checked='checked'";endif;?>/> Published
			<input type="radio" name="status" value="0" <?php if($post['Article']['n_status']==0):echo "checked='checked'";endif;?>/> Unpublished
		</div>
		<div class="rowSubmit">
			<input type="hidden" name="post_id" value="<?php echo $post['Article']['id']?>"/>
			<input type="hidden" name="categories" id="categories" value=""/>
			<input type="submit" name="btnSubmit" value="Save Article"/>
		</div>
		<?php echo $this->Form->end();?>
        <hr />
        <div class="row">
            <label style="width:250px;">Current Image(s) : </label>
        	<div class="tablestyle clear">
            <table width="100%">
                <tr>
                    <td>Image</td><td>Use as Default</td>
                </tr>
                <?php foreach($images as $image):?>
                <?php $img = $image['ArticleAsset'];?>
                <tr>
                    <td><a name="<?php echo $img['id'];?>"></a><?php echo $this->Html->image("/content/images/{$img['filename']}"); ?></td>
                    <td  width="150">
                        <?php if($img['is_main'] == 1): ?>
                        <div class="btnYes"><?php echo $this->Html->link('Yes',"/admin/articles/edit/{$post['Article']['id']}/toggle_image/{$img['id']}/0#{$img['id']}");?></div>
                        <?php else: ?>
                        <div class="btnNo"><?php echo $this->Html->link('No',"/admin/articles/edit/{$post['Article']['id']}/toggle_image/{$img['id']}/1#{$img['id']}"); ?></div>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>
        </div>
        <div class="row">
            <label style="width:250px;">Upload Page Banner Image</label>
            <div class="clear">
            <?php echo $this->Form->create('ArticleAsset',array('type'=>'file'));?>
            <?php echo $this->Form->file('img');?>
            <input type="hidden" name="post_id" value="<?php echo $post['Article']['id']?>"/>
            </div>
            <div class="rowSubmit">
            <input type="submit" name="upload" value="Upload"/>
            </div>
            <?php echo $this->Form->end();?>
        </div>
        <?php if($categories):?>
        <div class="row">
            <label style="width:250px;">Featured These Article In</label>
            <div class="tablestyle clear">
            <table width="100%">
                <tr>
                    <td>Category</td><td>Set as Featured</td>
                </tr>
                <?php foreach($categories as $category):?>
                <tr>
                    <td><?php echo $category['Category']['name'];?></td>
                    <td  width="150">
                        <?php if($category['ArticleCategory']['is_featured'] == 1): ?>
                        <div class="btnYes"><?php echo $this->Html->link('Yes',"/admin/articles/edit/{$post['Article']['id']}/toggle_featured/{$category['ArticleCategory']['id']}/0");?></div>
                        <?php else: ?>
                        <div class="btnNo"><?php echo $this->Html->link('No',"/admin/articles/edit/{$post['Article']['id']}/toggle_featured/{$category['ArticleCategory']['id']}/1"); ?></div>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            </div>
        </div>
        <?php endif;?>
     </div><!-- end .addForm -->
</div><!-- end .content -->
<script type="application/javascript">
<?php foreach($categories as $n=>$cat):?>
	DS.get('edit_article_categories').add(new Category({id:'<?php echo $cat['Category']['id']?>',name:'<?php echo $cat['Category']['name']?>'}));
<?php endforeach;?>
</script>