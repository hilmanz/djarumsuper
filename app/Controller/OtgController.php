<?php
/**
 * On The Go
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
App::uses('Sanitize', 'Utility');
class OtgController extends AppController{
 	var $components = array('Email','PImage','BannerWidget','LoginSession','Crypto','Point');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );
	
	function beforeFilter(){
		parent::beforeFilter();
		
		
	}
	function beforeRender(){
		$this->set('curr_page','OTG');
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
		$this->set('in_otg',1);
	}
	function index($total=6){
		
		//fb stuff
		$this->Session->check('FBLogin');
		$me = unserialize($this->Session->read("FBLogin"));
		//-->
		$this->loadModel("Provinces");
		$this->loadModel("Logins");
		$this->loadModel("OtgAnswers");
		$this->loadModel("OtgAnswer");
		
		$provinces = $this->Provinces->find('all');
		$this->set("provinces",$provinces);
		$m=0;// month default to 0 (unfiltered)

		$conditions = array();
		$m = intval(@$this->request->query['m']);
		if(isset($this->request->query['m']) && $m > 0){
			$conditions = array('n_status'=>'1','MONTH(Otg.when)'=>$m);	
		}else{
			$conditions = array('n_status'=>'1');
		}
		if(isset($this->request->query['p'])&&strlen($this->request->query['p'])>0){
			$conditions['location'] = $this->request->query['p'];
			$this->set('current_province',Sanitize::clean($this->request->query['p']));
		}
		
		if(!isset($this->request->query['popular'])){
			$this->set('popular',0);
			$this->paginate = array('Otg'=>
							array('conditions'=>$conditions,
								  'limit'=> $total,
								  'order'=>'Otg.id DESC',
								   )
					);
			$posts = $this->paginate('Otg');

			
		}else{
			$this->set('popular',1);
			$this->paginate = array('OtgAnswer'=>
										array(
										'conditions'=>$conditions,
										'limit'=> $total)
					);

			$posts = $this->paginate('OtgAnswer');
		
		}
		
		foreach($posts as $n=>$p){
			$author = $this->Logins->findById($p['Otg']['user_id']);
			$posts[$n]['User'] = $author['Logins'];
			//get total answer per post
			$rows = $this->OtgAnswers->find('count',array('conditions'=>array('post_id'=>$p['Otg']['id'])));
			$posts[$n]['answers'] = $rows;
			$posts[$n]['views'] = 0;
			//latest thread post
			$posts[$n]['last_post'] = $this->OtgAnswers->getLastPost($p['Otg']['id']);
			
			//rate
			$this->loadModel('OtgRate');
			$rate = $this->OtgRate->findByPost_id($p['Otg']['id']);
			if($rate['OtgRate']['total_hits']>0){
				$posts[$n]['rate'] = ceil(intval($rate['OtgRate']['total_point'])/intval($rate['OtgRate']['total_hits']));
			}

			//total people joined these event
			$this->loadModel('OtgJoins');
			$total_joined = $this->OtgJoins->find('count',array(
										'conditions'=>
											array('otg_id'=>$p['Otg']['id'],'n_status'=>1)
										));
			$posts[$n]['total_joined'] = $total_joined;
			
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
					$msg = "Terima kasih atas partisipasinya !";
				}else{
					$msg = "Mohon maaf, permohonan anda tidak dapat dikirim. Silahkan coba kembali !";
				}
				$this->set("msg",$msg);
			}
		}else{
			$this->redirect("/otg");	
		}
		
	}
	private function _save_event(){
		$this->loadModel("Logins");
		$user = $this->Logins->findByFb_id($this->request->data['fb_id']);
		$user_id = $user['Logins']['id'];
		
		$data = array("user_id"=>$user_id,
					  "title"=>$this->request->data['title'],
					  "description"=>$this->request->data['desc'],
					  "location"=>$this->request->data['location'],
					  "place"=>$this->request->data['place'],
					  "category"=>$this->request->data['category'],
					  "n_status"=>1,
					  "people_slot"=>intval($this->request->data['jlm_org']),
					  "when"=>date("Y-m-d",strtotime($this->request->data['depart'])),
					  "added_time"=>date("Y-m-d H:i:s",time()));
		$this->Otg->create();
		if($this->Otg->save($data)){
			return true;
		}
	}
	public function join(){
		
		if(!isset($this->request->query['fb_id'])||strlen($this->request->query['fb_id'])==0){
			$this->redirect("/login");
			die();

		}else{

			$this->loadModel('OtgJoins');
			$otg_id = intval($this->request->query['id']);

			$joined = $this->OtgJoins->find('count',array(
										'conditions'=>
											array('otg_id'=>$otg_id,'n_status'=>1)
										));


			$event = $this->Otg->findById($otg_id);

			if(intval($joined)!=intval($event['Otg']['people_slot'])){
				$r = $this->_join();
				if($r!=0){
					if($r==2){
						$msg = "Maaf, kamu sudah terdaftar dalam event ini.";
					}else{
						$msg = "Terima kasih atas partisipasinya !";
					}
				}else{
					$msg = "Mohon maaf, permohonan anda tidak dapat dikirim. Silahkan coba kembali !";
				}
			}else{
				$msg = "Mohon maaf, anda tidak dapat mengikuti event ini, karena sudah penuh !";
			}
			$this->set("msg",$msg);
		}
		
	}
	private function _join(){
		$this->loadModel("Logins");
		$this->loadModel('OtgJoins');
		$user = $this->Logins->findByFb_id($this->request->query['fb_id']);
		$user_id = $user['Logins']['id'];
		$otg_id = intval($this->request->query['id']);
		//check apakah sudah pernah ikutan.

		
		$joined = $this->OtgJoins->find('count',array(
										'conditions'=>
											array('otg_id'=>$otg_id,
												  'user_id'=>$user_id,
												  'n_status'=>1)
										));

		if($joined > 0){
			return 2;
		}
		$this->OtgJoins->query("INSERT IGNORE INTO otg_joins(otg_id,user_id,dtpost)
									VALUES({$otg_id},{$user_id},NOW())");
		
		$joined = $this->OtgJoins->find('count',array(
										'conditions'=>
											array('otg_id'=>$otg_id,
												  'user_id'=>$user_id,
												  'n_status'=>1)
										));
		if($joined > 0){
			return 1;
		}else{
			return 0;
		}
		
	}
	public function view($id=0){
		$id = intval($id);
		if($id==0){
			$this->redirect('/otg');
		}
		$this->loadModel("Provinces");
		$this->loadModel("Logins");
		$this->loadModel("OtgAnswers");
		$this->loadModel("OtgAnswer");
		$this->loadModel("OtgJoins");
		$provinces = $this->Provinces->find('all');
		$this->set("provinces",$provinces);
		$event = $this->Otg->findById($id);
		$author = $this->Logins->findById($event['Otg']['user_id']);
		$event['User'] = $author['Logins'];
		
		//rate
		$this->loadModel('OtgRate');
		$rate = $this->OtgRate->findByPost_id($event['Otg']['id']);
		if($rate['OtgRate']['total_hits']>0){
			$this->set('rate',ceil(intval($rate['OtgRate']['total_point'])/intval($rate['OtgRate']['total_hits'])));
		}
		$this->set('event',$event);
		
		//jumlah orang yang ikutan
		$joined = $this->OtgJoins->find('all',array(
										'conditions'=>
											array('otg_id'=>$event['Otg']['id'],'n_status'=>1),
										'limit'=>100
										));
		if(is_array($joined)){
			foreach($joined as $n=>$v){
				$joined[$n]['Users'] = $this->Logins->findById($joined[$n]['OtgJoins']['user_id']);
			}
		}
		$this->set("participant",$joined);
		$this->set("total_joined",sizeof($joined));

		//replies
		$this->paginate = array('OtgAnswers'=>
										array(
										'conditions'=>array('post_id'=>$id),
										'limit'=> 20)
					);
		$posts = $this->paginate('OtgAnswers');
		
		$this->set('posts',$posts);
		
		//update view counter
		if($this->Session->read("thread-{$id}-view")==NULL){
			$this->Otg->query("UPDATE otgs SET total_views = total_views+1 WHERE id={$id}");
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
				$this->set("msg",$msg);
			}
		}else{
			$this->redirect("/otg");	
		}
	}
	private function _send_email($post,$data){
		
		$sender_email = $data['email'];
		$sender_name = $data['name'];
		$message = $data['answer'];
		$this->Email->to = $post['User']['email']; 
        $this->Email->subject = 'RE: '.$post['Otg']['title']; 
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
		$this->loadModel("OtgAnswers");
		$this->loadModel("Logins");
		
		$post = $this->Otg->findById($this->request->data['post_id']);
		$author = $this->Logins->findById($post['Otg']['user_id']);
		
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
		
		$sql = "INSERT INTO otg_answers(post_id,name,email,user_id,answer,n_status,posted_time) 
									 VALUES({$data['post_id']},'{$data['name']}','{$data['email']}','{$data['user_id']}','{$data['answer']}',0,
									 NOW())";
		
		$q = $this->OtgAnswers->query($sql);
		$this->_send_email($post,$data);
		
		return $q;	
	}
	function admin_index($total=20){	
	}

	public function top_otg_widget($total=2){
		//on the go
		$this->loadModel("OtgAnswers");
		$this->loadModel("OtgAnswer");
		$conditions = array('n_status'=>'1');
		
		$top_otg = $this->OtgAnswer->getTopEvents($total);
		for($i=0; $i<sizeof($top_otg);$i++){
			//total people joined these event
			$this->loadModel('OtgJoins');
			$total_joined = $this->OtgJoins->find('count',array(
										'conditions'=>
											array('otg_id'=>$top_otg[$i]['Otg']['id'],'n_status'=>1)
										));
			$top_otg[$i]['total_joined'] = $total_joined;
		}
		return $top_otg;
		
		//end of on the go
	}
	public function rate(){
			$post_id = intval($this->request->query['id']);
			$point = intval($this->request->query['point']);
			if($point<=5 && $this->Session->read("otg_{$post_id}_voted")==null){
				$dbName = $this->Otg->getDataSource()->config['database']; 
				$q = $this->Otg->query("INSERT INTO {$dbName}.otg_rates 
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
					$this->Session->write("otg_{$post_id}_voted",1);
					die();
				}
			}
			print json_encode(array('status'=>0));
			die();
		}
}
?>