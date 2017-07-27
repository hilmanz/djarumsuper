<?php
$total = (isset($total)) ? $total : 1;
$size = (isset($size)) ? $size : '300x300';
$zone = (isset($zone)) ? $zone : '*';
$className = (isset($className)) ? $className : 'ads300 widget';
$banner = $this->requestAction('/ccake/banners/widget_zone_banner/'.$zone.'/'.$size.'?rows='.$total);
?>

<?php if(sizeof($banner)>0):foreach($banner as $b):?>
<?php
$img = Configure::read('UPLOAD_DIR_WWW').'banners/'.$b['Banner']['file'];
$url = Configure::read('BANNER_WWW').'ccake/banners/click/'.
			$b['Banner']['id'].'/'.$b['BannerZone']['binded_slug'].'/'.
			$b['BannerCategory']['size_limit'].'/?url='.$b['Banner']['url'].'';
?>
<div class="<?=$className?>">
<a href="<?=$url?>">
	<img src="<?=$img?>"/>
</a>
</div>
<?php endforeach;endif;?>