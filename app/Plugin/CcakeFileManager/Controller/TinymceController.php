<?php
App::uses('AppController','CcakeFileManagerAppController','Controller');
App::uses('Sanitize', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
class TinymceController extends CcakeFileManagerAppController{
	
	public function adm_index(){
		$this->layout = 'tinymce_plugin';
	}
}
?>