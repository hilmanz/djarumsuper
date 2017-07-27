
<div id="subBar">
    <h3 class="titleModule">Article Management</h3>
    <div class="subnav">
		<?php
         echo $this->element('article_admin_navigation');
        ?>
    </div>
</div><!-- end #subBar -->

<div class="content">
	<h4 class="titlePage">Provinces</h4>
		<div class="addForm">
		<?php echo $this->Form->create(null,array('action'=>'update_province','type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
		<div class="row">
			<h4>EDIT PROVINCE</h4>
		</div>
		<div class="row">
        	<label>Name</label>
       </div>
       <div class="row">
			<?php echo $data['Province']['name'];?>
		</div>
		<div class="row">
			<label>Description</label>
		</div>
		<div class="row">
			<textarea name="description" value="<?php echo stripslashes($data['Province']['description']);?>"></textarea>
		</div>
		<div class="rowSubmit">
			<input type="hidden" name="id" value="<?php echo $data['Province']['id'];?>"/>
			<input type="submit" name="btnSubmit" value="Save"/>
		<?php echo $this->Form->end();?>
         </div><!-- end .addForm -->
</div><!-- end .content -->
