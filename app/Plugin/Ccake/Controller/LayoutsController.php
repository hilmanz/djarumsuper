<?php
app::uses('Sanitize','Utility');
class LayoutsController extends CcakeAppController {

	public function adm_index(){
		$this->paginate = array('limit'=>25);
		$layouts = $this->Paginate('Layout');
		$this->set('layouts',$layouts);
	}
	public function adm_edit($id){
		$layout = $this->Layout->findById($id);
		$this->set('layout',$layout);
	}
	public function adm_save(){
		$this->layout="ajax";
		if($this->request->is('post')){
			$this->Layout->id = intval($this->request->data['id']);

			if($this->Layout->save(array('html'=>$this->request->data['html']))){
				$this->set('response',array('status'=>1));	
			}else{
				$this->set('response',array('status'=>0));
			}
			
		}else{
			$this->set('response',array('status'=>0));
		}
		$this->render('response');
	}
	public function adm_create(){

	}
	public function adm_add(){
		$this->layout="ajax";
		if($this->request->is('post')){
			
			$check = $this->Layout->findBySlug($this->request->data['slug']);
			if(!isset($check['Layout']['id'])){
				$this->Layout->create();
				$this->Layout->save(array(
						'name'=>$this->request->data['name'],
						'slug'=>$this->request->data['slug'],
						'html'=>$this->request->data['html']));
				$this->set('response',array('status'=>1));	
			}else{
				$this->set('response',array('status'=>0));	
			}
			
		}else{
			$this->set('response',array('status'=>0));
		}
		$this->render('response');
	}
}