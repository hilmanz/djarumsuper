<?php
/**
 * a model for Banner component
 */
 class BannerChannel extends AppModel{
 	public $name = 'BannerChannel';
	
	var $belongsTo = array(
						'Banner' => array(
							'className'  => 'banners',
							'foreignKey' => 'banner_id'
						),
						'Channel' => array(
							'className' => 'channels',
							'foreignKey' => 'banner_id'
						)
					);
	public function beforeSave(){
		parent::beforeSave();
	}
 }
?>