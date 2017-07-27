<?php
App::uses('Component', 'Controller');
class MenuComponent extends Component{
	protected $Menu;
	public function initialize(Controller $controller){
		$controller->loadModel('Menu');
		$this->Menu = $controller->Menu;
		$menu = $this->LoadMenu();
		$controller->set('CCAKE_MENU',$menu);
	}
	/**
	*recursively load the menu
	*/
	private function LoadMenu($parent_id=0){
		$rs = $this->Menu->find('all',array('conditions'=>array('Menu.parent_id'=>$parent_id),
									  'order'=>array('Menu.pos ASC'),
									  'limit'=>1000));
		$menu = array();
		if(sizeof($rs)>0){
			foreach($rs as $r){
				$menu[] = $r['Menu'];
			}
		}
		if(sizeof($menu)>0){
			foreach($menu as $n=>$v){
				$menu[$n]['sub'] = $this->LoadMenu($menu[$n]['id']);
			}
		}
		return $menu;
	}
}

?>