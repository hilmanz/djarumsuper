<script>
	var imgpath="";
</script>
<div id="container">
    <div id="content" class="meetingpostPage">
            <div class="titleBox title">
                  <h1>Travelling Alone?</h1>
        		  <h4>On the Go adalah tempat dimana kamu bisa mencari teman untuk berpergian.</h4>
            </div><!-- end .titleBox -->
            <div id="filters">
                <div class="short">
                	<div class="selectmonth">
                    <label>Pilih event bulan</label>
                   <?php echo $this->Form->create(null,array('url'=>'/otg','type'=>'get','enctype'=>'application/x-www-form-urlencode'));?>
                    <select name="m" id="month">
                        <option value="">Semua</option>
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
                   
                    <input id="recent" type="button" value="Terbaru" class="btnTerbaru" onclick="filter_by_counts();return false;" <?php if(isset($popular)&&$popular==1):echo "style='display:none;'";else: echo "style='display:block;'";endif?>/>
                    <input id="popular" type="button" value="Terlaris" class="btnTerbaru" onclick="filter_by_recent();return false;" <?php if(isset($recent)):echo "style='display:none;'";else: echo "style='display:block;'";endif?>/>
                    </div><!-- end .selectmonth -->
                    <div class="selectPlace">
                      <label>Lihat pengalaman seru teman lain di</label>
                        <select name="location" onchange="filter_by_location();return false;">
                        	<option value="">Semua Daerah</option>
                          <?php if(isset($provinces)):?>
                            <?php foreach($provinces as $p):
                              if($p['Provinces']['id']>0):  
                            ?>
                          <option value="<?php echo $p['Provinces']['name_str'];?>" <?php if(isset($current_province)&&$current_province==$p['Provinces']['name_str']):?>selected='selected'<?php endif;?>><?php echo $p['Provinces']['name'];?></option>
                          <?php endif;endforeach;?>
                           <?php endif;?>
                        </select>
                    </div>  <!-- end .selectPlace -->                                                          
                </div><!-- end .short -->
            </div><!-- end #filters -->
            
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableForum">
                <tbody>
                <?php 
                  if(isset($posts)):
                  foreach($posts as $n=>$post):
                    $badges = array(0,3,5);
                ?>
                <tr>
                        <td width="100" align="center"><a href="#"><img src="https://graph.facebook.com/<?=$post['User']['fb_id']?>/picture"></a>
                          <div class="role">
                            <?php for($i=0; $i< $badges[$post['User']['role']]; $i++):?>
                            <?php echo $this->Html->image('/img/star.png');?>
                            <?php endfor;?>
                          </div>
                        </td>
                        <td valign="top">
                        	<div class="pad10">
                                <h3 class="titleCat">
                                	<?php echo $this->Html->link($post['Otg']['title'], array('controller' => 'otg', 'action' => 'view',
                                                                                        $post['Otg']['id']));?>
                                </h3>
                                <p><?=substr($post['Otg']['description'],0,200)?>
                                  <?php
                                    if(strlen($post['Otg']['description'])>200) echo "...";
                                  ?>
                                </p>
                                <div class="actionBtn">
                                    <span class="commentBtn"><?php echo $this->Html->link("Lihat ".number_format($post['answers'])." Tanggapan",
                                                                                        array('controller' => 'otg', 'action' => 'view',
                                                                                        $post['Otg']['id']));?></span> <span class="space">&bull;</span>
                                    <a href="javascript:void(0);" class="showPopup" onclick="popup_otg_answer(<?php echo $n;?>);return false;">Jawab Ajakan</a>
                                </div><!-- end .actionBtn -->
                            </div>
                        </td>
                        <td width="350" valign="top">
                        	<div class="pad10">
                                <h3>When</h3>
                                <p>
                                <span class="dates"><?php echo date("d/m/Y",strtotime($post['Otg']['when']));?></span>
                                </p>
                                <p><a href="#" class="author">Hosted by <?php echo $post['User']['name'];?></a></p>
                                <div class="userjoin">
                                	<span>Tempat Tersisa :</span>
                                	 <?php
                                    $space_left = intval($post['Otg']['people_slot'])-intval($post['total_joined']);
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
                                     <?php echo $this->Html->image('/img/people.png',array('title'=>'Sisa tempat : '.$n_space.' dari '.$post['Otg']['people_slot']));?>
                                     <?php endfor;endif;?>
                                </div>
                            </div>
                        </td>
                    </tr>
              		 <?php endforeach;endif;?>
                </tbody>
            </table>
                <div class="newEvent">
                  <a href="#newEvent" class="newEventBtn showPopup">Submit New Event</a>
                </div>
                <div class="paging">
                   <!-- Shows the next and previous links -->
                    <div class="pagePrev">
                    <?php echo $this->Paginator->prev('«', null, null, array('class' => 'disabled')); ?>
                    </div>
                  <!-- Shows the page numbers -->
                    <div class="pageNumber">
                    <?php echo $this->Paginator->numbers(); ?>
                    </div>
                    <div class="pageNext">
                    <?php echo $this->Paginator->next('»', null, null, array('class' => 'disabled')); ?> 
                    </div>
                  <!-- prints X of Y, where X is current page and Y is number of pages -->
                    <div class="pageCounter">
                    <?php echo $this->Paginator->counter(); ?>
                  </div>
                </div><!-- end .paging -->
            </div><!-- end .content -->
    </div><!-- end #content -->
</div><!-- end #container -->

<div id="reply" class="popup" style="display:none;">
	<div class="popupContent2">
    	<a class="popupClose" href="#">X</a>
        <div class="contentPopup">
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
        </div><!-- end .contentPopup -->
    </div><!-- end .popupContent -->
</div><!-- end #detailEvent -->
<div id="newEvent" class="popup" style="display:none;">
	<div class="popupContent2">
    	<a class="popupClose" href="#">X</a>
        <div class="contentPopup">
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
                    <div class="row">
                      <label>Jumlah Orang :</label>
                       <input type="text" name="jlm_org" value="10" size="5"/>
                    </div>
                    <div class="rowSubmit">
                      <input type="hidden" name="fb_id" value="<?php echo $fb_id;?>"/>
                      
                      <input type="submit" value="SUBMIT" />
                    </div>
                <?php echo $this->Form->end();?>
            </div><!-- end .newEvents -->
        </div><!-- end .contentPopup -->
    </div><!-- end .popupContent -->
</div><!-- end #newEvent -->
<div id="detailEvent" class="popup" style="display:none;">
	<div class="popupContent2">
    	<a class="popupClose" href="#">X</a>
        <div class="contentPopup">
          	<div class="detailEvent">
                <h1 class="title"></h1>
                <span class="place"></span>
                <span class="category"></span>
                <span class="date"></span>
                <span class="author"></span>
                <p></p>
            </div><!-- end .detailEvent -->
        </div><!-- end .contentPopup -->
    </div><!-- end .popupContent -->
</div><!-- end #detailEvent -->
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
  var popular = <?=intval($popular);?>;
  function popup_otg(no){
    var otg = JSON.parse("<?php echo addslashes(json_encode($pp));?>");
    var ct = otg[no];
     if(ct.when==null){
    	ct.when = '';
    }
    if(ct.author==null) ct.author='';
    if(ct.description==null) ct.description='';
    if(ct.place==null) ct.place='';
    
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
    if(ct.when==null){
    	ct.when = '';
    }
    if(ct.author==null) ct.author='';
    if(ct.description==null) ct.author=strip_tags(ct.description);
    $("#post_id").val(ct.id);
    $(".detailEvent h1.title").html(ct.title.toString());
    $(".detailEvent span.date").html("Tanggal Event : "+ct.when.toString());
    $(".detailEvent span.author").html("Oleh : "+ct.author.toString());
    $(".detailEvent p").html(htmlentities(strip_tags(ct.description.toString())));
    jQuery('#reply').fadeIn();
    jQuery("#bgPopup").fadeIn();
  } 
  function filter_by_month(){
  	if(popular){
    	document.location = "<?php echo $this->Html->url("/otg");?>?popular=1&m="+$("#month").val()+'&p='+$("select[name=location]").val();
    }else{
   		document.location = "<?php echo $this->Html->url("/otg");?>?recent=1&m="+$("#month").val()+'&p='+$("select[name=location]").val();
    }
  } 
  function filter_by_recent(){
    document.location = "<?php echo $this->Html->url("/otg");?>?recent=1&m="+$("#month").val()+"&p="+$("select[name=location]").val();
    $("#recent").show();
    $("#popular").hide();
  }
  function filter_by_counts(){
    document.location = "<?php echo $this->Html->url("/otg");?>?popular=1&m="+$("#month").val()+"&p="+$("select[name=location]").val();
    $("#recent").hide();
    $("#popular").show();
  }
  function filter_by_location(){
  	if(popular){
  		document.location = "<?php echo $this->Html->url("/otg");?>?popular=1&m="+$("#month").val()+'&p='+$("select[name=location]").val();
  	}else{
  		document.location = "<?php echo $this->Html->url("/otg");?>?recent=1&m="+$("#month").val()+'&p='+$("select[name=location]").val();
  	}
  }
</script>
<div id="bgPopup"></div>
