<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $_User;


	public function beforeFilter(){
		
		$this->loadModel('UserPoint');
		if(isset($this->params['prefix']) && $this->params['prefix']=='admin') {
			$this->layout="admin";
			$this->disableCache();
			if( !$this->Session->check('userlogin') ) {
					
				//$this->Session->setFlash('You must be logged in for that action.','flash_bad');
				$this->set('flash','you have to login first !');
				$this->redirect('/users/login');
			}
		}
	}
	public function beforeRender(){
		switch($this->request->params['action']){
			case 'products':
				$curr_page = "PRODUCT";
			break;	
			case 'aktifitas':
				$curr_page = "AKTIFITAS";
			break;	
			case 'journals':
				$curr_page = "ADVENTURE";
			break;	
			case 'land':
				$curr_page = "ADVENTURE";
			break;	
			case 'air':
				$curr_page = "ADVENTURE";
			break;	
			case 'water':
				$curr_page = "ADVENTURE";
			break;
			case 'trip':
				$curr_page = "TRIP";
			break;	
			case 'destinations':
				$curr_page = "TRIP";
			break;
			case 'music':
				$curr_page = "MUSIC";
			break;	
			case 'submit':
				if(isset($this->request->params['pass'][0])
					&& $this->request->params['pass'][0] == 'trip'){
					$curr_page = "TRIP";	
				}else{
					
					$curr_page = "ADVENTURE";
				}
				
			break;	
			default:
				$curr_page = "HOME";
			break;	
		}
		if($this->request->params['controller']=='gallery'){
			$curr_page = 'GALLERY';
		}
		$this->set('curr_page',$curr_page);
		if(isset($this->LoginSession)){
			$this->LoginSession->initialized($this);
			if($this->LoginSession->isLogin()){
				$this->set('fb_logout_url',$this->Session->read('fb_logout_url'));
				$this->set('is_fb_login','1');
				$this->set('fb_id',$this->LoginSession->getFbId());
				$this->set('profile',$this->LoginSession->getProfile());
			
				if(is_object($this->Point)){
					$this->set('point',
								$this->Point->getPoint($this->LoginSession->getFbId(),
														$this->UserPoint));
				}
			}
		}
		
		//age verification thingy
		$this->Cookie = $this->Components->load('Cookie');
		if(isset($this->request->pass[0]) &&
				$this->request->pass[0] == 'age_invalid'){
			$this->set('age_verified',true);
			//dont let the unverified users access the navigation.
			$this->set('hide_navigation',true);
		}else{
			$this->set('age_verified',$this->Cookie->read('is_age_verified'));
			$this->set('hide_navigation',false);	
		}
		
		
	}

}
