<div id="container">
    <div id="content" class="meetingpostPage">
        <div class="wrapper">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
            	<thead>
                	<tr>
                    	<th colspan="3">
                            <?php echo $this->Html->image('/imgforum/arrow_title.png');?>
                            <span>COMMUNITY FORUM</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	if(isset($posts)):
                	foreach($posts as $n=>$post):
						
                	?>
                    <tr>
                        <td align="center" width="100"><a href="#"><img src="https://graph.facebook.com/<?=$post['User']['fb_id']?>/picture"/></a></td>
                        <td valign="top">
                        	<div class="pad10">
                                <h3 class="titleCat">
                                	<?php echo $this->Html->link($post['Forum']['title'],array('controller' => 'Forum', 'action' => 'view',$post['Forum']['id']));?>
                                </h3>
                                <p>
                             <?php 
                    		$post['Forum']['description'] = htmlentities(stripslashes(strip_tags($post['Forum']['description'])));
                    		if(strlen($post['Forum']['description'])>100){
                    			echo substr($post['Forum']['description'],0,100)."...";
							}else{
								echo $post['Forum']['description'];
							}
                    		?></p>
                            </div>
                        </td>
                        <td valign="top" width="350">
                        	<div class="pad10">
                                <h3>Latest Thread</h3>
                                <?php
                                if(sizeof($post['last_post'])>0):
								?>
                                <p>
                                <span class="dates"><?php echo date("d/m/Y",strtotime($post['last_post'][0]['Reply']['posted_time']));?></span>
                                <a class="author" href="#">By <?php echo strip_tags(stripslashes($post['last_post'][0]['User']['name']));?></a></p>
                                <?php
								else:
                                ?>
                                <p>N/A</p>
                                <?php endif;?>
                                <p><span class="replyCount">Replies : <?php echo number_format($post['answers']);?></span> | 
                                <span class="viewsCount">Views : <?php echo number_format($post['Forum']['total_views']);?> </span>
                                <div class="rating"> 
                                	<span class="rateTexts">Rating :</span> 
									<div class="rateme">
									 <?php 
			                        if(isset($post['rate'])){
			                            for($j=0;$j<$post['rate'];$j++){
			                                echo $this->Html->image('/img/star.png',array('width'=>15,'height'=>15));
			                            }
			                        }else{
			                            for($j=0;$j<5;$j++){
			                                echo $this->Html->image('/img/star2.png',array('width'=>15,'height'=>15));
			                            }
			                        }
			                        ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;endif;?>
                </tbody>
            </table>
            <div class="newEvent">
            	<a href="#newEvent" class="newEventBtn showPopup">+ New Thread</a>
            </div>
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
        <div class="wrapper">
        	<div class="line"></div>
            <div class="titleBox">
            	<h1><a href="#">DEDICATED COMMUNITIES</a></h1>
            </div><!-- end .titleBox -->
            <div class="boxWhite">
            	<?php echo $this->Html->image('/imgforum/community_logo.jpg');?>
            </div>
        </div><!-- end .wrapper -->
    </div><!-- end #content -->
</div><!-- end #container -->

<div id="newEvent" class="popup" style="display:none;">
	<div class="popupContent2">
    	<a class="popupClose" href="#">X</a>
    	<div class="detailEvent">
            <h1 class="title">Create A New Thread</h1>
        </div><!-- end .detailEvent -->
        <div class="newEvents">
        		<?php echo $this->Form->create(null,array('url'=>'/forum/submit','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'newEventsForm'));?>
            	<!--
            	<div class="row">
            		
                	<label>Propinsi Tujuan :</label>
                    <select name="location">
                    	<?php if(isset($provinces)):?>
                    		<?php foreach($provinces as $p):
                    			if($p['Provinces']['id']>0):	
                    		?>
                    	<option value="<?php echo $p['Provinces']['name_str'];?>"><?php echo $p['Provinces']['name'];?></option>
                    	<?php endif;endforeach;?>
                       <?php endif;?>
                    </select>
                </div>
                <div class="row">
                	<label>Kategori</label>
                    <select name="category">
                    	<option value="Land">Land</option>
                    	<option value="Water">Water</option>
                    	<option value="Air">Air</option>
                    </select>
                </div>
                <div class="row">
                	<label>Tempat / Tujuan Wisata :</label>
                    <input type="text" name="place">
                </div>
                <div class="row">
                	<label>Tanggal Berangkat :</label>
                    <input class="datepicker" type="text" name="depart">
                </div>
               -->
                <div class="row">
                	<label>Subject:</label>
                    <input type="text" name="title"/>
                </div>
                <div class="row">
                	<label>Message :</label>
                    <textarea name="desc"></textarea>
                </div>
                <div class="rowSubmit">
                	<input type="hidden" name="fb_id" value="<?php echo $fb_id;?>"/>
                	
                	<input type="submit" value="SUBMIT" />
                </div>
            <?php echo $this->Form->end();?>
        </div><!-- end .replies -->
    </div><!-- end .popupContent -->
</div><!-- end #newEvent -->
<div id="bgPopup"></div>