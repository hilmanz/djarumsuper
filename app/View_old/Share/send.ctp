<div id="header">
    <div id="banner" class="grad">
    	<div class="slider">
    		<?php if(isset($top_banners)):foreach($top_banners as $top_banner):?>
    		<?php 
				$image =  $this->Html->image("/content/banner/big_{$top_banner['Banner']['filename']}");
				if(@eregi("http://",$banners['Banner']['urlto'])){
					//this is an external link. so we add attribute target=_blank
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("target"=>"_blank","escape"=>false))."</div>";
				}else{
					echo "<div>".$this->Html->link($image,$top_banner['Banner']['urlto'],array("escape"=>false))."</div>";
				}
			?>
			<?php endforeach;endif;?>
    	</div>
    </div><!-- end #banner -->
</div><!-- end #header -->

<div id="container">
    <div id="content">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<?php echo $this->Form->create('Article',array('type'=>'post','enctype'=>'application/x-www-form-urlencode'));?>
            	<?php if(isset($msg)):?>
            	<div class="error"><?php echo $msg;?></div>
            	<?php else: ?>
            	<div class="row">
            	<table width="100%">
            		<tr>
            			<td>Nama Anda</td>
            			<td><input type="text" name="sender_name" value=""/></td>
            		</tr>
            		<tr>
            			<td>Email Anda</td>
            			<td><input type="text" name="sender_email" value=""/></td>
            		</tr>
            		<tr>
            			<td>Email Teman</td>
            			<td><input type="text" name="friend_email" value=""/></td>
            		</tr>
            		
            		<tr>
            			<td>Pesan</td>
            			<td><textarea name="message"></textarea></td>
            		</tr>
					<tr>
						<td></td>
						<td>
							<div style="float: left;">
				        		<img alt="captcha" class="captcha">
				    		</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<div style="float: left;">
		            			<p>Masukkan kode pada gambar</p>
								<input type="text" name="captcha" value="" maxlength="12"/>
						    </div>
							<script type="text/javascript">
							    $(function() { // jQuery, onload
							        $(".captcha").attr('src', '<?php echo $this->Html->url('/share/captcha/'.time(),true);?>');
							    });
							</script>
						</td>
					</tr>		
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="article_id" value="<?php echo $article_id;?>" maxlength="12"/>
							<input type="hidden" name="r" value="<?php echo $r;?>"/>
							<input type="submit" value="Kirim"/>
						</td>
					</tr>
            	</table>
            	</div>
            	<?php endif;?>
            	<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
	<div id="sidebar">
    	<!--merchandise-->
        <?php echo $this->element('merchandise');?>
        <!--bannerSmall-->
        <?php echo $this->element('small_banner');?>
    </div><!-- end #sidebar -->
</div>