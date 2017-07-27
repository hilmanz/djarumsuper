<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class AdminController extends AppController{
 	var $components = array('Foo');
	var $layout = "admin";
	function beforeRender(){
		parent::beforeRender();
		$this->set("container_style","homePage");
	}
	function index(){
		$this->flash("Page Not Found","/");
	}
}
?>