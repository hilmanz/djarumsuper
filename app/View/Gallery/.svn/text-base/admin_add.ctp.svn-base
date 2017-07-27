<div id="subBar">
    <h3 class="titleModule">Gallery Management</h3>
    <div class="subnav">
		<?php  echo $this->element('gallery_admin_navigation');  ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
    <h4 class="titlePage">Create Upload Picture</h4>
    <div class="addForm">
        <?php echo $this->Form->create('Gallery',array('type'=>'file'));?>
        <div class="row">
        <label>File</label>
        <?php echo $this->Form->file('img');?>
        </div>
        <div class="row">
        <label>Caption</label>
        <input name="caption" value="" size="50" type="text"/>
        </div>
        <div class="row">
        <label>Photographer / Author</label>
        <input name="author" value="" size="50" type="text"/>
        </div>
        <div class="row">
        <label>Place</label>
        <input name="place" value="" size="50" type="text"/>
        </div>
        <div class="rowSubmit">
        <input type="submit" name="btnSubmit" value="Upload Picture"/>
        </div>
        <?php echo $this->Form->end();?>
    </div><!-- end .addForm -->
</div><!-- end .content -->