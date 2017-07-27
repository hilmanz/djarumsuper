<?php
/**
 * a component for maintaining LoginSession
 */
class LoginSessionComponent extends Component{
	protected $owner;
	protected $session;
	protected $me;
	public function initialized($owner){
		$this->owner = $owner;
	}
	public function isLogin(){
		$me = $this->owner->Session->read('me');
		
		if(isset($me)){
			$me = unserialize($me);
			if($me['id']!=null){
				$this->me = $me;
				return true;
			}
		}
	}
	public function getFbId(){
		return $this->me['id'];
	}
	public function getProfile(){
		//return $this->me;
		$this->owner->loadModel('Login');
		if($this->owner->Session->read('profile')!=null){
			return unserialize($this->owner->Session->read('profile'));
		}else{
			$profile = $this->owner->Login->findByFb_id($this->me['id']);
			$this->owner->Session->write('profile',serialize($profile));
		}
		return $profile;
	}

}
?>