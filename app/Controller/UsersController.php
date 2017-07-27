<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class UsersController extends AppController{
 	var $components = array('Foo','LoginSession');
	var $layout = "admin";
	var $helpers = array('Form','Session');
	function beforeRender(){
		parent::beforeRender();
		$this->set("container_style","homePage");
	}
	function index(){
		$this->redirect("/");
	}
	
	function login(){
		/*$data = array("name"=>"Administrator","username"=>"admin",
				"password"=>sha1("admin".md5('11111111')));
		
		$this->User->save($data,true,
							array("name","username","password"));*/
	}
	function authenticate(){
		if(!empty($this->request->data)){
			$username = $this->request->data['username'];
			$password = $this->request->data['password'];
			$hash = sha1($username.md5($password));
			$user = $this->User->findByUsername($username);
			if($user['User']['username']==$username&&$user['User']['password']==$hash){
				$data = array("username"=>$user['User']['username'],
							  "id"=>$user['User']['id'],
							  "name"=>$user['User']['name']);
				$this->Session->write('userlogin',serialize($data));
				$this->redirect("/admin/dashboard");
			}else{
				$this->set("error","1");
			}
		}
	}
	function logout(){
		$this->Session->delete('userlogin');
		$this->redirect("/users/login");
	}
	function admin_logout(){
		$this->Session->delete('userlogin');
		$this->redirect("/users/login");
	}
	function admin_remove($id){
		$this->User->id = intval($id);
		$is_deleted = $this->User->delete($id);
		if($is_deleted){
				$this->Session->setFlash("The account has been removed successfully !",'default',array(),'good');
			}else{
				$this->Session->setFlash("Cannot remove the account, please try again later !",
										'default',array(),'bad');
				//debug($this->User->validationErrors);
			}
	}
	public function admin_new(){
		if($this->request->isPost()){
			

			$this->User->save(array('name'=>$this->data['name'],"password"=>$this->data['password'],
									"username"=>$this->data['username']));
			
			if($this->User->id>0){
				$this->Session->setFlash("new account has been saved successfully !",'default',array(),'good');
			}else{
				$this->Session->setFlash("Cannot save the new account, please try again later !",
										'default',array(),'bad');
				//debug($this->User->validationErrors);
			}
		}
	}
	public function admin_edit($id){
		if($this->request->isPost()){
			$this->User->id = $this->data['id'];
			$save = $this->User->save($this->data);

			if($save){
				$this->Session->setFlash("the changes has been saved successfully !",'default',array(),'good');
			}else{
				$this->Session->setFlash("Cannot save the new changes, please try again later !",
										'default',array(),'bad');
				debug($this->User->validationErrors);

			}
		}
		$this->set('user',$this->User->findById($id));
	}
	public function admin_list(){
		$this->paginate = array(
        'limit' => 10
    	);

		$this->set('users',
			$this->paginate('User')
		);

	}
}
?>