<?php
App::uses('Controller', 'Controller');
App::uses('AppController', 'Controller');
class CcakeAppController extends AppController {
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		if((@$this->request->params['prefix']=='adm' 
				|| $this->request->params['controller']=='adm')
			&&
			$this->Session->read('adminsession') == null
			&&
			$this->request->params['controller'] != 'login'
			){

			if($this->request->params['controller']!='upload'){
				$this->redirect('/adm/login');	
			}else{
				print json_encode(array('status'=>0));
				die();
			}
			
		}
	}
	public function slugify($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text))
	  {
	    return 'n-a';
	  }

	  return $text;
	}
	
	
}