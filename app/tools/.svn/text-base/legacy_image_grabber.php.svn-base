<?php
$conn = mysql_connect("localhost","root","root");

$sql = "SELECT tx_rwttnewsupperdeck_main_image as big,
		tx_rwttnewsupperdeck_headline_image as medium,
		image as img
		FROM djarum.old_articles";
		
$q = mysql_query($sql,$conn);
while($fetch = mysql_fetch_assoc($q)){
	print $fetch['big']."-".$fetch['img'].PHP_EOL;
	if(strlen($fetch['big'])>0){
		$big = file_get_contents("http://www.djarum-super.com/uploads/pics/{$fetch['big']}");
		write_file($fetch['big'],$big);
	}
	if(strlen($fetch['img'])>0){
		$img = file_get_contents("http://www.djarum-super.com/uploads/pics/{$fetch['img']}");
		write_file($fetch['img'],$img);
	}
	
}
mysql_close($conn);
function write_file($name,$content){
	$fp = fopen("img/{$name}","w+");
	fwrite($fp,$content,strlen($content));
	fclose($fp);
}
?>