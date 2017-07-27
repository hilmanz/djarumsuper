<?php
App::uses('CcakeAppModel', 'Model');
class PostModel extends CcakeAppModel{
	
	public $belongsTo = array(
        'Page' => array(
            'className' => 'Page',
            'foreignKey' => 'page_id'
        )
    );
  
}
?>