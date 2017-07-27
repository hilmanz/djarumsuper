<?php
/**
 * a model for Article component
 */
 class Article extends AppModel{
 	public $name = 'Article';
	var $hasMany = array(
						'MainImg' => array(
							'className'  => 'article_assets',            
							'conditions' => array('MainImg.is_main' => '1'),
							'limit'=> 5
						),
						'ArticleCategory'=>array(
								"className"=>'article_categories',
								'limit'=>10
							)
					);
					
	
	var $belongsTo = array('Author'=>array("className"=>'users',
											'foreignKey'=>'author_id',
											'fields'=>array('name','username')),
							'Province'=>array("className"=>'provinces',
											'foreignKey'=>'province_id',
											'fields'=>array('id','name','name_str'))
						);
							
	
 }
?>