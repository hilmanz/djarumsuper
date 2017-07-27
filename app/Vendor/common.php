<?php
 /*
 * Common Library
 * @author Hapsoro Renaldy N <dufronte at gmail.com>
 */
/**
 * a function to deal with utf8 issue with non-latin characters.
 * @param $utf8 a string which contains utf8 code
 */
function utf8tohtml($utf8, $encodeTags=null)
{
    $result = '';
    for ($i = 0; $i < strlen($utf8); $i++)
    {
        $char = $utf8[$i];
        $ascii = ord($char);
        if ($ascii < 128)
        {
            // one-byte character
            $result .= ($encodeTags) ? htmlentities($char , ENT_QUOTES, 'UTF-8') : $char;
        } else if ($ascii < 192)
        {
            // non-utf8 character or not a start byte
        } else if ($ascii < 224)
        {
            // two-byte character
            $result .= htmlentities(substr($utf8, $i, 2), ENT_QUOTES, 'UTF-8');
            $i++;
        } else if ($ascii < 240)
        {
            // three-byte character
            $ascii1 = ord($utf8[$i+1]);
            $ascii2 = ord($utf8[$i+2]);
            $unicode = (15 & $ascii) * 4096 +
                (63 & $ascii1) * 64 +
                (63 & $ascii2);
            $result .= "&#$unicode;";
            $i += 2;
        } else if ($ascii < 248)
        {
            // four-byte character
            $ascii1 = ord($utf8[$i+1]);
            $ascii2 = ord($utf8[$i+2]);
            $ascii3 = ord($utf8[$i+3]);
            $unicode = (15 & $ascii) * 262144 +
                (63 & $ascii1) * 4096 +
                (63 & $ascii2) * 64 +
                (63 & $ascii3);
            $result .= "&#$unicode;";
            $i += 3;
        }
    }
    return $result;
}
function legacy_path($str,$LEGACY_PATH){
	$pattern = "/<img src=[\"|\']([^\>]+)>/";
	$search = preg_match_all($pattern, $str,$result);
	foreach($result[1] as $n=>$matches){
		$m = str_replace(array("'/","\"/"),"",$matches);
		if(!eregi("http://|https://",$m)){
			if(eregi("/uploads/",$m)){
				$m2 = str_replace("/uploads/","{$LEGACY_PATH}/uploads/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("/fileadmin/user_uploads/",$m)){
				$m2 = str_replace("/fileadmin/user_uploads/","{$LEGACY_PATH}/fileadmin/user_uploads/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("uploads/",$m)){
				$m2 = str_replace("uploads/","{$LEGACY_PATH}/uploads/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("fileadmin/user_uploads/",$m)){
				$m2 = str_replace("fileadmin/user_uploads/","{$LEGACY_PATH}/fileadmin/user_uploads/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}
			
		}
	}
	return $str;
}
function from_legacy($str,$LEGACY_PATH,$NEW_PATH){
	//$str = str_replace($LEGACY_PATH, $NEW_PATH, $str);
	$str = str_replace("###YOUTUBE###","",$str);
	$str = str_replace("../../../","/",$str);
	return $str;
}
/*
function from_legacy($str,$LEGACY_PATH,$NEW_PATH){
	//step 1
	$pattern = "/<img src=[\"|\']([^\"|^']+)([^\>]+)>/";
	$search = preg_match_all($pattern, $str,$result);
	
	foreach($result[1] as $n=>$matches){
		$m = str_replace(array("'/","\"/"),"",$matches);
		//if(!eregi("http://|https://",$m)){
			if(eregi("/fileadmin/user_uploads/",$m)){
				$m2 = str_replace("/fileadmin/user_uploads/","/content/images/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("/uploads/images/",$m)){
				$m2 = str_replace("/uploads/images/","/content/images/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("/uploads/",$m)){
				$m2 = str_replace("/uploads/","/content/images/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("fileadmin/user_uploads/",$m)){
				$m2 = str_replace("fileadmin/user_uploads/","/content/images/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("uploads/",$m)){
				$m2 = str_replace("uploads/","/content/images/",$m);
				$str = str_replace($result[0][$n],"<img src='{$m2}'/>",$str);
			}else if(eregi("watermarked/",$m)){
				$m2 = str_replace("watermarked/","/content/images/",$m);
				$n_found = true;
			}
			
		//}
	}
	
	//step 2
	$pattern = "/<img (.*) src=[\"|\']([^\"|^']+)([^\>]+)(.*)>/";
	$search = preg_match_all($pattern, $str,$result);
	
	foreach($result[2] as $n=>$matches){
		$m = str_replace(array("'/","\"/"),"",$matches);
		$n_found = false;
		//if(!eregi("http://|https://",$m)){
			if(eregi("/fileadmin/user_uploads/",$m)){
				$m2 = str_replace("/fileadmin/user_uploads/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("/uploads/images/",$m)){
				$m2 = str_replace("/uploads/images/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("/uploads/",$m)){
				$m2 = str_replace("/uploads/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("fileadmin/user_uploads/",$m)){
				$m2 = str_replace("fileadmin/user_uploads/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("uploads/",$m)){
				$m2 = str_replace("uploads/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("uploads/",$m)){
				$m2 = str_replace("uploads/","/content/images/",$m);
				$n_found = true;
			}else if(eregi("watermarked/",$m)){
				$m2 = str_replace("watermarked/","/content/images/",$m);
				$n_found = true;
			}
		if($n_found){
			if(eregi("'",$m)){
				$str = str_replace($result[0][$n],"<img src='{$m2}' align='left' vspace='5' hspace='5' width='100%'/>",$str);
			}else{
				$str = str_replace($result[0][$n],"<img src=\"{$m2}\" align='left' vspace='5' hspace='5' width='100%'/>",$str);
			}
		}
		//}
	}
	
	//strip all legacy path
	$str = str_ireplace($LEGACY_PATH,'D_',$str);
	$str = str_ireplace('D_/D_/D_/','D_',$str);
	$str = str_ireplace('D_/D_/','D_',$str);
	$str = str_ireplace('D_',$NEW_PATH,$str);
	
	return $str;
}
*/
function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
/**
 * a helper function to help sorting an array based on its key's value reversely
 * @param $a
 * @param $subkey
 */
function subval_rsort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	arsort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}
/**
* this is our custom formated date
*/
function to_date($str,$include_hour=true){
	$m = array('','Januari','Februari','Maret',
				'April','Mei','Juni','Juli','Agustus',
				'September','Oktober','November','Desember');
	$tgl = date("d-m-Y",strtotime($str));
	$hour = date("H:i",strtotime($str));
	$arrTgl = explode("-",$tgl);
	if($include_hour){
		return $arrTgl[0]." ".$m[intval($arrTgl[1])]." ".$arrTgl[2]." ".$hour;
	}else{
		return $arrTgl[0]." ".$m[intval($arrTgl[1])]." ".$arrTgl[2];
	}
}