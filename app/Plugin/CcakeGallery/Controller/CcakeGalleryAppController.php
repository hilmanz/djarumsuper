<?php
App::uses('Controller', 'Controller');
App::uses('AppController', 'Controller');
class CcakeGalleryAppController extends AppController {
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		if((@$this->request->params['prefix']=='adm' 
				|| $this->request->params['controller']=='adm')
			&&
			$this->Session->read('adminsession') == null
			&&
			$this->request->params['controller'] != 'login'
			){

			if($this->request->params['controller']!='upload'){
				$this->redirect('/adm/login');	
			}else{
				print json_encode(array('status'=>0));
				die();
			}
			
		}
	}
	
	
	
}