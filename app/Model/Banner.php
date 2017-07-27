<?php
/**
 * a model for Banner component
 */
 class Banner extends AppModel{
 	public $name = 'Banner';
	var $hasMany = array(
						'BannerChannel' => array(
						'className'  => 'banner_channels'
						)
					);
 }
?>