<?php
$total = (isset($total)) ? $total : 1;
$show = (isset($show)) ? $show : 1;
$slot = (isset($slot)) ? $slot : 'default';
$banner = $this->requestAction('/ccake/banners/get?slot='.$slot.'&total='.$total.'&show='.$show);

$shown = array(); //shown banner
for($i=0;$i<$show;$i++){
	$shown[] = $banner[$i]['Banner'];
}
?>
<?php
foreach($shown as $b):
	$img_url = Configure::read('UPLOAD_DIR_WWW').'banners/'.$b['file'];
?>
<div class="banner <?=strtolower($slot)?>">
<a href="<?=$this->Html->url($b['url'].'')?>"><img src="<?=$img_url?>"/></a>
</div>
<?php endforeach;?>