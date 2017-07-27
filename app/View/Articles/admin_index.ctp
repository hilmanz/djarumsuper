
<div id="subBar">
    <h3 class="titleModule">Article Management</h3>
    <div class="subnav">
    <?php
     echo $this->element('article_admin_navigation');
    ?>
    </div>
</div>
<cake:nocache>
<div class="content">
	<h4 class="titlePage">Current Articles (<?php echo date("Y-m-d H:i:s");?>)</h4>
	<div class="row">
		<?php echo $this->Form->create('Article',array('action' => 'index','type'=>'get','enctype'=>'application/x-www-form-urlencode'));?>
		<input type="text" name="search" value=""/><input type="submit" name="btnSubmit" value="Search" id="btnSetCategory"/>
		<?php echo $this->Form->end();?>
	</div>
	<div class="row">
    
    <select name="category_id">
        <?php 
        if($this->request->here == $this->Html->url('/admin/articles/')):
        ?>
        <option value="<?=$this->Html->url('/admin/articles/')?>" selected>All Articles</option>
        <?php 
        else:
            ?>
        <option value="<?=$this->Html->url('/admin/articles/')?>">All Articles</option>
        <?php endif;?>
        <?php foreach($categories as $cat):?>
        <?php 
        if($this->request->here == $this->Html->url("/admin/articles/index/{$cat['Category']['id']}")):
        ?>
        <option value="<?=$this->Html->url("/admin/articles/index/{$cat['Category']['id']}")?>" selected>
            <?=$cat['Channel']['name']?> - <?=$cat['Category']['name']?>
        </option>
        <?php else:?>
        <option value="<?=$this->Html->url("/admin/articles/index/{$cat['Category']['id']}")?>">
            <?=$cat['Channel']['name']?> - <?=$cat['Category']['name']?>
        </option>
        <?php endif;?>
    <?php endforeach;?>
    </select>
   
	</div>
    <div class="listForm">
        <div class="tablestyle">
        <table width="100%">
            <tr>
                <td align="center">
                    No.
                </td>
                <td>
                    Category(s)
                </td>
                <td>
                    Title
                </td>
                <td>
                    Summary
                </td>
                <td>
                    Featured
                </td>
                <td>
                    Status
                </td>

                <td>
                    Action
                </td>
            </tr>
            <?php foreach($posts as $n=>$post):?>
            <tr>
                <td align="center" style="text-align:center;">
                    <?php 
                        echo ($n+1)+($this->Paginator->current()*($total_rows))-$total_rows;
                        echo "<a name='{$n}'></a>";
                    ?>
                </td>
                <td>
                    <?php foreach($post['categories'] as $nn=>$cat):?>
                    	<div>
                    	<?php echo $cat['Category']['name'];?>
                    	<?php if($nn<sizeof($post['categories'])-1):print ",";endif;?>
                    	</div>
                    <?php endforeach;?>
                </td>
                <td>
                    <?php echo $post['Article']['title'];?>
                </td>
                <td>
                    <?php echo stripslashes(strip_tags($post['Article']['summary']));?>
                </td>
                <td>
                     <?php $nn=0;
                     	foreach($post['categories'] as $cat):?>
                    	<div>
                    	<?php if($cat['ArticleCategory']['is_featured']==1):echo $cat['Category']['name'];$nn++;
                    		if($nn>1):print ",";endif;
                    	endif;?>
                    	</div>
                    <?php endforeach;?>
                </td>
                <td>
                    <?php
                        if($post['Article']['n_status']==1){
                            echo "Published";
                        }else if($post['Article']['n_status']==2){
                            echo "Rejected";
                        }else{
                            echo "Unpublished / Newly Submitted By User";
                        }
                    ?>
                </td>
                <td>
                    <div class="btnEdit"><?php echo $this->Html->link("Edit","/admin/articles/edit/{$post['Article']['id']}");?></div>
                    
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        </div><!-- end .tablestyle -->
    </div><!-- end .listForm -->
    <div class="paging">
        <!-- Shows the next and previous links -->
        <div class="pagePrev">
            <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
        </div>
        <!-- Shows the page numbers -->
        <div class="pageNumber">
            <?php echo $this->Paginator->numbers(); ?>
        </div>
        <div class="pageNext">
            <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?> 
        </div>
        <!-- prints X of Y, where X is current page and Y is number of pages -->
        <div class="pageCounter">
            <?php echo $this->Paginator->counter(); ?>
        </div>
    </div><!-- end .paging -->
</div>
</cake:nocache>

<script>
$('select[name=category_id]').change(function(e){
    document.location = $(this).val();
});
</script>