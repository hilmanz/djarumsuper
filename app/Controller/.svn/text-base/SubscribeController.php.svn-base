<?php
/**
 * SubscribeController
 * @author Hapsoro Renaldy <hapsoro.renaldy at code18.us>
 * 
 */
 class SubscribeController extends AppController{
 	
 	var $name="Subscribe";
	function beforeRender(){
		parent::beforeRender();
		
	}
	function beforeFilter(){
		parent::beforeFilter();
	}
	function index(){
		$this->redirect('/');
	}
	function save(){
		$this->layout = 'ajax';
		$this->loadModel('Subscribe');
		if($this->request->is('post')){
			//first check if the email is exist.
			$email = $this->Subscribe->findByEmail($this->request->data['email']);
			if($email==null){
				$this->Subscribe->create();
				$rs = $this->Subscribe->save(array(
						'login_id'=> $this->request->data['id'],
						'email' => $this->request->data['email'],
						'subscribed_date' => date("Y-m-d H:i:s")
					));
				
				if($rs!=null){
					$this->set('response',array('status'=>1));
				}else{
					$this->set('response',array('status'=>0,
												'error'=>'Email cannot be subscribed !'));
				}
			}else{
				$this->set('response',array('status'=>0,
												'error'=>'Email is already subscribed !'));
			}
		}else{
			$this->set('response',array('status'=>0,'error'=>'invalid requests'));	
		}
	}
	function admin_index(){
		$this->loadModel('Subscribe');
		
		$this->paginate = array(
							'limit'=>50
						  );
		$this->set('rs',$this->paginate('Subscribe'));

	}
	function admin_remove($id){
		$this->loadModel('Subscribe');
		if(isset($this->request->query['confirm'])){
			$this->Subscribe->id = $id;
			$this->Subscribe->delete();
			$this->Session->setFlash('The email has been opted-out from our database successfully!');
			$this->redirect('/admin/subscribe');
		}
		$this->set('opt_id',$id);
		$this->set('rs',$this->Subscribe->findById($id));
	}
	function admin_email(){
		$this->loadModel('Blast');
		$this->paginate = array(
							'limit'=>50
						  );
		$this->set('rs',$this->paginate('Blast'));
	}
	function admin_view_email($id){
		$this->loadModel('Blast');
		$rs = $this->Blast->findById($id);
		$this->set('rs',$rs);
	}
	function admin_new_email(){
		$this->loadModel('Blast');
		$this->loadModel('Subscribe');
		$opts = $this->Subscribe->find('count');
		
		if($this->request->is('post')){
			$this->Blast->create();
			$rs = $this->Blast->save(array(
						'subject'=>$this->request->data['subject'],
						'html_content'=>$this->request->data['html_content'],
						'plain_text'=>$this->request->data['plain_text'],
						'created_date'=>date("Y-m-d H:i:s"),
						'email_queue'=>intval($opts)
					));
			if($rs){
				$this->Session->setFlash('Email has been saved into queue');
			}else{
				$this->Session->setFlash('cannot send your email to queue, please try again later !');
			}
		}
	}
}
?>