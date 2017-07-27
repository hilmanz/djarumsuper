<?php
/**
 * EcardsController
 * a multimedia ecard application
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class EcardsController extends AppController{
 	var $components = array('PImage','Crypto','Email');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );
	function beforeRender(){
		parent::beforeRender();
	}
	function beforeFilter(){
		parent::beforeFilter();
		App::import("Vendor", "facebook/facebook");
		//check if the user is already login
		$fb = new Facebook(array(
			  'appId'  => Configure::read('Facebook2.appId'),
			  'secret' => Configure::read('Facebook2.appSecret'))
		);
		try{
			$me = $fb->api('/me');
			$this->Session->write('ecard_user',$me);
			$this->set("is_login",true);
		}catch(Exception $e){
			
		}
		
		$this->layout="ecard";
	}
	function index(){
		
	}
	function howto(){
		if($this->Session->check('ecard_user')){
			
		}else{
			$this->redirect("/ecards/");
		}
	}
	function create(){
		if($this->Session->check('ecard_user')){
			
		}else{
			$this->redirect("/ecards/");
		}
	}
	function dummy(){
		$items = array();
		$items[] = array("id"=>1,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>2,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>3,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>4,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>5,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>6,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>7,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>8,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>9,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>10,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>11,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>12,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>13,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>14,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		$items[] = array("id"=>15,"type"=>"image","thumb"=>"sample3.jpg","file"=>"sample2.jpg");
		$items[] = array("id"=>16,"type"=>"video","thumb"=>"sample.jpg","file"=>"sample.mp4");
		print json_encode($items);
		die();
	}
	function dummy2(){
		$items = array();
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		print json_encode($items);
		die();
	}
	function sequences(){
		$req = (base64_decode(($_POST['req'])));
		print $req;
		
		/*
		$items = array();
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		$items[] = array("type"=>"image","file"=>"sample2.jpg");
		$items[] = array("type"=>"video","file"=>"sample.mp4");
		print json_encode($items);
		 
		 */
		die();
	}
	function dummy3(){
		$secret = array('ecard_id'=>1);
		print $this->Crypto->urlencode64(serialize($secret));
		die();
	}
	function dummy4(){
		$secret = unserialize($this->Crypto->urldecode64($this->request->query['card']));
		pr($secret);
		die();
	}
	function save(){
		$me = $this->Session->read('ecard_user');
		
		if(isset($me)&&isset($this->request->data['seq'])){
			$data = array("from_name"=>$me['name'],"fb_id"=>$me['id'],"from_email"=>$me['email'],
					  "content"=>$this->request->data['seq'],
					  "created_time"=>date("Y-m-d H:i:s"));
			$this->Ecard->create();
			$rs = $this->Ecard->save($data);
			if($rs){
				$secret = array('ecard_id'=>$this->Ecard->id);
				$ecard_token = $this->Crypto->urlencode64(serialize($secret));
				
				//token
				$this->set("ecard_token",$ecard_token);
				
				//thumb
				$req = json_decode(base64_decode($data['content']),true);
				$thumb=$req[0]['thumb'];
				$this->set('thumb',$thumb);
				
				//current domain
				$this->set('domain',Configure::read('Custom.Domain'));
				
			}else{
				$msg = "We're very sorry, your ecard cannot be saved. Please try again later !";
				$this->set('msg',$msg);
			}
		}else{
			$msg = "We're very sorry, your ecard cannot be saved. Please try again later !";
			$this->set('msg',$msg);
		}
		
	}
	public function send(){
		if($this->request->is('post')){
			//data needed for fb
			$secret = unserialize($this->Crypto->urldecode64($this->request->data['ecard_token']));
			$this->set('card_token',$this->request->data['ecard_token']);
			
			$ecard = $this->Ecard->findById($secret['ecard_id']);
			if(isset($ecard['Ecard']['id'])){
				$req = json_decode(base64_decode($ecard['Ecard']['content']),true);
				$thumb=$req[0]['thumb'];
				$this->set('thumb',$thumb);
				$this->set('domain',Configure::read('Custom.Domain'));
				//---->
				$params = array("id"=>$ecard['Ecard']['id'],
								"from_name"=>$ecard['Ecard']['from_name'],
								"from_email"=>$ecard['Ecard']['from_email'],
								 "to_email"=>$this->request->data['friend_email'],
								  "to_name"=>$this->request->data['friend_name']);
								 
				if($this->_sendEmail($params)){
					//$this->Ecard->id = $ecard['Ecard']['id'];
					$data = array("to_email"=>$this->request->data['friend_email'],
								  "to_name"=>$this->request->data['friend_name']);
					$this->Ecard->id=$ecard['Ecard']['id'];
					$this->Ecard->save($data);
					$this->set('success',true);
					$msg = "Congratulations, your ecard has been sent successfully !";
				}else{
					$msg = "We're very sorry, there's problem in sending your ecard. Please try again later !";
				}
			}else{
				$msg = "We're very sorry, there's problem in sending your ecard. Please try again later !";
			}
		}
		 $this->set('msg',$msg);
	}
	public function view(){
		$is_ecard_valid = false;
		
		if(isset($this->request->query['card'])){
			$secret = unserialize($this->Crypto->urldecode64($this->request->query['card']));
			if(isset($secret['ecard_id'])){
				$data = $this->Ecard->findById($secret['ecard_id']);
				$this->set('data',$data['Ecard']);
				$is_ecard_valid = true;
			}
		}else{
			//show error
		}
		$this->set('is_ecard_valid',$is_ecard_valid);
	}
	private function _sendEmail($data){
		$friend_email= $data['to_email'];
		$sender_email= $data['from_email'];
		$sender_name = $data['from_name'];
		$secret = $this->Crypto->urlencode64(serialize(array('ecard_id'=>$data['id'])));
		$url = Configure::read('Custom.Domain').'/demo/ecards/view/?card='.$secret;
		
		//$message = $this->request->data['message'];
		
		$this->Email->to = $friend_email; 
        $this->Email->subject = 'Your friend has sent you an E-Card'; 
        $this->Email->replyTo = "{$sender_email}"; 
        $this->Email->from = "{$sender_email}"; 
		$this->Email->smtpOptions = array('port'=>25,
										  'host'=>'127.0.0.1',
										  'username'=>null,
										  'password'=>null,
										  'timeout'=>30);
		$this->Email->delivery = 'smtp';
		
		$msg = "{$sender_name} ({$sender_email}) has sent you an E-Card. :".PHP_EOL.PHP_EOL;
		$msg.= "to view the E-Card, please click the following link : ".PHP_EOL.PHP_EOL;
		$msg.= "{$url}".PHP_EOL.PHP_EOL;
		$msg.= PHP_EOL.PHP_EOL."Best Regards".PHP_EOL;
        //Set the body of the mail as we send it. 
        //Note: the text can be an array, each element will appear as a 
        //seperate line in the message body.
       	
        return $this->Email->send($msg);
       
        //return false;
	}
	
}
?>