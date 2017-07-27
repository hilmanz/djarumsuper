<div id="container">
    <div id="content" class="meetingpostPage">
        <div class="wrapper">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
            	<thead>
                	<tr>
                    	<th colspan="3">
                            <?php echo $this->Html->image('/imgforum/arrow_title.png');?>
                            <span><?=ucfirst(stripslashes(strip_tags($event['Forum']['title'])))?></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                        <td align="center" width="100"><a href="#"><img src="https://graph.facebook.com/<?=$event['User']['fb_id']?>/picture"/></a></td>
                        <td valign="top">
                        	<div class="pad10">
                                <h3 class="titleCat">
                                	<?php echo $this->Html->link($event['Forum']['title'],array('controller' => 'Forum', 'action' => 'view',$event['Forum']['id']));?>
                                </h3>
                                <p>
                             <?php 
                    		$event['Forum']['description'] = htmlentities(stripslashes(strip_tags($event['Forum']['description'])));
							echo $event['Forum']['description'];
                    		?></p>
                            </div>
                        </td>
                        <td valign="top" width="350">
                        	<div class="pad10">
                                <h3>Created</h3>
                                <p>
                                <span class="dates"><?php echo date("d/m/Y",strtotime($event['Forum']['added_time']));?></span>
                                </p>
                              
                                <div class="rating"> 
                                	<span class="rateText">Rating :</span> 
									<div class="rateme"></div>
									<script>
									<?php
									 if(!isset($rate)){
									 	$rate = 0;
									 }
									?>
										$(".rateme").rateme({startValue:<?=intval($rate)?>,disableAfterClick:true,source:"<?=$this->Html->url('/img/')?>",onComplete:function(response){
											console.log(response);
											$.ajax({
											  url: '<?=$this->Html->url("/forum/rate?id={$event['Forum']['id']}")?>&point='+response,
											  dataType: 'json',
											  success: function(rs){
											  	if(rs.status==1){
											  		console.log('voted');
											  	}
											  }});
										}});
									</script>
                                </div>
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
						<?php echo $this->Form->create(null,array('url'=>'/forum/answer','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'replyForm theForm'));?>
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
                                <input type="hidden" id="post_id" name="post_id" value="<?php echo $event['Forum']['id']?>"/>
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