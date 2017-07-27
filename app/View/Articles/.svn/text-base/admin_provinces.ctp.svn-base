
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
		<div class="listForm">
        	<div class="tablestyle">
        		<table width="100%">
		            <tr>
		                <td align="center" style="width:40px;">
		                    No.
		                </td>
		                <td>
		                    Name
		                </td>
		                <td>
		                    Description
		                </td>
		                <td>
		                    Action
		                </td>
		            </tr>
		            <?php 
		            	if(isset($provinces)):
		            	foreach($provinces as $n=>$province):	
		            ?>
		            <?php if($n>0):?>
		            <tr>
		            	<td align="center">
		                   <?php echo $n;?>
		                </td>
		                <td>
		                	 <?php echo $province['Province']['name'];?>  
		                </td>
		                <td>
		                	 <?php echo $province['Province']['description'];?>  
		                </td>
		                <td>
		                 <?php echo $this->Html->link("Edit","/admin/articles/edit_province?id={$province['Province']['id']}",array("class"=>""));?>
		                </td>
		            </tr>
		           	<?php endif;?>
		            <?php endforeach;endif;?>
	            </table>
        	</div>
        </div>
</div><!-- end .content -->
