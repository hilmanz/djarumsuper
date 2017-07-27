<?php
App::uses('Controller', 'Controller');
class CcakeFileManagerAppController extends Controller {
	
	public function beforeRender(){
		if($this->Session->read('is_admin_login')){
			$this->set('is_admin_login',true);
		}else{
			$this->set('is_admin_login',false);
		}
	}
	public function beforeFilter(){
		$this->request->params['prefix'] = isset($this->request->params['prefix']) ? 
											$this->request->params['prefix'] : '';
		if($this->request->params['prefix']=="adm"){
			$this->layout="admin";
			$this->initAdminFeatures();
		}else{
			$this->layout="default";
		}
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
			
		}else{
			//on-the-fly loading the necessary component
			//$this->Components->load('Ccake.Menu');
		}
	}
	/**
	* load admin features, like dynamic menus, etc.
	*/
	private function initAdminFeatures(){
		$this->loadModel('Adminmenu');
		$menus = $this->Adminmenu->find('all',array('order'=>'Adminmenu.pos ASC'));
		$this->set('menus',$menus);
	}
	public function showDialog($opts,$type='default',$isAdmin=false){
		$this->set('opts',$opts);
		$this->set('dialog_type',$type);
		if(!$isAdmin){
			$this->render('../Elements/dialog');
		}else{
			$this->render('../adm/dialog');
		}
	}
	
	
}