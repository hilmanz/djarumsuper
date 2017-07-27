<?php
/**
 * On The Go
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
App::uses('Sanitize', 'Utility');
class ForumController extends AppController{
 	var $components = array('Email','PImage','BannerWidget','LoginSession','Crypto','Point');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );
	
	function beforeFilter(){
		parent::beforeFilter();
		
		Cache::clear();
		clearCache();
		
	}
	function beforeRender(){
		$this->set('curr_page','MEETING');
		parent::beforeRender();
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(5,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(5,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(5,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$this->set("container_style","homePage");
	}
	function index($total=6){
		//fb stuff
		$this->Session->check('FBLogin');
		$me = unserialize($this->Session->read("FBLogin"));
		//-->
		$this->loadModel("Provinces");
		$this->loadModel("Logins");
		$this->loadModel("ForumAnswers");
		$this->loadModel("ForumAnswer");
		
		$provinces = $this->Provinces->find('all');
		$this->set("provinces",$provinces);
		$m=0;// month default to 0 (unfiltered)
		
		if(isset($this->request->query['m'])){
			$m = intval($this->request->query['m']);
			$conditions = array('n_status'=>'1','MONTH(Forum.when)='.$m);	
		}else{
			$conditions = array('n_status'=>'1');
		}
		
		if(!isset($this->request->query['popular'])){
			$this->paginate = array('Forum'=>
							array('conditions'=>$conditions,
								  'limit'=> $total,
								  'order'=>'Forum.id DESC',
								   )
					);
			$posts = $this->paginate('Forum');
			
		}else{
			$this->paginate = array('ForumAnswer'=>
										array(
										'limit'=> $total)
					);
			$posts = $this->paginate('ForumAnswer');
			
		}
		
		foreach($posts as $n=>$p){
			$author = $this->Logins->findById($p['Forum']['user_id']);
			$posts[$n]['User'] = $author['Logins'];
			//get total answer per post
			$rows = $this->ForumAnswers->find('count',array('conditions'=>array('post_id'=>$p['Forum']['id'])));
			$posts[$n]['answers'] = $rows;
			$posts[$n]['views'] = 0;
			//latest thread post
			$posts[$n]['last_post'] = $this->ForumAnswers->getLastPost($p['Forum']['id']);
			
			//rate
			$this->loadModel('ForumRate');
			$rate = $this->ForumRate->findByPost_id($p['Forum']['id']);
			if($rate['ForumRate']['total_hits']>0){
				$posts[$n]['rate'] = ceil(intval($rate['ForumRate']['total_point'])/intval($rate['ForumRate']['total_hits']));
			}
			
		}
		
		$this->set('fb_id',$me['fb_id']);
		$this->set("posts",$posts);
		//get user's email
		$profile = $this->Logins->findByFb_id($me['fb_id']);
		$me['email'] = $profile['Logins']['email'];
		$this->set("me",$me);
		if(isset($this->request->query['recent'])){
			$this->set("recent","1");
		}
		if(isset($this->request->query['popular'])){
			$this->set("popular","1");
		}
		$this->set('month',$m);
		
		
		
	}
	function submit(){
		if($this->request->is('post')){
			if(!isset($this->request->data['fb_id'])||strlen($this->request->data['fb_id'])==0){
				$this->redirect("/login");
				die();
			}else{
				if($this->_save_event()){
					$msg = "Thread anda sudah berhasil dibuat !";
				}else{
					$msg = "Mohon maaf, permohonan anda tidak dapat dikirim. Silahkan coba kembali !";
				}
				$this->set("msg",$msg);
			}
		}else{
			$this->redirect("/forum");	
		}
		
	}
	private function _save_event(){
		$this->loadModel("Logins");
		$user = $this->Logins->findByFb_id($this->request->data['fb_id']);
		$user_id = $user['Logins']['id'];
		
		$data = array("user_id"=>$user_id,
					  "title"=>$this->request->data['title'],
					  "description"=>$this->request->data['desc'],
					  "n_status"=>1,
					  "added_time"=>date("Y-m-d H:i:s",time()));
		$this->Forum->create();
		if($this->Forum->save($data)){
			return true;
		}
	}
	public function view($id=0){
		$id = intval($id);
		if($id==0){
			$this->redirect('/forum');
		}
		$this->loadModel("Provinces");
		$this->loadModel("Logins");
		$this->loadModel("ForumAnswers");
		$this->loadModel("ForumAnswer");
		$provinces = $this->Provinces->find('all');
		$this->set("provinces",$provinces);
		$event = $this->Forum->findById($id);
		$author = $this->Logins->findById($event['Forum']['user_id']);
		$event['User'] = $author['Logins'];
		
		//rate
		$this->loadModel('ForumRate');
		$rate = $this->ForumRate->findByPost_id($event['Forum']['id']);
		if($rate['ForumRate']['total_hits']>0){
			$this->set('rate',ceil(intval($rate['ForumRate']['total_point'])/intval($rate['ForumRate']['total_hits'])));
		}
		$this->set('event',$event);
		
		//replies
		$this->paginate = array('ForumAnswers'=>
										array(
										'conditions'=>array('post_id'=>$id),
										'order'=>"ForumAnswers.id DESC",
										'limit'=> 20)
					);
		$posts = $this->paginate('ForumAnswers');
		
		$this->set('posts',$posts);
		
		//update view counter
		if($this->Session->read("thread-{$id}-view")==NULL){
			$this->Forum->query("UPDATE forums SET total_views = total_views+1 WHERE id={$id}");
			$this->Session->write("thread-{$id}-view",1);
		}
		
		$this->set('me',unserialize($this->Session->read('me')));
	}
	function answer(){
		if($this->request->is('post')){
			if(!isset($this->request->data['fb_id'])||strlen($this->request->data['fb_id'])==0){
				$this->redirect("/login");
				die();
			}else{
				$q=$this->_save_answer();
				if(is_array($q)){
					$msg = "Terima kasih atas partisipasinya !";
				}else{
					$msg = "Mohon maaf, jawaban anda tidak dapat dikirim. Silahkan coba kembali !";
				}
				$this->set('id',intval($this->request->data['post_id']));
				$this->set("msg",$msg);
			}
		}else{
			$this->redirect("/forum");	
		}
	}
	private function _send_email($post,$data){
		
		$sender_email = $data['email'];
		$sender_name = $data['name'];
		$message = $data['answer'];
		$this->Email->to = $post['User']['email']; 
        $this->Email->subject = 'RE: '.$post['Forum']['title']; 
        $this->Email->replyTo = "{$sender_email}"; 
        $this->Email->from = "{$sender_email}"; 
		$this->Email->smtpOptions = array('port'=>25,
										  'host'=>'127.0.0.1',
										  'username'=>null,
										  'password'=>null,
										  'timeout'=>30);
		$this->Email->delivery = 'smtp';
		
		$msg = "{$sender_name} ({$sender_email}) menjawab ajakan anda :".PHP_EOL.PHP_EOL;
		$msg.= "{$message}".PHP_EOL.PHP_EOL."Best Regards".PHP_EOL;
        //Set the body of the mail as we send it. 
        //Note: the text can be an array, each element will appear as a 
        //seperate line in the message body.
      
        return $this->Email->send($msg);
	}
	private function _save_answer(){
		$this->loadModel("ForumAnswers");
		$this->loadModel("Logins");
		
		$post = $this->Forum->findById($this->request->data['post_id']);
		$author = $this->Logins->findById($post['Forum']['user_id']);
		
		$post['User'] = array("name"=>$author['Logins']['name'],"email"=>$author['Logins']['email']);
		
		$user = $this->Logins->findByFb_id($this->request->data['fb_id']);
		$user_id = $user['Logins']['id'];
		
		$data = array("post_id"=>intval($this->request->data['post_id']),
					  "name"=>Sanitize::clean($user['Logins']['name']),
					  "email"=>Sanitize::clean($user['Logins']['email']),
					  "user_id"=>intval($user['Logins']['id']),
					  "answer"=>Sanitize::clean($this->request->data['message']),
					  "n_status"=>1,
					  "posted_time"=>date("Y-m-d H:i:s",time()));
		
		$sql = "INSERT INTO forum_answers(post_id,name,email,user_id,answer,n_status,posted_time) 
									 VALUES({$data['post_id']},'{$data['name']}','{$data['email']}','{$data['user_id']}','{$data['answer']}',0,
									 NOW())";
		
		$q = $this->ForumAnswers->query($sql);
		$this->_send_email($post,$data);
		
		return $q;	
	}
	function admin_index($total=20){	
	}
	public function rate(){
			$post_id = intval($this->request->query['id']);
			$point = intval($this->request->query['point']);
			if($point<=5 && $this->Session->read("Forum_{$post_id}_voted")==null){
				$dbName = $this->Forum->getDataSource()->config['database']; 
				$q = $this->Forum->query("INSERT INTO {$dbName}.forum_rates 
										(
										`post_id`, 
										`total_point`, 
										`total_hits`
										)
										VALUES
										(
										{$post_id}, 
										{$point}, 
										1
										)
										ON DUPLICATE KEY UPDATE
										total_point = total_point+VALUES(total_point),
										total_hits = total_hits+VALUES(total_hits);
										");
				if(is_array($q)){
					print json_encode(array('status'=>1));
					$this->Session->write("Forum_{$post_id}_voted",1);
					die();
				}
			}
			print json_encode(array('status'=>0));
			die();
		}
}
?>