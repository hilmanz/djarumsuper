<?php
/**
 * a model for Article component
 */
 class Subscribe extends AppModel{
 	public $name = 'Subscribe';
    public $useTable="subscriptions";
    public $validate = array(
        'email' => 'email'
    );
    public $belongsTo = array('Login');
 }
?>