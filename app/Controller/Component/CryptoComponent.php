<?php
/**
 * a component for custom Crytography
 */
class CryptoComponent extends Component{
	// Parameters:
	// $text = The text that you want to encrypt.
	// $key = The key you're using to encrypt.
	// $alg = The algorithm.
	// $crypt = 1 if you want to crypt, or 0 if you want to decrypt.
	
	function cryptare($text, $key, $alg, $crypt)
	{
	    $encrypted_data="";
	    switch($alg)
	    {
	        case "3des":
	            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
	            break;
	        case "cast-128":
	            $td = mcrypt_module_open('cast-128', '', 'ecb', '');
	            break;   
	        case "gost":
	            $td = mcrypt_module_open('gost', '', 'ecb', '');
	            break;   
	        case "rijndael-128":
	            $td = mcrypt_module_open('rijndael-128', '', 'ecb', '');
	            break;       
	        case "twofish":
	            $td = mcrypt_module_open('twofish', '', 'ecb', '');
	            break;   
	        case "arcfour":
	            $td = mcrypt_module_open('arcfour', '', 'ecb', '');
	            break;
	        case "cast-256":
	            $td = mcrypt_module_open('cast-256', '', 'ecb', '');
	            break;   
	        case "loki97":
	            $td = mcrypt_module_open('loki97', '', 'ecb', '');
	            break;       
	        case "rijndael-192":
	            $td = mcrypt_module_open('rijndael-192', '', 'ecb', '');
	            break;
	        case "saferplus":
	            $td = mcrypt_module_open('saferplus', '', 'ecb', '');
	            break;
	        case "wake":
	            $td = mcrypt_module_open('wake', '', 'ecb', '');
	            break;
	        case "blowfish-compat":
	            $td = mcrypt_module_open('blowfish-compat', '', 'ecb', '');
	            break;
	        case "des":
	            $td = mcrypt_module_open('des', '', 'ecb', '');
	            break;
	        case "rijndael-256":
	            $td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
	            break;
	        case "xtea":
	            $td = mcrypt_module_open('xtea', '', 'ecb', '');
	            break;
	        case "enigma":
	            $td = mcrypt_module_open('enigma', '', 'ecb', '');
	            break;
	        case "rc2":
	            $td = mcrypt_module_open('rc2', '', 'ecb', '');
	            break;   
	        default:
	            $td = mcrypt_module_open('blowfish', '', 'ecb', '');
	            break;                                           
	    }
	   
	    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	    $key = substr($key, 0, mcrypt_enc_get_key_size($td));
	    @mcrypt_generic_init($td, $key, $iv);
	   
	    if($crypt)
	    {
	        $encrypted_data = @mcrypt_generic($td, $text);
	    }
	    else
	    {
	        $encrypted_data = @mdecrypt_generic($td, $text);
	    }
	   
	    mcrypt_generic_deinit($td);
	    mcrypt_module_close($td);
	   
	    return $encrypted_data;
	} 
	function convertBase64($str){
		$str = str_replace("=",".",$str);
		$str = str_replace("+","-",$str);
		$str = str_replace("/","_",$str);
		return $str;
	}
	function realBase64($str){
		$str = str_replace(".","=",$str);
		$str = str_replace("-","+",$str);
		$str = str_replace("_","/",$str);
		return $str;
	}
	function urlencode64($str){
		$key = Configure::read('Security.salt');
		$hash = $this->cryptare($str,$key,'des',1);
		$str =  $this->convertBase64(base64_encode($hash));
		return $str;
	}
	function urldecode64($str){
		
		$key = Configure::read('Security.salt');
		$secret =  base64_decode($this->realBase64($str));
		$str =  $this->cryptare($secret,$key,'des',0);
		return trim($str);
	}
}
?>