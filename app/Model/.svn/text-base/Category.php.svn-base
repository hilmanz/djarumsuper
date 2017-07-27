<?php
/**
 * a model for Article component
 */
 class Category extends AppModel{
 	public $name = 'Category';
	public $validate = array(
							'name'=>'notEmpty',
							'name_str'=>'notEmpty',
							'channel_id'=>'numeric');
	/*public $hasMany = array('Article'=>array(
											'className'=>'articles',
											'foreignKey'=>'category_id'			
										)
							);*/
	public $belongsTo = array('Channel'=>array('className'=>'channels',
											   'foreignKey'=>'channel_id'));
	public function getCategoryByChannelName($name,$channel){
		$c = $channel->findByName_str($name);
		$channel_id = $c['Channel']['id'];
		return $this->findByChannel_id($channel_id);
	}
 }
?>