<?php
$badges = array(0,3,5);
?>
<div id="container">
    <div id="content" class="meetingpostPage">
        <div class="wrapper">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
            	<thead>
                	<tr>
                    	<th colspan="3">
                            <?php echo $this->Html->image('/imgforum/arrow_title.png');?>
                            <span><?=ucfirst(stripslashes(strip_tags($event['Otg']['title'])))?></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                        <td align="center" width="100">
                            <a href="#"><img src="https://graph.facebook.com/<?=$event['User']['fb_id']?>/picture"/></a>
                            <div class="role">
                                <?php for($i=0; $i< $badges[$event['User']['role']]; $i++):?>
                                <?php echo $this->Html->image('/img/star.png');?>
                                <?php endfor;?>
                            </div>
                        </td>
                        <td valign="top">
                        	<div class="pad10">
                                <h3 class="titleCat">
                                	<?php echo $this->Html->link($event['Otg']['title'],array('controller' => 'otg', 'action' => 'view',$event['Otg']['id']));?>
                                </h3>
                                <p>
                             <?php 

                    		$event['Otg']['description'] = htmlentities(stripslashes(strip_tags($event['Otg']['description'])));
							echo $event['Otg']['description'];
                    		?></p>
                            </div>
                        </td>
                        <td valign="top" width="350">
                        	<div class="pad10">
                                <h3>When</h3>
                                <p>
                                <span class="dates"><?php echo date("d/m/Y",strtotime($event['Otg']['when']));?></span>
                                </p>
                                <p><a class="author" href="#">Hosted by  <?php echo $event['User']['name'];?></a></p>
                                <div class="userjoin">
                                    <span>Tempat Tersisa :</span>
                                    <?php
                                    $space_left = intval($event['Otg']['people_slot'])-intval($total_joined);
                                    $n_space = $space_left;
                                    if($space_left>10) $space_left = 10;
                                    if($space_left<0) $space_left = 0;
                                        if($space_left==0):
                                    ?>
                                    <span class="fullbooked">Full Booked</span>
                                    <?php
                                        else:
                                        for($i=0;$i<$space_left;$i++):
                                    ?>
                                     <?php echo $this->Html->image('/img/people.png',array('title'=>'Sisa tempat : '.$n_space.' dari '.$event['Otg']['people_slot']));?>
                                     <?php endfor;endif;?>
                                </div>
                                <p>
                                    <?php 
                                        if($space_left>0&&isset($fb_id)){
                                            if(!isset($fb_id)){
                                                $fb_id=0;
                                            }
                                            echo $this->Html->link('Ikut',
                                            '/otg/join/?id='.$event['Otg']['id']."&fb_id=".$fb_id,
                                            array('class'=>'joinBtn'));
                                        }
                                    ?>
                                    <a href="#" class="joinBtn" onclick="show_participant();">Participant</a>
                                </p>
                            </div>
                        </td>
                    </tr>
                	<?php 
                	if(isset($posts)):
                	foreach($posts as $n=>$post):
                	?>
                    <tr>
                        <td align="center" width="100" style="padding:10px 0;">
                        	<a href="#"><img src="https://graph.facebook.com/<?=$post['User']['fb_id']?>/picture"/></a>
                        	 <div class="role">
                                <?php for($i=0; $i< $badges[$post['User']['role']]; $i++):?>
                                <?php echo $this->Html->image('/img/star.png');?>
                                <?php endfor;?>
                            </div>
                        </td>
                        <td valign="top" colspan="2">
                        	<div class="pad10">
                        	<p><?=strip_tags(stripslashes($post['User']['name']))?> - <?=date("d/m/Y H:i",strtotime($post['Reply']['posted_time']))?></p>
							<?php echo nl2br(strip_tags($post['Reply']['answer']));?></p>
                            </div>
                        </td>
                        
                    </tr>
                    <?php endforeach;endif;?>
                </tbody>
            </table>
         	<?php if(isset($this->Paginator)):?>
            <div class="paging">
                <!-- Shows the next and previous links -->
                <div class="pagePrev">
                    <?php echo @$this->Paginator->prev('«', null, null, array('class' => 'disabled')); ?>
                </div>
                <!-- Shows the page numbers -->
                <div class="pageNumber">
                    <?php echo @$this->Paginator->numbers(); ?>
                </div>
                <div class="pageNext">
                    <?php echo @$this->Paginator->next('»', null, null, array('class' => 'disabled')); ?> 
                </div>
                <!-- prints X of Y, where X is current page and Y is number of pages -->
                <div class="pageCounter">
                    <?php echo @$this->Paginator->counter(); ?>
                </div>
            </div><!-- end .paging -->
            <?php endif;?>
        </div><!-- end .wrapper -->
        
        
        <?php if(isset($fb_id)):?>
        <div id="respond" class="replies">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
            <thead>
                <tr>
                    <th colspan="3">
                        <span>Balas</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top">
						<?php echo $this->Form->create(null,array('url'=>'/otg/answer','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'replyForm theForm'));?>
                            <div class="row">
                                <label>Nama :</label>
                                <input name="name" type="text" disabled="disabled" value="<?php echo $me['name'];?>" />
                            </div>
                            <div class="row">
                                <label>Email :</label>
                                <input name="email" type="text" disabled="disabled" value="<?php echo $me['email'];?>" />
                            </div>
                            <div class="row">
                                <label>Pesan Kamu :</label>
                                <textarea name="message"></textarea>
                            </div>
                            <div class="rowSubmit">
                                <input type="hidden" name="fb_id" value="<?php echo $fb_id;?>"/>
                                <input type="hidden" id="post_id" name="post_id" value="<?php echo $event['Otg']['id']?>"/>
                                <input type="submit" value="SUBMIT" />
                            </div>
                        <?php echo $this->Form->end();?>
                    </td>
                </tr>
            </tbody>
        </table>
        </div><!-- end .replies -->
       <?php else:?>
       	<div class="notLoginMessage">Untuk bisa mengirimkan jawaban, silahkan <a href="javascript:fblogin();">Login</a> terlebih dahulu.</div>
       	<?php endif;?>
    </div><!-- end #content -->
</div><!-- end #container -->

<!--participant -->
<div id="participant" class="popup" style="display:none;">
    <div class="popupContent2">
        <a class="popupClose" href="#">X</a>
        <div class="contentPopup">
            <div class="detailEvent">
                <h1 class="title">Participants</h1>
            </div><!-- end .detailEvent -->



            <div class="newEvents">
                <?php
                if(is_array($participant)):
                foreach($participant as $n=>$v):
                ?>
                <div class="members">
                    <img src="http://graph.facebook.com/<?=$v['Users']['Logins']['fb_id']?>/picture"/>
                    <p><?=$v['Users']['Logins']['name']?></p>
                </div>
               <?php endforeach;endif;?>
            </div><!-- end .newEvents -->
        </div><!-- end .contentPopup -->
    </div><!-- end .popupContent -->
</div><!-- end #participant -->
<script>
function show_participant(){
    $("#participant").show();
}
</script>