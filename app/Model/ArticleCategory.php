<?php
/**
 * a model for Article component
 */
 class ArticleCategory extends AppModel{
 	public $name = 'ArticleCategory';
	var $belongsTo = array(
						'Category' => array(
							'className'  => 'categories',
							'foreignKey' => 'category_id',
							'type'=>'inner'
						),
						'Article'=>array(
							'className'=>'Article',
							'foreignKey'=>'article_id',
							'type'=>'inner'
						)
					);
	public function beforeSave(){
		parent::beforeSave();
		
		return true;
	}

 }
?>