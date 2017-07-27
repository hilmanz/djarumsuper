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
                	<h1>Travelling Alone?</h1>
					<h4>On the Go adalah tempat dimana kamu bisa mencari teman untuk berpergian.</h4>
                </div>
                <div class="short">
                    <label>Pilih event bulan</label>
                    <select>
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>
                    </select>
                    <input type="button" value="go" class="btnGo" />
                    <input type="button" value="Terbaru" class="btnTerbaru" />
                </div>
                <div class="selectPlace">
                	<label>Lihat pengalaman seru teman lain di</label>
                    <select>
                    	<option>Raja Ampat</option>
                        <option>Bali</option>
                        <option>Gunung Bromo</option>
                    </select>
                </div>
                <div class="row">
                    <div class="post">
                        <div class="entry">
                            <h1 class="title">
                            	<a href="#detailEvent" class="showPopup">Manjat Gunung Salak, ada yang mau ikutan?</a>
                            </h1>
                            <span class="date">Tanggal Event : Selasa, 13 January 2013</span>
                            <span class="author">Oleh : Jejak Kaki David</span>
                        </div><!-- end .entry -->
                        <div class="actionBtn">
                            <a class="commentBtn">3 Tanggapan</a>
                            <a href="#reply" class="replyBtn showPopup">Jawab Ajakan</a>
                        </div><!-- end .actionBtn -->
                    </div><!-- end .post -->
                </div><!-- end .row -->
                <div class="row">
                    <div class="post">
                        <div class="entry">
                            <h1 class="title">
                            	<a href="#detailEvent" class="showPopup">Gw lg cari beberapa temen untuk ikutan naik gunung!</a>
                            </h1>
                            <span class="date">Tanggal Event : Selasa, 13 January 2013</span>
                            <span class="author">Oleh : Bill si Petualang</span>
                        </div><!-- end .entry -->
                        <div class="actionBtn">
                            <a class="commentBtn">15 Tanggapan</a>
                            <a href="#reply" class="replyBtn showPopup">Jawab Ajakan</a>
                        </div><!-- end .actionBtn -->
                    </div><!-- end .post -->
                </div><!-- end .row -->
                <div class="row">
                    <div class="post">
                        <div class="entry">
                            <h1 class="title">
                            	<a href="#detailEvent" class="showPopup">Siapa yang mau ikut gue ke raja ampat??</a>
                            </h1>
                            <span class="date">Tanggal Event : Selasa, 13 January 2013</span>
                            <span class="author">Oleh : Bob</span>
                        </div><!-- end .entry -->
                        <div class="actionBtn">
                            <a class="commentBtn">2 Tanggapan</a>
                            <a href="#reply" class="replyBtn showPopup">Jawab Ajakan</a>
                        </div><!-- end .actionBtn -->
                    </div><!-- end .post -->
                </div><!-- end .row -->
                <div class="newEvent">
                	<a href="#newEvent" class="newEventBtn showPopup">Submit New Event</a>
                </div>
                <div class="paging">
                    <div class="pagePrev">
                        <span class="disabled">« Previous</span>                    
                    </div>
                    <div class="pageNumber">
                        <span class="current">1</span> | 
                        <span><a href="#">2</a></span> | 
                        <span><a href="#">3</a></span> | 
                    </div>
                    <div class="pageNext">
                        <span class="next"><a href="#" rel="next">Next »</a></span> 
                    </div>
                    <div class="pageCounter">
                        1 of 3               	
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
            	<span class="username">Jejak Kaki David</span>
                <span class="joinDate">Bergabung Sejak 20 November 2012</span>
                <span class="totalPoint">41230 Points</span>
            </div>
        </div><!-- end .authorProfile -->
    </div><!-- end .popupContent -->
</div><!-- end #authorProfile -->
<div id="reply" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<div class="detailEvent">
            <h1 class="title">Jawab Ajakan : Siapa yang mau ikut gue ke raja ampat??</h1>
        </div><!-- end .detailEvent -->
        <div class="replies">
        	<form class="replyForm">
            	<div class="row">
                	<label>Nama :</label>
                    <input type="text" disabled="disabled" value="Rina" />
                </div>
                <div class="row">
                	<label>Email :</label>
                    <input type="text" disabled="disabled" value="rina@gmail.com" />
                </div>
                <div class="row">
                	<label>Pesan Kamu :</label>
                    <textarea></textarea>
                </div>
                <div class="rowSubmit">
                	<input type="submit" value="SUBMIT" />
                </div>
            </form>
        </div><!-- end .replies -->
    </div><!-- end .popupContent -->
</div><!-- end #reply -->
<div id="newEvent" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<div class="detailEvent">
            <h1 class="title">Tambah Event Baru</h1>
        </div><!-- end .detailEvent -->
        <div class="newEvents">
        	<form class="newEventsForm">
            	<div class="row">
                	<label>Daerah Tujuan :</label>
                    <select>
                    	<option>Raja Ampat</option>
                        <option>Bali</option>
                        <option>Gunung Bromo</option>
                    </select>
                </div>
                <div class="row">
                	<label>Tanggal Berangkat :</label>
                    <input class="datepicker" type="text">
                </div>
                <div class="row">
                	<label>Judul Ajakan :</label>
                    <input type="text" />
                </div>
                <div class="row">
                	<label>Pesan Ajakan :</label>
                    <textarea></textarea>
                </div>
                <div class="rowSubmit">
                	<input type="submit" value="SUBMIT" />
                </div>
            </form>
        </div><!-- end .replies -->
    </div><!-- end .popupContent -->
</div><!-- end #newEvent -->
<div id="detailEvent" class="popupContainer2">
	<div class="popupContent">
    	<a class="hidePopup" href="#">[X] CLOSE</a>
    	<div class="detailEvent">
            <h1 class="title">Siapa yang mau ikut gue ke raja ampat??</h1>
            <span class="date">Tanggal Event : Selasa, 13 January 2013</span>
            <span class="author">Oleh : Bill si Petualang</span>
            <p>Donec ullamcorper nulla non metus auctor fringilla. Sed posuere consectetur est at lobortis. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div><!-- end .detailEvent -->
    </div><!-- end .popupContent -->
</div><!-- end #detailEvent -->
<div id="bgPopup2"></div>