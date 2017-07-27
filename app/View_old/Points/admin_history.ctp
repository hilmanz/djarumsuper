<div id="subBar">
    <h3 class="titleModule">User's Point</h3>
</div><!-- end #subBar -->
<div class="content">
	<div class="row">
	<a href="<?php echo $this->Html->url('/admin/points/index');?>">Back to User List</a>
	</div>
	<div>
		<h3>History</h3>
	</div>
    <div class="listForm">
        <div class="tablestyle">
        	<table width="300">
                <tr>
                    <td colspan="4" style="text-align:center;">
                        Overview
                    </td>
                </tr>
                <tr>
                	<td>Name</td><td><?php echo $user['name'];?></td>
                </tr>
                <tr>
                	<td>Total Score</td><td><?php echo $user['score'];?></td>
                </tr>
            </table>
           <table width="100%" >
                <tr>
                    <td style="text-align:center;">
                        No.
                    </td>
                    <td>
                        Date
                    </td>
                    <td>
                        Ref.ID
                    </td>
                    <td>
                        Activity
                    </td>
                    <td>
                       	Point
                    </td>
                </tr>
                <?php
                if(isset($history)):
				?>
				<?php foreach($history as $n=>$h):?>
					<tr>
                    <td style="text-align:center;">
                        <?php echo number_format($n+1);?>
                    </td>
                    <td>
                        <?php echo date("d/m/Y H:i:s",strtotime($h['UserPointHistory']['submit_date']));?>
                    </td>
                    <td>
                        <?php echo $h['UserPointHistory']['ref_id'];?>
                    </td>
                   
                    <td>
                       <?php echo $h['UserPointHistory']['activity'];?>
                    </td>
                    <td style="text-align:center;">
                       	<?php echo $h['UserPointHistory']['score'];?>
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