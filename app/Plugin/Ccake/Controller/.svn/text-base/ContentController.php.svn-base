<?php
app::uses('Sanitize','Utility');
class ContentController extends CcakeAppController {

	public function index(){
		$this->loadModel('Layout');
		$layout = $this->Layout->findBySlug('sample');
		$html = $layout['Layout']['html'];
		$this->set('SLOT1','slot1');
		$this->set('SLOT2','slot2');
		$this->set('CONTENT','slot3');
		$this->set('name','foobar');
		$this->set('content',$html);
	}

	public function adm_index(){

	}
}