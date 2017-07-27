<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class LoginController extends AppController{
 	var $components = array('Cookie','Point','BannerWidget','LoginSession');
	var $helpers = array('Session');
	
	function beforeRender(){
		parent::beforeRender();
		if($this->request->params['prefix']!='admin'){
			$this->set("container_style","homePage");
			//show a banner please
			$this->loadModel('BannerChannel');
			$banners = $this->BannerWidget->getBanner(1,$this->BannerChannel);
			$this->set('banners',$banners);
			$top_banners = $this->BannerWidget->getTopBanner(1,$this->BannerChannel);
			$this->set('top_banners',$top_banners);
			$top_banners_small = $this->BannerWidget->getTopSmallBanner(1,$this->BannerChannel);
			$this->set('top_banners_small',$top_banners_small);
		}
	}
	public function beforeFilter(){
		parent::beforeFilter();
		if(@$this->request->params['prefix']!='admin'){
			$this->Session->check('FBLogin');
		}
	}
	/**
	 * login page
	 */
	function index(){
		if(isset($_COOKIE['ac_tk'])||isset($this->request->query['ok'])){
			$sync = $this->_sync_fb();
			if($sync){
				$is_first_time = $this->Session->read('FIRST_TIME');
				if($is_first_time){
					//here we go to profile page.
					$this->redirect('/profile');
				}else{
					$this->redirect("/?login=1");	
				}
			}
		}else{
			$this->redirect('/');
		}
	}
	private function _sync_fb(){
		if($this->Session->read('me')==null){
			App::import("Vendor", "facebook/facebook");
			$this->loadModel("UserPoint");
			$this->loadModel("UserPointHistory");
			$fb = new Facebook(array(
				  'appId'  => Configure::read('Facebook.appId'),
				  'secret' => Configure::read('Facebook.appSecret'))
				  );
			
			try{
				
				$this->Session->write('fb_logout_url',$fb->getLogoutUrl(array(
									    'next'=>Configure::read("Custom.LogoutUrl")
									)));
				$me = $fb->api('/me');
				$_SESSION['me'] = serialize($me);
				$this->Session->write('me',serialize($me));
				//check if the data is exist
				$check = $this->Login->findByFb_id($me['id']);
				if($check['Login']['fb_id']!=$me['id']){
					//ups.. not exists yet.
					//so we flag for redirection to profile page for first-time user
					$this->Session->write('FIRST_TIME',true);


					$data  = array("fb_id"=>$me['id'],
								"name"=>$me['first_name']." ".$me['last_name'],
								"email"=>$me['email'],
								"register_date"=>date("Y-m-d H:i:s"),
								"n_status"=>1);
								
					//add new login entry
					$this->Login->create($data);
					$this->Login->save();
					//retrieve a point
					$this->Point->addPoint($me['id'],0,'login',$this->UserPoint,$this->UserPointHistory);
				}
				$login_info  = array("fb_id"=>$me['id'],
								"name"=>$me['first_name']." ".$me['last_name'],
								"login_time"=>date("Y-m-d H:i:s"));	
											
				$this->Session->write("FBLogin",serialize($login_info));
				
				return true;
			}catch(Exception $e){
				//make sure the cookie is unset
				setcookie('ac_tk', 'NULL', mktime()-10000, '/');
				$this->Session->destroy();
				return false;
			}
		}else{
			return true;
		}
		
	}
	function session_end(){
		setcookie('ac_tk', 'NULL', mktime()-10000, '/');
		
		$this->Session->destroy();
		$this->render('logout');
	}
	function authenticate(){
		$this->index();
	}
	/**
	 * handle facebook redirection upon successfull authentication.
	 */
	public function fb(){
		
	}

	public function admin_index(){
		$this->paginate = array('limit'=>30);
		$rs = $this->paginate('Login');
		$this->set('rs',$rs);
	}
	public function admin_edit($id){
		
		if($this->request->is('post')){
			
			$this->Login->id = $id;
			$q = $this->Login->save(array(
				'role'=>$this->request->data['role']
			));
			if(isset($q['Login'])){
				$this->Session->setFlash('Profile has been changed successfully !');
			}else{
				$this->Session->setFlash('Profile cannot be changed, Please try again later !');
			}
		}
		$rs = $this->Login->findById($id);
		$this->set('rs',$rs);
	}
}
?>