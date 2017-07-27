<div id="subBar">
    <h3 class="titleModule">Video Management</h3>
    <div class="subnav">
		<?php echo $this->element('video_admin_navigation'); ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
	<h4 class="titlePage">Videos</h4>
    <div class="listForm">
        <div class="tablestyle">
            <table width="100%" >
                <tr>
                    <td style="text-align:center;">
                        No.
                    </td>
                    <td>
                        Snapshot
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
                    <td valign="top"><?php echo $this->Html->image('/content/video/thumb_'.$p['video']['snapshot']);?></td>
                    <td valign="top"><?php echo $p['video']['caption'];?></td>
                    <td valign="top"><?php echo $p['video']['author'];?></td>
                    <td valign="top"><?php echo $p['video']['place'];?></td>
                    <td valign="top"><div class="btnNo"><?php echo $this->Html->link('Delete',"/admin/video/delete/{$p['video']['id']}/{$this->Paginator->current()}");?></div></td>
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