<?php
/**
 * Points Controller
 * admin page for User Points
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 
 class PointsController extends AppController{
 	var $helpers  = array(
              'Html', 
              'Paginator'
              );
	function beforeRender(){
		parent::beforeRender();
	}
	function index(){
		
	}
	function admin_index($total=20){
		//$db = $this->Login->find('all');
		$this->paginate = array("Point"=>array("limit"=>$total,
												"order"=>"Login.name ASC"));
		$users = $this->paginate("Point");
		$this->set('users',$users);
	}
	function admin_history($total=20){
		$this->loadModel("Login");
		$this->loadModel("UserPointHistory");
		$this->loadModel("UserPoint");
		
		$user_id = intval($this->request->query['id']);
		$user = $this->Login->findById($user_id);
		$score = $this->UserPoint->findByFb_id($user['Login']['fb_id']);
		$user['Login']['score'] = intval($score['UserPoint']['score']);
		
		$this->paginate = array("UserPointHistory"=>array("conditions"=>array("fb_id"=>$user['Login']['fb_id']),
														  "limit"=>$total));
		$history = $this->paginate("UserPointHistory");
		
		$this->set('user',$user['Login']);
		$this->set('history',$history);
	}
}
?>