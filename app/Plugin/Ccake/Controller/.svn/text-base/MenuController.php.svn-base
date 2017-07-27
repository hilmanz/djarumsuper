<?php
App::uses('AppController', 'Controller','Ccake.CcakeAppController');

class MenuController extends CcakeAppController {
	public function index(){

	}
	public function adm_index($parent_id=0){
		if($parent_id>0){
			$parent_menu = $this->getParentRecursively($parent_id);
			$ordered_menu = array();
			$ordered_menu = $this->orderParentMenu($ordered_menu,$parent_menu);
			$this->set('parent_menu',$ordered_menu);
		}
		$menusets = $this->Menu->find('all',array('conditions'=>array('parent_id'=>$parent_id),
												  'order'=>'Menu.pos ASC',
												  'limit'=>1000));
		$this->set('menusets',$menusets);
		$this->set('parent_id',$parent_id);
	}
	private function orderParentMenu($ordered,$p_menu){
		if(isset($p_menu['parent'])){
			$ordered = $this->orderParentMenu($ordered,$p_menu['parent']);
			$p_menu['parent'] = null;
			unset($p_menu['parent']);
		}
		$ordered[]=$p_menu;
		return $ordered;
	}
	private function getParentRecursively($parent_id){
		$parent_menu = $this->Menu->findById($parent_id);
		$p_menu = $parent_menu['Menu'];
		if($p_menu['parent_id']>0){
			$p_menu['parent'] = $this->getParentRecursively($p_menu['parent_id']);
		}
		unset($parent_menu);
		return $p_menu;
	}
	public function adm_new(){
		if(isset($this->request->query['pid'])){
			$parent_id = $this->request->query['pid'];
		}else if(isset($this->request->data['pid'])){
			$parent_id = $this->request->data['pid'];
		}else{
			$parent_id = 0;
		}
		
		if($parent_id>0){
			$parent_menu = $this->Menu->findById($parent_id);		
			$this->set('parent_menu',$parent_menu['Menu']);
		}
		if($this->request->is('post')){
			$menupos = $this->Menu->find('first',array('order'=>array('Menu.pos'=>'DESC')));
			$last_pos = $menupos['Menu']['pos'];
			
			$this->Menu->create();
			$rs = $this->Menu->save(array(
				'name'=>$this->request->data['name'],
				'url'=>$this->request->data['url'],
				'parent_id'=>$parent_id,
				'pos'=>$last_pos+1
			));
			if($rs){
				$this->Session->setFlash('New page `'.$this->request->data['name'].'` has been attached successfully !',
										'alert_good');
			}else{
				$this->Session->setFlash('The new page `'.$this->request->data['name'].'` cannot be attached to menu, please try again !',
										'alert_bad');
			}
		}
	}
	public function adm_edit($id){
		if($this->request->is('post')){
			$rs = $this->Menu->findById($id);
			$this->Menu->id = $rs['Menu']['id'];
			$r = $this->Menu->save(array(
					'name'=>$this->request->data['name'],
					'url'=>$this->request->data['url']
					
				));
			if($r){
				$this->Session->setFlash('The menu is changed successfully',
										'alert_good');
			}else{
				$this->Session->setFlash('Unable to saved the changes. Please try again later !',
										 'alert_bad');
			}
		}
		$rs = $this->Menu->findById($id);
		$this->set('rs',$rs['Menu']);
		
	}
	public function adm_update_pos(){
		$this->layout="ajax";
		foreach($this->request->data['sort'] as $n=>$id){
			$menu = $this->Menu->findById($id);
			$menu['Menu']['pos'] = ($n+1);
			$this->Menu->id = $menu['Menu']['id'];
			$this->Menu->save($menu);
		}
	}
	public function adm_delete($id){
		$rs = $this->Menu->findById($id);
		if(isset($rs['Menu'])){
			$confirm = intval(@$this->request->query['confirm']);
			if($confirm==0){
				$this->showDialog(
						array(
							'caption'=>'Alert',
							'text'=>"Are you sure want to remove '{$rs['Menu']['name']}' from menu",
							'yes_url'=>'/adm/ccake/menu/delete/'.$id.'?confirm=1',
							'no_url'=>'/adm/ccake/menu',
							'yes_label'=>"Delete it Anyway",
							'no_label'=>"Sorry, I've changed my mind."
							),
						'confirm');
			}else{
				$this->Menu->id = $rs['Menu']['id'];
				$r = $this->Menu->delete();
				if($r==1){
					$msg = "the page has been removed successfully !";
				}else{
					$msg = "Sorry, the page cannot be removed!";
				}
				$this->showDialog(array(
						'caption'=>"Removing '{$rs['Menu']['name']}'",
						'text'=>$msg,
						'next_url'=>'/adm/ccake/menu',
						'label'=>"Back to Menu List."
					));
			}
		}else{
			$this->showDialog(array(
						'caption'=>"Page not found",
						'text'=>"the page is not exists or no longer exists.",
						'next_url'=>'/adm/ccake/menu',
						'label'=>"Back to Menu list."
					));
		}
	}
}