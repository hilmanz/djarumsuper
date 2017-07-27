<?php
if(isset($rs)){
    $pageParams = $this->Paginator->params();
    $currPage = $pageParams['page'];
    $pageLimit = $pageParams['limit'];
}
?>
<div id="subBar">
    <h3 class="titleModule">Email Subscribers</h3>
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
            <td>Name</td>
            <td>Email</td>
            <td>Subscribed Date</td>
            <td></td>
        </tr>
        <?php foreach($rs as $n=>$r):?>
        <tr>
            <td><?=($n+1+(($currPage-1)*$pageLimit))?></td>
            <td><?=h($r['Login']['name'])?></td>
            <td><?=h($r['Subscribe']['email'])?></td>
            <td><?=date("d/m/Y H:i:s",strtotime($r['Subscribe']['subscribed_date']))?></td>
            <td><a href="<?=$this->Html->url('/admin/subscribe/remove/'.$r['Subscribe']['id'])?>" class="btnEdit">Unsubscribe</a></td>
        </tr>
        <?php endforeach;?>
    </table>
    <div class="paging">
        <?php if(isset($rs)):?>
        <?php echo $this->Paginator->numbers();?>
        <?php endif;?>
    </div>
</div><!-- end .content -->