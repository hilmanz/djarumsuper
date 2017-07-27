
<div id="subBar">
    <h3 class="titleModule">Article Management</h3>
    <div class="subnav">
		<?php
         echo $this->element('article_admin_navigation');
        ?>
    </div>
</div><!-- end #subBar -->

<div class="content">
	<h4 class="titlePage">Article Groups</h4>
		<div class="listForm">
        	<div class="tablestyle">
        		<table width="100%">
		            <tr>
		                <td align="center">
		                    No.
		                </td>
		                <td>
		                    Channel
		                </td>
		                <td>
		                    Category
		                </td>
		                 <td>
		                    Request Alias
		                </td>
		            </tr>
		            <?php 
		            	if(isset($categories)):
		            	foreach($categories as $n=>$category):	
		            ?>
		            <tr>
		            	<td align="center">
		                   <?php echo $n+1;?>
		                </td>
		                <td>
		                	 <?php echo $category['Channel']['name'];?>  
		                  
		                </td>
		                <td>
		                  <?php echo $category['Category']['name'];?>  
		                </td>
		                <td>
		                   <?php echo $category['Category']['name_str'];?>  
		                </td>
		            </tr>
		            <?php endforeach;endif;?>
	            </table>
        	</div>
        </div>
    	<div class="addForm">
		<?php echo $this->Form->create('Article',array('action'=>'groups','type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
		<div class="row">
			<h4>CREATE CATEGORY</h4>
		</div>
		<div class="row">
			<label>Channel</label>
		</div>
		<div class="row">
			<select id="channel_id" name="channel_id">
				<?php if(isset($channels)):?>
					<?php foreach($channels as $channel):?>
						<option value="<?php echo $channel['Channel']['id'];?>"><?php echo $channel['Channel']['name'];?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
		<div class="row">
        	<label>Category Name</label>
       </div>
       <div class="row">
			<input type="text" id="category_name" name="name" value="" size="50"/>
		</div>
		<div class="row">
        	<label>Alias</label>
       </div>
       <div class="row">
			<input type="text" id="alias" name="alias" value="" size="50"/> *) character only, without spaces.
		</div>
		<div class="rowSubmit">
			<input type="submit" name="btnSubmit" value="Add Category"/>
		</div>
		<?php echo $this->Form->end();?>
         </div><!-- end .addForm -->
</div><!-- end .content -->
<script type="application/javascript">
	$(document).ready(function(){
		$("#category_name").keyup(function(){
			var s_name = $("#category_name").val();
			var alias = s_name.replace(/([\~\@\#\$\%\^\&\*\(\)\,\.\;\'\"]+)/,"");
			alias = alias.replace(" ","_");
			alias = strtolower(alias);
			$("#alias").val(alias);
		});
	});
</script>
