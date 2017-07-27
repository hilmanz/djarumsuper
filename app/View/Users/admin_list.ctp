<div id="subBar">
    <h3 class="titleModule">Administrator Accounts</h3>
    
</div><!-- end #subBar -->
<div class="content">
	
    <div class="listForm">
        <div class="tablestyle">
            <table width="100%" >
                <tr>
                     <td>
                        Name
                    </td>
                    <td>
                        Username
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                <?php foreach($users as $n=>$user):?>
                 <tr>
                    
                     <td>
                        <?=$user['User']['name']?>
                    </td>
                    <td>
                        <?=$user['User']['username']?>
                    </td>
                    <td>
                        <a href="<?=$this->Html->url('/admin/users/edit/'.$user['User']['id'])?>" class="button">Edit</a> &nbsp;
                        <a href="<?=$this->Html->url('/admin/users/remove/'.$user['User']['id'])?>" class="button">Remove</a> 
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
    <div class="btnYes">
        <a href="<?=$this->Html->url('/admin/users/new')?>" style="width:150px;">Create User</a>
    </div>
</div>