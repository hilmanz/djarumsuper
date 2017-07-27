<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class GalleryController extends AppController{
 	var $components = array('PImage','BannerWidget','LoginSession','Point');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );
	function beforeRender(){
		$this->set('curr_page','GALLERY');
		parent::beforeRender();
		$this->set("container_style","homePage");
		$banners = $this->BannerWidget->getBanner(5,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(5,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(5,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(5,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		
	}
	function index($total=9){
		//picture list
		if($total>9){
			$total = 9;
		}
		$this->paginate = array('Gallery'=>array(
													'limit'=>$total,
													'order'=>'Gallery.id DESC'));
		
		$posts = $this->paginate('Gallery');
		$this->set('posts',$posts);
		
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(9,$this->BannerChannel);
		$this->set('banners',$banners);
		
		
		//meeting posts
		$this->loadModel("ForumAnswer");
		$this->loadModel("Forum");
		$meetingpost = $this->Forum->find("all",array(
			'fields'=>'Forum.*,User.*',
			'recursive'=>-1,
			'limit'=>3,
			'conditions'=>array('Forum.n_status'=>1),
			'order'=>array('Forum.total_views DESC'),
			'joins'=> array(
    					array('table' => 'logins',
						        'alias' => 'User',
						        'type' => 'INNER',
						        'conditions' => array(
						            'User.id = Forum.user_id',
						        )
   						 	)
						)
		));
		if(is_array($meetingpost)){
			foreach($meetingpost as $n=>$v){
				$comments = $this->ForumAnswer->find('count',
							array(
								'conditions'=>array('post_id'=>$v['Forum']['id']),
								'limit'=>1
							));
				$meetingpost[$n]['Forum']['total_replies'] = intval($comments);
				$this->loadModel('ForumRate');
				$rate = $this->ForumRate->findByPost_id($meetingpost[$n]['Forum']['id']);
				if($rate['ForumRate']['total_hits']>0){
					$meetingpost[$n]['rate'] = ceil(intval($rate['ForumRate']['total_point'])/intval($rate['ForumRate']['total_hits']));
				}
			}
		}
		$this->set('meeting',$meetingpost);
	}
	function admin_index($total=20){
		$total = intval(@$total);
		if($total==0){
			$total=50;
		}
		if($total>50){
			$total = 50;
		}
  		$this->paginate = array('Gallery'=>array('limit'=>$total,'order'=>'Gallery.id DESC'));
		$posts = $this->paginate('Gallery');
		$this->set('total_rows',$total);
		$this->set('posts',$posts);
		
		
	}
	function admin_add(){
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		if($this->request->is('post')){
			$banner_id = $this->_upload_image();
			if($banner_id>0){
				//$this->redirect("/admin/banners/edit/{$banner_id}");
			}
		}
		
	}
	function admin_delete($id,$page=0){
		$pic = $this->Gallery->findById($id);
		
		if($this->Gallery->delete($id)){
			@unlink("content/gallery/{$pic['filename']}");
			$msg = "The picture has been deleted successfully!";
		}else{
			$msg = "Cannot delete the picture, please try again later !";
		}
		$this->set("message",$msg);
		$this->set("link",array("label"=>"Back to Picture List","url"=>"/admin/gallery/"));
		$this->render("admin_result");
	}
	private function _upload_image(){
		if ($this->data['Gallery']['img']['size']>0 && !$this->data['Gallery']['img']['error']) {
			//upload file
			$tmp_name = $this->data['Gallery']['img']['tmp_name'];
			$filename = date("YmdHis").".{$this->data['Gallery']['img']['name']}";
			$destination = "content/gallery/".$filename;
			$file_ok = false;
			
			
	        if(move_uploaded_file($tmp_name, $destination)){
		        $data = array("filename"=>$filename,"caption"=>$this->data['caption'],
		        				"is_active"=>1,"created_time"=>date("Y-m-d H:i:s"),
		        				"place"=>$this->data['place'],
		        				"author"=>$this->data['author']);
								
				//downloadable size
				//1280x768
				if($this->PImage->resizeImage('resize', $filename, 
					"content/gallery/", 
					'1280x768_'.$filename, 
					1280, 768, 100)
				){
					//800x600
					$this->PImage->resizeImage('resize', '1280x768_'.$filename, 
					"content/gallery/", 
					'800x600_'.$filename, 
					800, 600, 100);
					//then the medium size
					$this->PImage->resizeImage('resize', '1280x768_'.$filename, 
						"content/gallery/", 
						'medium_'.$filename, 
						600, 400, 80);
						
					//also create the thumbnail
					//150x95 pixels
					$this->PImage->resizeImage('resize', 'medium_'.$filename, 
													"content/gallery/", 
													'thumb_'.$filename, 
													220, 165, 80);
													
					$this->PImage->resizeImage('resize', 'medium_'.$filename, 
													"content/gallery/", 
													'thumb2_'.$filename, 
													195, 127, 80);							
					$file_ok = true;
				}
					
				
			}
			if($file_ok){
				if($this->Gallery->save($data)){
					$this->set('msg',"The Picture  has been uploaded successfully !");
				}else{
					$this->set('msg','Cannot upload the Picture, please try again later !');
				}
			}else{
				$this->set('msg','We failed to resize your picture. Please tray again later !');
			}
	    }
		
		return $this->Gallery->id;
	}
}
?>