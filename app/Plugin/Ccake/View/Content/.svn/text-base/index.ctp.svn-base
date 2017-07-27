<?php
//search for variable
preg_match_all('/(\{\{)([a-zA-Z0-9]+)(\}\})/i',$content,$matches,PREG_SET_ORDER);
foreach($matches as $n=>$match){
	$content = str_replace('{{'.$match[2].'}}',${$match[2]},$content);
}
//search for widgets
preg_match_all('/(\{\[)([a-zA-Z0-9\_\.]+)(\]\})/i',$content,$matches,PREG_SET_ORDER);
foreach($matches as $n=>$match){
	$content = str_replace('{['.$match[2].']}',$this->element($match[2]),$content);
}
?>
<?php
echo $content;
?>