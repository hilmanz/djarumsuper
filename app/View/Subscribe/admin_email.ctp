<?php
if(isset($rs)){
    $pageParams = $this->Paginator->params();
    $currPage = $pageParams['page'];
    $pageLimit = $pageParams['limit'];
}
?>
<div id="subBar">
    <h3 class="titleModule">Email Blast</h3>
   <div class="subnav">
    <span style="padding-right:20px;">
    <a class="" href="<?=$this->Html->url('/admin/subscribe/')?>">View Subscriptions</a>
    <a class="" href="<?=$this->Html->url('/admin/subscribe/email')?>">Email Blast</a>
    <a class="" href="<?=$this->Html->url('/admin/subscribe/new_email')?>">Send Email</a>
    </span>
    <span style="padding-right:20px;">
    </div>
</div><!-- end #subBar -->
<div class="content">
    <table class="tablestyle">
        <tr>
            <td>No.</td>
            <td>Created Date</td>
            <td>Subject</td>
            <td>Progress</td>
            <td>Status</td>
        </tr>
      
        <?php foreach($rs as $n=>$r):?>
        <tr>
            <td><?=($n+1+(($currPage-1)*$pageLimit))?></td>
            <td><?=date("d/m/Y H:i:s",strtotime($r['Blast']['created_date']))?></td>
            <td><a href="<?=$this->Html->url('/admin/subscribe/view_email/'.$r['Blast']['id'])?>">
                    <?=h($r['Blast']['subject'])?>
                </a>
            </td>
            <td>
                <?php
                    if($r['Blast']['email_queue']>0){
                        $percent = ($r['Blast']['progress'] / $r['Blast']['email_queue'])
                                * 100;
                    }else{
                        $percent = 0;
                    }
                    echo round($percent);
                ?> %
            </td>
            <td>
                <?php
                    $statuses = array('Pending','In Progress','Finished');
                    echo $statuses[$r['Blast']['n_status']];
                ?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <div class="paging">
        <?php if(isset($rs)):?>
        <?php echo $this->Paginator->numbers();?>
        <?php endif;?>
    </div>
</div><!-- end .content -->