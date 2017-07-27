<?php
/**
 * a model for Article component
 */
 class Channel extends AppModel{
 	public $name = 'Channel';
	public $validate = array('id'=>'numeric','name'=>'alphanumeric','name_str'=>'alphanumeric');
	public $hasMany = array('Category'=>array('className'=>'categories','foreignKey'=>'channel_id'));
 }
?>