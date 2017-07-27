<div id="subBar">
    <h3 class="titleModule">User's Points</h3>
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
                        Name
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                       	Point
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
                <?php
                if(isset($users)):
				?>
				<?php foreach($users as $n=>$user):?>
					<tr>
                    <td style="text-align:center;">
                        <?php echo number_format($n+1);?>
                    </td>
                    <td>
                        <?php echo $user['Login']['name'];?>
                    </td>
                   
                    <td>
                        <?php echo $user['Login']['email'];?>
                    </td>
                    <td style="text-align:center;">
                       	<?php if(isset($user['Point']['score'])):echo $user['Point']['score'];else: echo "0";endif;?>
                    </td>
                    <td>
                        <div class="btnEdit"><a href="<?php echo $this->Html->url('/admin/points/history?id='.$user['Login']['id']);?>">History</a></div>
                    </td>
                </tr>
				<?php endforeach;?>
				<?php
				endif;
				?>
            </table>
        </div><!-- end .tablestyle -->
    </div><!-- end .listForm -->
    <?php
    if(isset($this->Paginator)):
	?>
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
    <?php
	endif;
	?>
</div>