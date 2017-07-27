<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
 class VideoController extends AppController{
 	var $components = array('PImage','BannerWidget','LoginSession','Point');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );

	function beforeRender(){
		$this->set('curr_page','Video');
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
		$this->paginate = array('Video'=>array(
													'limit'=>$total,
													'order'=>'Video.id DESC'));
		
		$posts = $this->paginate('Video');
		$this->set('posts',$posts);
		
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(9,$this->BannerChannel);
		$this->set('banners',$banners);
		
		
		
	}
	function admin_index($total=20){
		$total = intval(@$total);
		if($total==0){
			$total=50;
		}
		if($total>50){
			$total = 50;
		}
  		$this->paginate = array('Video'=>array('limit'=>$total,'order'=>'Video.id DESC'));
		$posts = $this->paginate('Video');
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
		$pic = $this->Video->findById($id);
		
		if($this->Video->delete($id)){
			@unlink("content/video/{$pic['filename']}");
			$msg = "The picture has been deleted successfully!";
		}else{
			$msg = "Cannot delete the picture, please try again later !";
		}
		$this->set("message",$msg);
		$this->set("link",array("label"=>"Back to Picture List","url"=>"/admin/video/"));
		$this->render("admin_result");
	}
	private function _upload_image(){
		if ($this->data['Video']['img']['size']>0 && !$this->data['Video']['img']['error']) {
			//upload file
			$tmp_name = $this->data['Video']['img']['tmp_name'];
			$filename = date("YmdHis").".{$this->data['Video']['img']['name']}";
			$destination = "content/video/".$filename;
			$file_ok = false;
			$target_path = WWW_ROOT.'content/video/';
			$dir = new Folder($target_path, true, 0777);
			$dir->chmod($target_path,0777,false);
			
	        if(move_uploaded_file($tmp_name, $destination)){
		        $data = array("snapshot"=>$filename,
		        				"html"=>$this->data['html'],
		        				"caption"=>$this->data['caption'],
		        				"is_active"=>1,"created_time"=>date("Y-m-d H:i:s"),
		        				"place"=>$this->data['place'],
		        				"author"=>$this->data['author']);
								
				//downloadable size
				//1280x768
				if($this->PImage->resizeImage('resize', $filename, 
					"content/video/", 
					'1280x768_'.$filename, 
					1280, 768, 100)
				){
					//800x600
					$this->PImage->resizeImage('resize', '1280x768_'.$filename, 
					"content/video/", 
					'800x600_'.$filename, 
					800, 600, 100);
					//then the medium size
					$this->PImage->resizeImage('resize', '1280x768_'.$filename, 
						"content/video/", 
						'medium_'.$filename, 
						600, 400, 80);
						
					//also create the thumbnail
					//150x95 pixels
					$this->PImage->resizeImage('resize', 'medium_'.$filename, 
													"content/video/", 
													'thumb_'.$filename, 
													220, 165, 80);
													
					$this->PImage->resizeImage('resize', 'medium_'.$filename, 
													"content/video/", 
													'thumb2_'.$filename, 
													195, 127, 80);							
					$file_ok = true;
				}
					
				
			}
			if($file_ok){
				if($this->Video->save($data)){
					$this->set('msg',"The Picture  has been uploaded successfully !");
				}else{
					$this->set('msg','Cannot upload the Picture, please try again later !');
				}
			}else{
				$this->set('msg','We failed to resize your picture. Please tray again later !');
			}
			$dir->chmod($target_path,0755,false);
	    }
		
		return $this->Video->id;
	}
}
?>