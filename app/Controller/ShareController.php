<?php
/**
 * ShareController
 * controller for content share by email.
 * 
 */
 class ShareController extends AppController{
 	var $components = array('Email','Point','Crypto','BannerWidget'); 
	private $status;
	//var $helpers = array('Session');
 	public function index($article_id){
 		 $this->redirect("/");
 	}
	public function beforeFilter(){
		$this->Session->check('captcha');
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(1,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(1,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(1,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
	}
	private function _send(){
		$friend_email= $this->request->data['friend_email'];
		$sender_email= $this->request->data['sender_email'];
		$sender_name = $this->request->data['sender_name'];
		$url = $this->Crypto->urldecode64($this->request->data['r']);
		$message = $this->request->data['message'];
		
		$this->Email->to = $friend_email; 
        $this->Email->subject = 'Tip: Check this news'; 
        $this->Email->replyTo = "{$sender_email}"; 
        $this->Email->from = "{$sender_email}"; 
		$this->Email->smtpOptions = array('port'=>25,
										  'host'=>'127.0.0.1',
										  'username'=>null,
										  'password'=>null,
										  'timeout'=>30);
		$this->Email->delivery = 'smtp';
		
		$msg = "{$sender_name} ({$sender_email}) wants you to take a look at these link :".PHP_EOL.PHP_EOL;
		$msg.= "{$url}".PHP_EOL.PHP_EOL;
		$msg.= "This is the message : ".PHP_EOL;
		$msg.= "{$message}".PHP_EOL.PHP_EOL."Best Regards".PHP_EOL;
        //Set the body of the mail as we send it. 
        //Note: the text can be an array, each element will appear as a 
        //seperate line in the message body.
       	
        return $this->Email->send($msg);
		
	}
	public function send($article_id){
		$this->loadModel('UserPoint');
		$this->loadModel('UserPointHistory');
		 if($this->request->is('post')){
        	//pr($_REQUEST);
			//pr($this->request);
			if($this->checkCaptcha($this->request->data['captcha'])){
				if($this->_send()){
					$me = unserialize($this->Session->read("FBLogin"));
					
					if(isset($me)&&$me['fb_id']!=null){
						//beri point jika user sudah login via fb
						$this->Point->addPoint($me['fb_id'],3,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
					}
					$this->set("msg","Selamat, email anda telah terkirim !");
				}else{
					$this->set("msg","Maaf, tidak berhasil mengirimkan email anda. Silahkan coba kembali !");
				}
				
			}else{
				$this->set("msg","Maaf, kode yang dimasukkan tidak sesuai dengan gambar !");
			}
        }
		if(isset($this->request->query['r'])){
			$this->set('article_id',$article_id);	
			$this->set("r",$this->request->query['r']);
		}else{
			$this->redirect("/");
		}		
	}
	private function getArticle(){
		$this->loadModel("Article");
		$article = $this->Article->findById(intval($this->request->data['article_id']));
		return $article;	
	}
	public function captcha(){
		$this->layout = null; 
        $this->autoRender = false;
        //$this->RequestHandler->setContent('jpeg', 'image/jpeg'); // use this if your mime-type is incorrect
       	
        App::import('Vendor', 'kcaptcha/kcaptcha');
        $kcaptcha = new KCAPTCHA(); // renders the captcha image fully here
       // session_start();
        $this->Session->write('captcha', $kcaptcha->getKeyString());
	}
	private function checkCaptcha($text) {
		//session_start();
		
		$captcha="";
		if($this->Session->check("captcha")){
        	$captcha = $this->Session->read("captcha");
		}
        $this->Session->delete("captcha"); // SECURITY: must clear captcha to avoid repatcha
        
        if (strlen($captcha)==0 || empty($captcha) || $captcha != $text) {
            return false;
        }
        return true;
    }
	
	/** 
     * Send a text string as email body 
     */
     /* 
    protected function _sendSimpleMail() { 
        $this->Email->to = 'dufronte@gmail.com'; 
        $this->Email->subject = 'Cake test simple email'; 
        $this->Email->replyTo = 'duf.lenovo@gmail.com'; 
        $this->Email->from = 'duf.lenovo@gmail.com'; 
		$this->Email->smtpOptions = array('port'=>25,
										  'host'=>'127.0.0.1',
										  'username'=>null,
										  'password'=>null,
										  'timeout'=>30);
		$this->Email->delivery = 'smtp';
				
        //Set the body of the mail as we send it. 
        //Note: the text can be an array, each element will appear as a 
        //seperate line in the message body. 
        return $this->Email->send('final testing on emailing system');
    } */

 }
 	