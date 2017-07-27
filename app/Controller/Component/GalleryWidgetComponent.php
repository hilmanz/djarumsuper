<?php
/**
 * a component for displaying banner image on a 'widget'
 */
class GalleryWidgetComponent extends Component{
	
	public function getLatest($obj,$model,$image,$limit=20){
		
		$obj->paginate = array('Gallery'=>array(
													'limit'=>$limit,
													'order'=>'Gallery.id DESC'));
		
		$posts = $obj->paginate('Gallery');
		
		return $posts;
	}
	public function getRecentVideos($model,$limit=20){
	
		return $model->find('all',
											array('limit'=>$limit,
												  'order'=>array('Video.id'=>'DESC')));
		return $posts;
	}
}
?>