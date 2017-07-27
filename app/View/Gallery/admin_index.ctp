<div id="subBar">
    <h3 class="titleModule">Gallery Management</h3>
    <div class="subnav">
		<?php echo $this->element('gallery_admin_navigation'); ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
	<h4 class="titlePage">Pictures</h4>
    <div class="listForm">
        <div class="tablestyle">
            <table width="100%" >
                <tr>
                    <td style="text-align:center;">
                        No.
                    </td>
                    <td>
                        Image
                    </td>
                    <td>
                        Caption
                    </td>
                    <td>
                        By
                    </td>
                    <td>
                        Place
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                <?php foreach($posts as $n=>$p):?>
                <tr>
                    <td valign="top" style="text-align:center;"><?php echo $n+1;?></td>
                    <td valign="top"><?php echo $this->Html->image('/content/gallery/thumb_'.$p['Gallery']['filename']);?></td>
                    <td valign="top"><?php echo $p['Gallery']['caption'];?></td>
                    <td valign="top"><?php echo $p['Gallery']['author'];?></td>
                    <td valign="top"><?php echo $p['Gallery']['place'];?></td>
                    <td valign="top"><div class="btnNo"><?php echo $this->Html->link('Delete',"/admin/gallery/delete/{$p['Gallery']['id']}/{$this->Paginator->current()}");?></div></td>
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