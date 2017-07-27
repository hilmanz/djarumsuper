<div id="subBar">
    <h3 class="titleModule">Banner Management</h3>
    <div class="subnav">
		<?php  echo $this->element('banner_admin_navigation');  ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
    <h4 class="titlePage">Upload Banner</h4>
    <div class="addForm">
		<?php echo $this->Form->create('Banner',array('type'=>'file'));?>
		<div class="row">
	        <label>Banner Type</label>
	       	<select id="banner_type" name="banner_type">
	       		<option value="4">Front Page - SideBar Banner (300x250 pixels)</option>
	       		<option value="1" selected="selected">SideBar Banner (300x250 pixels)</option>
	       		<option value="2">Top Banner (726x100 pixels)</option>
                <option value="5">Top Small Banner (254x100 pixels)</option>
	       		<option value="3">Head Banner (980x425 pixels)</option>
	       	</select>
        </div>
        <div class="row">
        <label>File</label>
        <?php echo $this->Form->file('img');?>
        </div>
        <div class="row">
        <label>Name</label>
        <input id="name" name="name" value=""/>
        </div>
        <div class="row">
        <label>Target URL</label>
        <textarea id="urlto" name="urlto" value="" cols="50" rows="5"></textarea>	
        </div>
        <div class="row">
        <label>Available in :</label>
        	<table>
            	<tr>
                	<td width="20"><input type="checkbox" id="all" name="avail[]" value="all" onclick="$('.channel').removeAttr('checked');$(this).attr('checked','checked');" checked="checked"/></td>
                    <td>Anywhere</td>
                </tr>
           		 <?php foreach($channels as $c):?>
                <tr>
                	<td width="20"><input type="checkbox" class="channel" name="avail[]" value="<?php echo $c['Channel']['id']?>" onclick="$('#all').removeAttr('checked');"/></td>
                    <td><?php echo $c['Channel']['name']?></td>
                </tr>
          		  <?php endforeach;?>
            </table>
        </div>
        <div class="row">
            <label>Banner Display</label>
            <input type="radio" name="status" value="1" checked="checked"/> Enabled
            <input type="radio" name="status" value="0"/> Disabled
        </div>
        <div class="rowSubmit">
        <input type="submit" name="btnSubmit" value="Upload Banner"/>
        </div>
        <?php echo $this->Form->end();?>
    </div><!-- end .addForm -->
</div><!-- end .content -->