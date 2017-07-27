<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="Djarum,Sport "/>
<META NAME="description" CONTENT="Djarum Supper Soccer.">
<title>DJARUM SUPER</title>
<?php echo $this->Html->meta('icon', 'img/favicon.ico');?>
<?php echo $this->Html->css(array('djarum','skin','minimalist/jquery.slider')); ?>
<?php echo $this->Html->css(array('superfish','jquery.fancybox-1.3.4'),null,array('media'=>'screen')); ?>
<?php echo $this->Html->script(array('php.default.min','jquery-1.4.3.min','underscore-min','backbone-min','hoverIntent',
								 'superfish','djarum','jquery.jcarousel.min',
								 'slider/jquery.slider','jquery.mousewheel-3.0.4.pack',
								 'jquery.fancybox-1.3.4.pack'));?>

<!--[if IE 6]>
<?php echo $this->Html->css(array('minimalist/jquery.slider.ie6'),'stylesheet'); ?>
<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .grad {
       filter: none;
    }
  </style>
<![endif]-->
<script type="application/javascript">
tripUrl = "<?php echo $this->Html->url('/articles/trip');?>";	
</script>

</head>

<body id="tripPage">
<div id="trip-advisor">
	<div id="top">
    	<?php echo $this->Html->link(' ','/',array('id'=>'logo'));?>
    </div><!-- end #top -->
    <div id="navTrip" class="grad">
 		<div class="w960">
   			<?php echo $this->element('navigation');?>
        </div>
    </div>
	<div id="tripContainer">
    	<div id="peta">
        	<?php echo $this->Html->image("indonesia.png",array("border"=>0,
        														"usemap"=>"#Map"));
			?>
            <map name="Map" id="Map">
              <area class="viewPopup" shape="rect" coords="46,60,83,73" href="#mapGallery" onclick="open_article(1);return false;"/>
              <area class="viewPopup" shape="rect" coords="98,94,157,121" href="#mapGallery" onclick="open_article(2);return false;"/>
              <area class="viewPopup" shape="rect" coords="92,181,153,208" href="#mapGallery" onclick="open_article(3);return false;"/>
              <area class="viewPopup" shape="rect" coords="150,146,184,159" href="#mapGallery" onclick="open_article(4);return false;"/>
              <area class="viewPopup" shape="rect" coords="171,188,211,204" href="#mapGallery" onclick="open_article(5);return false;"/>
              <area class="viewPopup" shape="rect" coords="123,228,185,243" href="#mapGallery" onclick="open_article(6);return false;"/>
              <area class="viewPopup" shape="rect" coords="202,217,259,242" href="#mapGallery" onclick="open_article(7);return false;"/>
              <area class="viewPopup" shape="rect" coords="235,118,299,145" href="#mapGallery" onclick="open_article(8);return false;"/>
              <area class="viewPopup" shape="rect" coords="328,157,396,184" href="#mapGallery" onclick="open_article(9);return false;"/>
              <area class="viewPopup" shape="rect" coords="266,196,322,223" href="#mapGallery" onclick="open_article(10);return false;"/>
              <area class="viewPopup" shape="rect" coords="379,195,448,220" href="#mapGallery" onclick="open_article(11);return false;"/>
              <area class="viewPopup" shape="rect" coords="445,226,514,252" href="#mapGallery" onclick="open_article(12);return false;"/>
              <area class="viewPopup" shape="rect" coords="484,195,538,223" href="#mapGallery" onclick="open_article(13);return false;"/>
              <area class="viewPopup" shape="rect" coords="442,125,517,155" href="#mapGallery" onclick="open_article(14);return false;"/>
              <area class="viewPopup" shape="rect" coords="545,131,611,145" href="#mapGallery" onclick="open_article(15);return false;"/>
              <area class="viewPopup" shape="rect" coords="621,99,682,127" href="#mapGallery" onclick="open_article(16);return false;"/>
              <area class="viewPopup" shape="rect" coords="661,167,711,194" href="#mapGallery" onclick="open_article(17);return false;"/>
              <area class="viewPopup" shape="rect" coords="581,240,645,268" href="#mapGallery" onclick="open_article(18);return false;"/>
              <area class="viewPopup" shape="rect" coords="551,172,612,203" href="#mapGallery" onclick="open_article(19);return false;"/>
              <area class="viewPopup" shape="rect" coords="812,181,878,215" href="#mapGallery" onclick="open_article(20);return false;"/>
              <area class="viewPopup" shape="rect" coords="919,242,964,259" href="#mapGallery" onclick="open_article(21);return false;"/>
              <area class="viewPopup" shape="rect" coords="694,261,746,281" href="#mapGallery" onclick="open_article(22);return false;"/>
              <area class="viewPopup" shape="rect" coords="493,257,555,281" href="#mapGallery" onclick="open_article(23);return false;"/>
              <area class="viewPopup" shape="rect" coords="564,356,652,379" href="#mapGallery" onclick="open_article(24);return false;"/>
              <area class="viewPopup" shape="rect" coords="473,314,566,341" href="#mapGallery" onclick="open_article(25);return false;"/>
              <area class="viewPopup" shape="rect" coords="435,330,465,345" href="#mapGallery" onclick="open_article(26);return false;"/>
              <area class="viewPopup" shape="rect" coords="378,314,417,342" href="#mapGallery" onclick="open_article(27);return false;"/>
              <area class="viewPopup" shape="rect" coords="317,298,364,326" href="#mapGallery" onclick="open_article(28);return false;"/>
              <area class="viewPopup" shape="rect" coords="260,286,313,298" href="#mapGallery" onclick="open_article(29);return false;"/>
              <area class="viewPopup" shape="rect" coords="257,326,294,353" href="#mapGallery" onclick="open_article(30);return false;"/>
              <area class="viewPopup" shape="rect" coords="303,349,379,370" href="#mapGallery" onclick="open_article(31);return false;"/>
              <area class="viewPopup" shape="rect" coords="176,262,233,276" href="#mapGallery" onclick="open_article(32);return false;"/>
              <area class="viewPopup" shape="rect" coords="203,309,251,329" href="#mapGallery" onclick="open_article(33);return false;"/>
            </map>
    	</div>
        <div class="tagline">
        	<h1>Jelajahi Indonesia, Lihat pengalaman seru bloggers!</h1>
        </div>
    </div>
	<div id="hw">
    	<div id="hwText"></div>
    </div><!-- end #hw -->
</div><!-- end #land -->

<div id="mapGallery" class="popupContainer">
    <div id="popupContent">
        <a class="closePopup" href="#">&nbsp;</a>
        <div class="popupContent">
            
        </div><!-- end .poupContent -->
        
    </div><!-- end #poupContent -->
</div><!-- end .popupContainer -->
<div id="bgPopup"></div>
</body>
</html>
