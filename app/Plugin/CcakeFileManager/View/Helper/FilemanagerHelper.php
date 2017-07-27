<?php
App::uses('AppHelper', 'View/Helper');

class FilemanagerHelper extends AppHelper {
    public $helpers = array('Html');
    private $default_folder = 'default';
    
    private $base_path = ''; //base path for upload dir. 

    public function setDefaultFolder($name){
        $this->default_folder = $name;
    }
    public function setBaseUploadPath($path){
      $this->base_path = $path;
    }
    public function embed($width=960,$image_only=false,$callback=null,$uploadCallback=null){
       $this->Html->css(array('CcakeFileManager.CcakeFileManager'),null,array('inline'=>false));
       $this->Html->script(array('CcakeFileManager.Filemanager'),array('inline'=>false));
       return $this->getEmbedScript($width,$image_only,$callback,$uploadCallback);
    }
    private function getEmbedScript($width,$image_only,$callback,$uploadCallback){
    	 $str = $this->_View->element('CcakeFileManager.FilemanagerModal',
    									array('width'=>$width,
    										  'image_only'=>$image_only,
                          'current_folder'=>$this->default_folder,
                          'base_path'=>$this->base_path,
    										   'callback'=>$callback)
    								);

        $str.= $this->_View->element('CcakeFileManager.UploadFileModal',
                                        array('width'=>$width,
                                              'image_only'=>$image_only,
                                              'current_folder'=>$this->default_folder,
                                              'base_path'=>$this->base_path,
                                               'callback'=>$uploadCallback)
                                    );
    	
    	return $str;
    }
    public function triggerButton($label='Browse'){
    	$str = '<a href="javascript:;" class="btn btn-info" data-toggle="modal" data-target="#fmModal">';
		$str .= $label.'</a>';				
		return $str;
    }
    public function uploadButton($label="Upload New File(s)"){
        $str = '<a href="javascript:;" class="btn btn-info btn-file-upload" data-toggle="modal" data-target="#uploadModal">';
        $str .= $label.'</a>';              
        return $str;
    }
}