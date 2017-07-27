<?php
/**
 * a model for Article component
 */
 class User extends AppModel{
 	//public $name = 'User';


	public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'on' 	   => 'create',
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 3, 15),
                'message' => 'Between 3 to 15 characters'
            )
        ),
        'password' => array(
            'rule'    => array('minLength', '5'),
            'message' => 'Minimum 5 characters long'
        ),
        'name' => 'notEmpty'
       
    );
    public function beforeValidate(){
    	
    }
 	public function beforeSave(){
 		parent::beforeSave();
 		//check if the user is already exists.
 		$user = $this->findByUsername($this->data['User']['username']);
 		if($user['User']['username']==$this->data['User']['username'] &&
 			$this->data['User']['id']==null){
 			return false;
 		}
 		$this->data['User']['password'] = sha1($this->data['User']['username'].md5($this->data['User']['password']));



 	}
 }
?>