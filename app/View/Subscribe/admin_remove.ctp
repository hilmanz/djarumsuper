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
    <div>
        Are you sure want to opted-out '<?=h($rs['Subscribe']['email'])?>' from database ?
    </div>
    <div>
       
            <a href="<?=$this->Html->url('/admin/subscribe/remove/'.$rs['Subscribe']['id'].'?confirm=1')?>" class="btnYes">Yes, Remove the email immediately !</a>

      
            <a href="<?=$this->Html->url('/admin/subscribe')?>" class="btnNo">
                Cancel, I changed my mind.
            </a>
       
    </div>
</div><!-- end .content -->