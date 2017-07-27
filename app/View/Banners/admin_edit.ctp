<div id="subBar">
    <h3 class="titleModule">Banner Management</h3>
    <div class="subnav">
		<?php  echo $this->element('banner_admin_navigation');  ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
    <h4 class="titlePage">Edit Banner</h4>
    <div class="addForm">
		<?php echo $this->Form->create('Banner',array('type'=>'file'));?>
		<div class="row">
	        <label>Banner Type</label>
	       	<select id="banner_type" name="banner_type">
	       		<option value="4" <?php if($banner['Banner']['banner_type']==4):echo "selected='selected'";endif;?>>Front Page  - SideBar Banner (300x250 pixels)</option>
	       		<option value="1" <?php if($banner['Banner']['banner_type']==1):echo "selected='selected'";endif;?>>SideBar Banner (300x250 pixels)</option>
	       		<option value="2" <?php if($banner['Banner']['banner_type']==2):echo "selected='selected'";endif;?>>Top Banner (726x100 pixels)</option>
                <option value="5" <?php if($banner['Banner']['banner_type']==5):echo "selected='selected'";endif;?>>Top Small Banner (254x100 pixels)</option>
	       		<option value="3" <?php if($banner['Banner']['banner_type']==3):echo "selected='selected'";endif;?>>Head Banner (980x425 pixels)</option>
	       	</select>
        </div>
        <div class="row">
        <div class="row">
            <label>Current Image</label>
            <?php echo $this->Html->image("/content/banner/{$banner['Banner']['filename']}");?>
        <div>
        <div class="row">
            <label>Upload New Image</label>
            <?php echo $this->Form->file('img');?>
        </div>
        <div class="row">
        <label>Name</label>
        <input id="name" name="name" value="<?php echo $banner['Banner']['name']?>"/>
        </div>
        <div class="row">
            <label>Target URL</label>
            <textarea id="urlto" name="urlto" cols="50" rows="5"><?php echo $banner['Banner']['urlto']?></textarea>	
        </div>
        <div class="row">
        <label>Available in :</label>
        <?php
        	if(!isset($banner['BannerChannel'][0]['channel_id'])){
        		$banner['BannerChannel'][0]['channel_id'] = 0;
        	}
        ?>
            <table>
                <tr>
                    <td width="20"><input type="checkbox" id="all" name="avail[]" value="all"
                                <?php if($banner['BannerChannel'][0]['channel_id']==0):echo "checked='checked'";endif;?> 
                                onclick="$('.channel').removeAttr('checked');$(this).attr('checked','checked');"/></td>
                    <td>Anywhere</td>
                </tr>
                 <?php foreach($channels as $c):?>
                <tr>
                    <td width="20"><input type="checkbox" class="channel" 
                        name="avail[]" 
                        value="<?php echo $c['Channel']['id']?>" 
                        onclick="$('#all').removeAttr('checked');"
                        <?php if($c['Channel']['checked']): echo "checked='checked'";endif;?>/> </td>
                    <td><?php echo $c['Channel']['name']?></td>
                </tr>
                  <?php endforeach;?>
            </table>
        </div>
        <div class="row">
            <label>Banner Display</label>
            <input type="radio" name="status" value="1" <?php if($banner['Banner']['is_active']==1):print "checked='checked'";endif;?>/> Enabled
            <input type="radio" name="status" value="0" <?php if($banner['Banner']['is_active']==0):print "checked='checked'";endif;?>/> Disabled
        </div>
        <div class="rowSubmit">
            <input type="hidden" name="id" value="<?php echo $banner['Banner']['id'];?>"/>
            <input type="submit" name="btnSubmit" value="Save Changes"/>
        </div>
        <?php echo $this->Form->end();?>
    </div><!-- end .addForm -->
</div><!-- end .content -->


