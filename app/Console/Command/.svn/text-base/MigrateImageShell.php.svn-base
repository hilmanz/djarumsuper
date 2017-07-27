<?php
class MigrateImageShell extends AppShell{
	 var $uses = array('ArticleAsset','Article');
	 
	 public function main() {
        $rs = $this->Article->query("SELECT tx_rwttnewsupperdeck_main_image as big,
		tx_rwttnewsupperdeck_headline_image as medium,
		image as img
		FROM djarum.old_articles");
		
		
		foreach($rs as $r){
			if(strlen($r['old_articles']['big'])>0){
				$this->process($r['old_articles']['big']);
			}
			if(strlen($r['old_articles']['img'])>0){
				$this->process($r['old_articles']['img']);
			}
			
		}
    }
	 private function process($filename){
	 	$this->out("resizing {$filename}");
		$path = getcwd()."/webroot/";
	 	if($this->resizeImage('resizeCrop', $filename, 
										"{$path}content/images/", 
										"thumb_".$filename, 
										160, 110, 70)){
			$this->resizeImage('resizeCrop', $filename, 
										"{$path}content/images/", 
										null, 
										810, 300, 80);
			$file_ok = true;
		}
	 }
	 function resizeImage($cType = 'resize', $id, $imgFolder, $newName = false, $newWidth=false, $newHeight=false, $quality = 75, $bgcolor = false)
    { 
        $img = $imgFolder . $id; 
        list($oldWidth, $oldHeight, $type) = getimagesize($img);  
        $ext = $this->image_type_to_extension($type); 
         
        //check to make sure that the file is writeable, if so, create destination image (temp image)
        if (is_writeable($imgFolder)) 
        { 
            if($newName){ 
                $dest = $imgFolder . $newName; 
            } else { 
                $dest = $imgFolder . 'tmp_'.$id; 
            } 
        } 
        else 
        { 
            //if not let developer know 
            $imgFolder = substr($imgFolder, 0, strlen($imgFolder) -1); 
            $imgFolder = substr($imgFolder, strrpos($imgFolder, '\\') + 1, 20); 
            debug("You must allow proper permissions for image processing. And the folder has to be writable.");
            debug("Run \"chmod 777 on '$imgFolder' folder\""); 
            exit(); 
        } 
         
        //check to make sure that something is requested, otherwise there is nothing to resize. 
        //although, could create option for quality only 
        if ($newWidth OR $newHeight) 
        { 
            /* 
             * check to make sure temp file doesn't exist from a mistake or system hang up. 
             * If so delete. 
             */ 
            if(file_exists($dest)) 
            { 
                unlink($dest); 
            } 
            else 
            { 
                switch ($cType){ 
                    default: 
                    case 'resize': 
                        # Maintains the aspect ration of the image and makes sure that it fits 
                        # within the maxW(newWidth) and maxH(newHeight) (thus some side will be smaller)
                        $widthScale = 2; 
                        $heightScale = 2; 
                         
                        if($newWidth) $widthScale =     $newWidth / $oldWidth; 
                        if($newHeight) $heightScale = $newHeight / $oldHeight; 
                        //debug("W: $widthScale  H: $heightScale<br>"); 
                        if($widthScale < $heightScale) { 
                            $maxWidth = $newWidth; 
                            $maxHeight = false;                             
                        } elseif ($widthScale > $heightScale ) { 
                            $maxHeight = $newHeight; 
                            $maxWidth = false; 
                        } else { 
                            $maxHeight = $newHeight; 
                            $maxWidth = $newWidth; 
                        } 
                         
                        if($maxWidth > $maxHeight){ 
                            $applyWidth = $maxWidth; 
                            $applyHeight = ($oldHeight*$applyWidth)/$oldWidth; 
                        } elseif ($maxHeight > $maxWidth) { 
                            $applyHeight = $maxHeight; 
                            $applyWidth = ($applyHeight*$oldWidth)/$oldHeight; 
                        } else { 
                            $applyWidth = $maxWidth;  
                                $applyHeight = $maxHeight; 
                        } 
                        //debug("mW: $maxWidth mH: $maxHeight<br>"); 
                        //debug("aW: $applyWidth aH: $applyHeight<br>"); 
                        $startX = 0; 
                        $startY = 0; 
                        //exit(); 
                        break; 
                    case 'resizeCrop': 
                        // -- resize to max, then crop to center 
                        $ratioX = $newWidth / $oldWidth; 
                        $ratioY = $newHeight / $oldHeight; 
     
                        if ($ratioX < $ratioY) {  
                            $startX = round(($oldWidth - ($newWidth / $ratioY))/2); 
                            $startY = 0; 
                            $oldWidth = round($newWidth / $ratioY); 
                            $oldHeight = $oldHeight; 
                        } else {  
                            $startX = 0; 
                            $startY = round(($oldHeight - ($newHeight / $ratioX))/2); 
                            $oldWidth = $oldWidth; 
                            $oldHeight = round($newHeight / $ratioX); 
                        } 
                        $applyWidth = $newWidth; 
                        $applyHeight = $newHeight; 
                        break; 
                    case 'crop': 
                        // -- a straight centered crop 
                        $startY = ($oldHeight - $newHeight)/2; 
                        $startX = ($oldWidth - $newWidth)/2; 
                        $oldHeight = $newHeight; 
                        $applyHeight = $newHeight; 
                        $oldWidth = $newWidth;  
                        $applyWidth = $newWidth; 
                        break; 
                } 
                 
                switch($ext) 
                { 
                    case 'gif' : 
                        $oldImage = imagecreatefromgif($img); 
                        break; 
                    case 'png' : 
                        $oldImage = imagecreatefrompng($img); 
                        break; 
                    case 'jpg' : 
                    case 'jpeg' : 
                        $oldImage = imagecreatefromjpeg($img); 
                        break; 
                    default : 
                        //image type is not a possible option 
                        return false; 
                        break; 
                } 
                 
                //create new image 
                $newImage = imagecreatetruecolor($applyWidth, $applyHeight); 
                 
                if($bgcolor): 
                //set up background color for new image 
                    sscanf($bgcolor, "%2x%2x%2x", $red, $green, $blue); 
                    $newColor = ImageColorAllocate($newImage, $red, $green, $blue);  
                    imagefill($newImage,0,0,$newColor); 
                endif; 
                 
                //put old image on top of new image 
                imagecopyresampled($newImage, $oldImage, 0,0 , $startX, $startY, $applyWidth, $applyHeight, $oldWidth, $oldHeight);
                 
                    switch($ext) 
                    { 
                        case 'gif' : 
                            imagegif($newImage, $dest, $quality); 
                            break; 
                        case 'png' : 
                            //imagepng($newImage, $dest, $quality);
							imagepng($newImage, $dest, round(($quality / 10) - 1));
                        case 'jpg' : 
                        case 'jpeg' : 
                            imagejpeg($newImage, $dest, $quality); 
                            break; 
                        default : 
                            return false; 
                            break; 
                    } 
                 
                imagedestroy($newImage); 
                imagedestroy($oldImage); 
                 
                if(!$newName){ 
                    unlink($img); 
                    rename($dest, $img); 
                } 
                 
                return true; 
            } 

        } else { 
            return false; 
        } 
         

    } 

    function image_type_to_extension($imagetype) 
    { 
    if(empty($imagetype)) return false; 
        switch($imagetype) 
        { 
            case IMAGETYPE_GIF    : return 'gif'; 
            case IMAGETYPE_JPEG    : return 'jpg'; 
            case IMAGETYPE_PNG    : return 'png'; 
            case IMAGETYPE_SWF    : return 'swf'; 
            case IMAGETYPE_PSD    : return 'psd'; 
            case IMAGETYPE_BMP    : return 'bmp'; 
            case IMAGETYPE_TIFF_II : return 'tiff'; 
            case IMAGETYPE_TIFF_MM : return 'tiff'; 
            case IMAGETYPE_JPC    : return 'jpc'; 
            case IMAGETYPE_JP2    : return 'jp2'; 
            case IMAGETYPE_JPX    : return 'jpf'; 
            case IMAGETYPE_JB2    : return 'jb2'; 
            case IMAGETYPE_SWC    : return 'swc'; 
            case IMAGETYPE_IFF    : return 'aiff'; 
            case IMAGETYPE_WBMP    : return 'wbmp'; 
            case IMAGETYPE_XBM    : return 'xbm'; 
            default                : return false; 
        } 
    } 
}
?>