<?php
	$meeting = $this->requestAction('/otg/top_otg_widget/2');

?>	

 <div class="wrapper">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
	  <thead>
	      <tr>
	          <th colspan="3">
	                <?php echo $this->Html->image('/imgforum/arrow_title.png');?>
	                <span>ON THE GO</span>
	            </th>
	        </tr>
	    </thead>
	    <tbody>
	<?php

	        for($i=0;$i<sizeof($meeting);$i++):
	        ?>
	        <tr>
	            <td  align="center" width="100"><a href="#"><img src="https://graph.facebook.com/<?=$meeting[$i]['Users']['fb_id']?>/picture"/></a></td>
	            <td valign="top">
	              <div class="pad10">
	                    <h3 class="titleCat">
	                      <?php echo $this->Html->link(ucfirst($meeting[$i]['Otg']['title']), 
	                                                        array('controller' => 'otg', 
	                                                            'action' => 'view',
	                                                            $meeting[$i]['Otg']['id']));?>
	                    </h3>
	                    <p><?php 
	                        $meeting[$i]['Otg']['description'] = htmlentities(stripslashes(strip_tags($meeting[$i]['Otg']['description'])));
	                        if(strlen($meeting[$i]['Otg']['description'])>100){
	                            echo substr($meeting[$i]['Otg']['description'],0,100)."...";
	                        }else{
	                            echo $meeting[$i]['Otg']['description'];
	                        }
	                        ?></p>
	                </div>
	            </td>
	            <td valign="top" width="350">
	              <div class="pad10">
	                    <h3>When</h3>
	                    <p>
	                    <span class="dates"><?php echo date("d/m/Y",strtotime($meeting[$i]['Otg']['when']));?></span>
	                    </p>
	                    <p><a href="#" class="author">Hosted by <?php echo $meeting[$i]['Users']['name'];?></a></p>
	                    <div class="userjoin">
	                        <span>Tempat Tersisa :</span>
	                         <?php
	                          $space_left = intval($meeting[$i]['Otg']['people_slot'])-
                          					intval($meeting[$i]['total_joined']);
	                          $n_space = $space_left;
	                          if($space_left>10) $space_left = 10;
	                          if($space_left<0) $space_left = 0;
	                              if($space_left==0):
	                          ?>
	                          <span class="fullbooked">Full Booked</span>
	                          <?php
	                              else:
	                              for($j=0;$j<$space_left;$j++):
	                          ?>
	                           <?php echo $this->Html->image('/img/people.png',
	                           							array('title'=>'Sisa tempat : '.
	                           											$n_space.
	                           											' dari '.
	                           											$meeting[$i]['Otg']['people_slot']
	                           									)
	                           		);
	                           ?>
	                           <?php endfor;endif;?>
	                    </div>
	                </div>
	            </td>
	        </tr>
	  <?php  endfor; ?>
	    </tbody>
	</table>
	<?php if(sizeof($meeting)>0):?>
	      
	<div class="newEvent">
	  <a class="newEventBtn showPopup" href="<?=$this->Html->url('/otg')?>">
	      More Invitations
	    </a>
	</div>
	<?php endif;?>
</div><!-- end .wrapper -->