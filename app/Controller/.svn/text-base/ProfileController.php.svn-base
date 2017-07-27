<?php
/**
 * ProfileController
 * handle everything related to user's profile page
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class ProfileController extends AppController{
 	var $components = array('Cookie','Point','BannerWidget','LoginSession');
	var $helpers = array('Session');
	
	function beforeRender(){
		parent::beforeRender();
		if(@$this->request->params['prefix']!='admin'){
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
	 * profile page
	 */
	public function index(){
		$this->loadModel('Login');

		$me = unserialize($this->Session->read('me'));
		
		//upon updating
		if($this->request->is('post')){
			$this->updateProfile($me['id']);
		}
		
	 	$user = $this->Login->findByFb_id($me['id']);
	 	
		$this->set('user',$user['Login']);
		//setup provinces dropdown
		$this->loadModel("Provinces");
		$this->set('provinces',$this->Provinces->find('all',array('limit'=>50)));


		//is it first-time user ?
		$this->set('first_time',$this->Session->read('FIRST_TIME'));
		//we dont need these flag anymore
		$this->Session->write('FIRST_TIME',false);
	}

	private function updateProfile($fb_id){
		$user = $this->Login->findByFb_id($fb_id);
		$this->Login->id = $user['Login']['id'];
		$rs = $this->Login->save($this->request->data);
		if($rs){
			$this->Session->setFlash('Selamat ! Profile kamu telah berhasil di-update.');
		}else{
			$this->Session->setFlash('Mohon maaf, silahkan coba kembali !');
		}
	}
	public function age_verification($toggle=0){
		$this->Cookie = $this->Components->load('Cookie');
		if(intval($toggle)==1){
			$this->Cookie->write('is_age_verified', true, false, '1 year');
		}
		$this->layout = 'ajax';
		$this->set('response',array('status'=>1));
		$this->render('/Common/response');
	}

}
?>