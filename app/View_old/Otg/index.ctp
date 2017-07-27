<div id="header">
    <div id="banner" class="grad">
    	<?php echo $this->Html->image('/content/slider/onthego.jpg');?>
    </div><!-- end #banner -->
</div><!-- end #header -->
<div id="container" class="onthegoPage">
    <div id="content">
        <div id="ring"></div>
        <div class="paper">
            <div class="content">
            	<div class="title">
                	<h1>Cari teman bertualang? Ayo gabung di On The Go!</h1>
                </div>
                <div class="short">
                    <label>Pilih event bulan</label>
                   <?php echo $this->Form->create(null,array('url'=>'/otg','type'=>'get','enctype'=>'application/x-www-form-urlencode'));?>
                    <select name="m" id="month">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <script type="application/javascript">
                    	document.getElementById('month').value="<?php echo $month;?>";
                    </script>
                    <input type="button" value="go" class="btnGo" onclick="filter_by_month();return false;"/>
                    <?php echo $this->Form->end();?>
                    <input id="recent" type="button" value="Terbaru" class="btnTerbaru" onclick="filter_by_counts();return false;" <?php if(isset($popular)):echo "style='display:none;'";else: echo "style='display:block;'";endif?>/>
                    <input id="popular" type="button" value="Terlaris" class="btnTerbaru" onclick="filter_by_recent();return false;" <?php if(isset($recent)):echo "style='display:none;'";
                    																														elseif(!isset($popular)): echo "style='display:none;'";
                    																														else: echo "style='display:block;'";endif?>/>
                </div>
                <div class="selectPlace">
                	<label>Lihat pengalaman seru teman lain di</label>
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
                <?php 
                	if(isset($posts)):
                	foreach($posts as $n=>$post):
                ?>
                <div class="row">
                    <div class="post">
                        <div class="entry">
                            <h1 class="title">
                            	<a href="javascript:void(0);" class="showPopup" onclick="popup_otg(<?php echo $n;?>);return false;"><?php echo $post['Otg']['title'];?></a>
                            </h1>
                            <span class="date">Tanggal Event : <?php echo date("d/m/Y",strtotime($post['Otg']['when']));?></span>
                            <span class="author">Oleh : <?php echo $post['User']['name'];?></span>
                        </div><!-- end .entry -->
                        <div class="actionBtn">
                            <a class="commentBtn"><?php echo number_format($post['answers']);?> Tanggapan</a>
                            <a href="javascript:void(0);" class="replyBtn showPopup" onclick="popup_otg_answer(<?php echo $n;?>);return false;">Jawab Ajakan</a>
                        </div><!-- end .actionBtn -->
                    </div><!-- end .post -->
                </div><!-- end .row -->
               <?php endforeach;endif;?>
                <div class="newEvent">
                	<a href="#newEvent" class="newEventBtn showPopup">Submit New Event</a>
                </div>
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
            </div><!-- end .content -->
        </div><!-- end .paper -->
    </div><!-- end #content -->
    <div id="sidebar">
        <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/trip_advisor.jpg", array(
    									'url' => array('controller' => 'articles', 'action' => 'trip','index')
										));
			?>
        </div><!-- end .box -->
         <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/photography.jpg", array(
    									'url' => array('controller' => 'gallery', 'action' => 'index')
										));
		  ?>
        </div><!-- end .box -->
        <div class="box grad bannerSmall">
         <?php echo $this->Html->image("/content/banner/gear_super.jpg", array(
    									'url' => array('controller' => 'products', 'action' => 'index')
										));
		  ?>
        </div><!-- end .box -->
    </div><!-- end #sidebar -->
</div><!-- end #container -->
<div id="authorProfile" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
        <div class="authorProfile">
        	<div class="thumbFoto">
            	<img src="https://si0.twimg.com/profile_images/1200099700/60_s_hair.jpg" />
            </div><!-- end .thumbFoto -->
            <div class="detailProfile">
            	<span class="username">Jejak Kaki David - <a href="#" class="logout">logout</a></span>
                <span class="joinDate">Bergabung Sejak 20 November 2012</span>
                <span class="totalPoint">41230 Points</span>
            </div>
        </div><!-- end .authorProfile -->
    </div><!-- end .popupContent -->
</div><!-- end #authorProfile -->
<div id="reply" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<?php if(isset($fb_id)):?>
    	<div class="detailEvent">
            <h1 class="title"></h1>
        </div><!-- end .detailEvent -->
        <div class="replies">
        	<?php echo $this->Form->create(null,array('url'=>'/otg/answer','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'replyForm'));?>
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
                	<input type="hidden" id="post_id" name="post_id" value=""/>
                	<input type="submit" value="SUBMIT" />
                </div>
            <?php echo $this->Form->end();?>
        </div><!-- end .replies -->
       <?php else:?>
       	<div>Untuk bisa mengirimkan jawaban, silahkan <?php echo $this->Html->link('login','/login');?> terlebih dahulu.</div>
       	<?php endif;?>
    </div><!-- end .popupContent -->
</div><!-- end #reply -->
<div id="newEvent" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<div class="detailEvent">
            <h1 class="title">Tambah Event Baru</h1>
        </div><!-- end .detailEvent -->
        <div class="newEvents">
        	
        		<?php echo $this->Form->create(null,array('url'=>'/otg/submit','type'=>'post','enctype'=>'application/x-www-form-urlencode','class'=>'newEventsForm'));?>
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
                <div class="row">
                	<label>Judul Ajakan :</label>
                    <input type="text" name="title"/>
                </div>
                <div class="row">
                	<label>Pesan Ajakan :</label>
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
<div id="detailEvent" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<div class="detailEvent">
            <h1 class="title"></h1>
            <span class="place"></span>
            <span class="category"></span>
            <span class="date"></span>
            <span class="author"></span>
            <p></p>
        </div><!-- end .detailEvent -->
    </div><!-- end .popupContent -->
</div><!-- end #detailEvent -->
<div id="bgPopup2"></div>
<?php
$pp = array();
if(isset($posts)):
foreach($posts as $n=>$post){
	$pp[] = array("id"=>$post['Otg']['id'],
					"title"=>$post['Otg']['title'],
					"description"=>$post['Otg']['description'],
					"place"=>$post['Otg']['place'],
					"category"=>$post['Otg']['category'],
					"when"=>date("d/m/Y",strtotime($post['Otg']['when'])),
					"author"=>$post['User']['name']);
}
endif;
?>
<script type="application/javascript">
	function popup_otg(no){
		var otg = JSON.parse("<?php echo addslashes(json_encode($pp));?>");
		var ct = otg[no];
		$(".detailEvent h1.title").html(ct.title.toString());
		$(".detailEvent span.date").html("Tanggal Event : "+ct.when.toString());
		$(".detailEvent span.category").html("Kategori : "+ct.category.toString());
		$(".detailEvent span.place").html("Object / Tujuan Wisata : "+ct.place.toString());
		$(".detailEvent span.author").html("Oleh : "+ct.author.toString());
		$(".detailEvent p").html(htmlentities(strip_tags(ct.description.toString())));
		jQuery('#detailEvent').fadeIn();
		jQuery("#bgPopup").fadeIn();
	}
	function popup_otg_answer(no){
		var otg = JSON.parse("<?php echo addslashes(json_encode($pp));?>");
		var ct = otg[no];
		$("#post_id").val(ct.id);
		$(".detailEvent h1.title").html(ct.title.toString());
		$(".detailEvent span.date").html("Tanggal Event : "+ct.when.toString());
		$(".detailEvent span.author").html("Oleh : "+ct.author.toString());
		$(".detailEvent p").html(htmlentities(strip_tags(ct.description.toString())));
		jQuery('#reply').fadeIn();
		jQuery("#bgPopup").fadeIn();
	}	
	function filter_by_month(){
		document.location = "<?php echo $this->Html->url("/otg");?>?m="+$("#month").val();
	}	
	function filter_by_recent(){
		document.location = "<?php echo $this->Html->url("/otg");?>?recent=1";
		$("#recent").show();
		$("#popular").hide();
	}
	function filter_by_counts(){
		document.location = "<?php echo $this->Html->url("/otg");?>?popular=1";
		$("#recent").hide();
		$("#popular").show();
	}
</script>