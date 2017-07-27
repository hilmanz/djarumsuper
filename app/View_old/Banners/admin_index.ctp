<div id="subBar">
    <h3 class="titleModule">Banner Management</h3>
    <div class="subnav">
		<?php echo $this->element('banner_admin_navigation'); ?>
    </div>
</div><!-- end #subBar -->
<div class="content">
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
                    	Type
                    </td>
                    <td>
                        Target Url
                    </td>
                    <td>
                        Status
                    </td>
                    <td>
                        Displayed in
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                <?php foreach($posts as $n=>$p):?>
                <tr>
                    <td valign="top" style="text-align:center;"><?php echo $n+1;?></td>
                    <td valign="top"><?php echo $this->Html->image('/content/banner/'.$p['Banner']['filename']);?></td>
                    <td>
                    	<?php if($p['Banner']['banner_type']==1):echo "Sidebar";else:echo "Top Banner";endif;?>
                    </td>
                    <td valign="top"><?php echo $p['Banner']['urlto'];?></td>
                    <td valign="top"><?php if($p['Banner']['is_active']==1):echo "Enabled";else:echo "Disabled";endif;?></td>
                    <td valign="top"><?php
                        foreach($p['BannerChannel'] as $m=>$v){
                            if($m>0){
                                echo "<br/>";
                            }
                            if($v['channel_id']>0){
                                echo $channels[$v['channel_id']];
                            }else{
                                echo "Anywhere";
                            }
                        } 
                        ?>
                    </td>
                    <td valign="top"><div class="btnEdit"><?php echo $this->Html->link('Edit',"/admin/banners/edit/{$p['Banner']['id']}");?></div></td>
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