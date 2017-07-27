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
            	<div class="box">
            	<?php echo $msg;?>
            	</div>
            	<div>
            	<?php echo $this->Html->link("Kembali","/otg");?>
            	</div>
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