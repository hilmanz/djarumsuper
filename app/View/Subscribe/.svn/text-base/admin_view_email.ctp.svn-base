
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

  <table width="100%" class="tablestyle">
            <tr>
                <td colspan="2">Details</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><?=h($rs['Blast']['subject'])?></td>
            </tr>
            <tr>
                <td colspan="2">
                    Content
                </td>
            </tr>
            <tr>
                <td colspan="2">
                 <div style="width:600px;height:400px;overflow:auto;">
                    <?=h($rs['Blast']['html_content'])?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Created Date</td>
                <td><?=date("d/m/Y H:i:s",strtotime($rs['Blast']['created_date']))?></td>
            </tr>
            <tr>
                <td>Delivery Status</td>
                <td>
                   <?php
                    $statuses = array('Pending','In Progress','Finished');
                    echo $statuses[$rs['Blast']['n_status']];
                ?>
                </td>
            </tr>
            
        </table>
</div><!-- end .content -->