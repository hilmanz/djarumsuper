<?php
	$comments = $this->requestAction('/articles/get_comments/'.$article_id);
?>	

 <div class="wrapper">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
	  <thead>
	      <tr>
	          <th colspan="2">
	                <?php echo $this->Html->image('/imgforum/arrow_title.png');?>
	                <span>Review dari Destinasi Ini</span>
	            </th>
	        </tr>
	    </thead>
	    <tbody>
			<?php
			if(sizeof($comments)>0):
	        for($i=0;$i<sizeof($comments);$i++):
	        ?>
	        <tr>
	            <td  align="center" width="100" valign="top">
	            	<div class="pad10">
		            	<a href="#">
		            		<img src="https://graph.facebook.com/<?=$comments[$i]['User']['fb_id']?>/picture"/>
		            	</a>
		            	<div class="user-name">
		            		<?=h($comments[$i]['User']['name'])?>
		            	</div>
	            	</div>	
	            </td>
	            <td valign="top">
	              <div class="pad10">
	                    <h3 class="titleCat">
	                     	<?=h($comments[$i]['ArticleComment']['subject'])?>
	                    </h3>
	                    <p class="rating">
	                    	<?php
	                    	for($j=0;$j<$comments[$i]['ArticleComment']['rating'];$j++){
                                echo $this->Html->image('/img/star.png');
                            }
	                    	?>
	                    </p>
	                    <p>
	                    	<?=nl2br(h($comments[$i]['ArticleComment']['comment']))?>
	                    </p>
	                </div>
	            </td>
	        </tr>
	  <?php  endfor; ?>
		<?php else:?>
		<tr>
			<td colspan="2"><div class="pad10">Belum ada komentar.</div></td>
		</tr>
	<?php endif;?>
	    </tbody>
	</table>
	
	      
	<div class="newEvent">
	<?php if(sizeof($comments)>0):?>
	  <a class="newEventBtn showPopup" href="#popup-daftarkomentar" style="margin-left:10px;">
	      Komentar Lainnya
	  </a>
	 <?php endif;?>
	  <a class="newEventBtn btn-kirim-review" href="javascript:;">
	      Kirim Review Disini
	    </a>
	   
	</div>
	
</div><!-- end .wrapper -->

<script>

$(".btn-kirim-review").click(function(){
	$(".form-review").fadeIn();
});

</script>

<div id="popup-daftarkomentar" class="popup">
	<div class="popup-entry">
			<?php
			if(sizeof($comments)>0):
	        for($i=0;$i<sizeof($comments);$i++):
	        ?>
            <div class="row-comment">
	            	<div class="comment-author">
		            	<a href="#">
		            		<img src="https://graph.facebook.com/<?=$comments[$i]['User']['fb_id']?>/picture"/>
		            	</a>
		            	<div class="user-name">
		            		<?=h($comments[$i]['User']['name'])?>
		            	</div>
	            	</div>	
	              <div class="commment-entry">
	                    <h3 class="titleCat">
	                     	<?=h($comments[$i]['ArticleComment']['subject'])?>
	                    </h3>
	                    <p class="rating">
	                    	<?php
	                    	for($j=0;$j<$comments[$i]['ArticleComment']['rating'];$j++){
                                echo $this->Html->image('/img/star.png');
                            }
	                    	?>
	                    </p>
	                    <p>Justice is about harmony. Revenge is about you making yourself feel better. </p>
	                </div>
            </div><!-- end .row-comment -->
	  <?php  endfor; ?>
		<?php else:?>
		<p>Belum ada komentar.</p>
	<?php endif;?>
	</div><!-- end .popup-entry -->
</div><!-- end #popup-daftarkomentar -->
<div id="bgPopup"></div>