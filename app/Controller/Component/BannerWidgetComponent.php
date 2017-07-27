<?php
/**
 * a component for displaying banner image on a 'widget'
 */
class BannerWidgetComponent extends Component{
	public function getBanner($channel_id,$model,$limit=1){
		if($model==null){ return false;}
		$banners = $model->find('all',array(
										'conditions'=>array('banner_type'=>1,'is_active'=>1,
										'OR'=>array(array('channel_id'=>0),
													array('channel_id'=>$channel_id))),
										'order'=>'RAND()','limit'=>$limit
										));
		
		return $banners;
	}
	public function getDashboardSidebarBanner($channel_id,$model,$limit=1){
		
		$banners = $model->find('all',array(
										'conditions'=>array('banner_type'=>4,'is_active'=>1,
										'OR'=>array(array('channel_id'=>0),
													array('channel_id'=>$channel_id))),
										'order'=>'RAND()','limit'=>$limit
										));
		
		
		return $banners;
	}
	public function getTopBanner($channel_id,$model,$total=3){
		if($model==null){ return false;}
		$banners = $model->find('all',array(
										'conditions'=>array('banner_type'=>2,'is_active'=>1,
										'OR'=>array(array('channel_id'=>0),
													array('channel_id'=>$channel_id))),
										'order'=>'RAND()','limit'=>$total
										));
		
		return $banners;
	}
	public function getTopSmallBanner($channel_id,$model,$total=3){
		if($model==null){ return false;}
		$banners = $model->find('all',array(
										'conditions'=>array('banner_type'=>5,'is_active'=>1,
										'OR'=>array(array('channel_id'=>0),
													array('channel_id'=>$channel_id))),
										'order'=>'RAND()','limit'=>$total
										));
		
		return $banners;
	}
	public function getHeadBanner($channel_id,$model,$total=3){
		if($model==null){ return false;}
		$banners = $model->find('all',array(
										'conditions'=>array('banner_type'=>3,'is_active'=>1,
										'OR'=>array(array('channel_id'=>0),
													array('channel_id'=>$channel_id))),
										'order'=>'RAND()','limit'=>$total
										));
		
		return $banners;
	}
	
}
?>