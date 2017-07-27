<?php
/**
 * BannersController
 * a controller for Banners Module.
 * the aim of these module is, to provide a flexible Banners Management.
 * most banner will be displayed in a sidebar in form of widget.
 * the banner can be linked into some of articles or  can be linked into external url.
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
 class BannersController extends AppController{
 	var $components = array('PImage');
	var $helpers  = array(
              'Html', 
              'Session',
              'Paginator'
              );
	var $paginate = array(
              'limit' => 3,
              'order' => array(
                'Banner.id' => 'DESC'
                )
              );    
	var $layout = "admin";
	function beforeRender(){
		parent::beforeRender();
		//$this->set("container_style","homePage");
	}
	function index(){
		$this->redirect("/");
	}
	function admin_index($total=20){
		
		$total = intval(@$total);
		if($total==0){
			$total=50;
		}
		if($total>50){
			$total = 50;
		}
  		$this->paginate = array('Banner'=>array('limit'=>$total,'order'=>'Banner.id DESC'));
		$posts = $this->paginate('Banner');
		$this->set('total_rows',$total);
		$this->set('posts',$posts);
		
		//channel lists
		$this->loadModel('Channel');
		$channels = $this->Channel->find('all');
		$channel = array();
	
		foreach($channels as $v){
			$channel[$v['Channel']['id']] = $v['Channel']['name'];
		}
		unset($channels);	
		$this->set('channels',$channel);
		unset($channel);
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
		//list of channels
		$channels = $this->Channel->find('all');
		$this->set('channels',$channels);
	}
	function admin_edit($id){
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		if($this->request->is('post')){
			$banner_id = $this->_update_image();
			if($banner_id>0){
				//$this->redirect("/admin/banners/edit/{$banner_id}");
			}
		}
		
		//the banner
		$banner = $this->Banner->findById($id);
		$this->set("banner",$banner);
		
		//list of channels
		$channels = $this->Channel->find('all');
		//check for selected channels
		foreach($channels as $n=>$v){
			$channels[$n]['Channel']['checked'] = false;
			foreach($banner['BannerChannel'] as $b){
				if($v['Channel']['id']==$b['channel_id']){
					if($channels[$n]['Channel']['checked'] == false)
						$channels[$n]['Channel']['checked'] = true;
				}
			}
		}
		$this->set('channels',$channels);
		
	}
	private function _update_image(){
		$banner = $this->Banner->findById($this->data['id']);
		$channels = array();
		foreach($this->request->data['avail'] as $channel_id){
			@$channels[$channel_id] = 1;
		}
		if(isset($this->data['Banner']['img'])){
			if ($this->data['Banner']['img']['size']>0 && !$this->data['Banner']['img']['error']) {
				//upload file
				$tmp_name = $this->data['Banner']['img']['tmp_name'];
				$filename = date("YmdHis").".{$this->data['Banner']['img']['name']}";
				$filename = str_replace(" ", "_", $filename);
				$destination = "content/banner/".$filename;
				$file_ok = false;
				
		        if(move_uploaded_file($tmp_name, $destination)){
		        	//remove the existing image first
					@unlink("content/banner/{$banner['Banner']['filename']}");
					@unlink("content/banner/top_{$banner['Banner']['filename']}");
					
					
					
			        $data = array("id"=>$this->data['id'],"filename"=>$filename,"banner_type"=>$this->data['banner_type']);
					$this->Banner->save($data);
					
					
					
					if($this->data['banner_type']==2){
						$img = $this->PImage->resizeImage('resize', $filename, 
														"content/banner/", 
														"726x100_".$filename, 
														726, 100, 100);
					
					}else if($this->data['banner_type']==5){
						$img = $this->PImage->resizeImage('resize', $filename, 
														"content/banner/", 
														"254x100_".$filename, 
														254, 100, 100);
					
					}else if($this->data['banner_type']==1||$this->data['banner_type']==4){
						$img = $this->PImage->resizeImage('resize', $filename, 
													"content/banner/", 
													"300x250_".$filename, 
													300, 250, 100);
					}else{						
						$img = $this->PImage->resizeImage('resize', $filename, 
													"content/banner/", 
													"980x425_".$filename, 
													980, 425, 100);
					}
					$thumb = $this->PImage->resizeImage('resize', $filename, 
													"content/banner/", 
													"thumb_".$filename, 
													300, 250, 100);
					if($img && $thumb){
						$file_ok = true;
					}else{
						//ups, not good, the upload is failed, so make sure the files are deleted
						@unlink("content/banner/980x100_{$filename}");
						@unlink("content/banner/300x250_{$filename}");
						@unlink("content/banner/980x425_{$filename}");
						@unlink("content/banner/726x100_{$filename}");
						@unlink("content/banner/254x100_{$filename}");
						@unlink("content/banner/thumb_{$filename}");
					}
					//-->
				}
				if($file_ok){
					$this->set('msg',"The New Banner Image has been uploaded successfully !");
				}else{
					$this->set('msg','We failed to resize your image. Please tray again later !');
				}
		    }
		}
		//save the changes
		$data = array("id"=>$this->data['id'],
							"is_active"=>$this->data['status'],
							"urlto"=>$this->data['urlto'],
							"name"=>$this->data['name'],
							"banner_type"=>$this->data['banner_type']);
		if($this->Banner->save($data)){
			//delete existing banner_channels associations
			$this->BannerChannel->deleteAll(array('banner_id'=>$this->data['id']),false);
			//add new associaton with channels
			foreach($channels as $channel_id=>$val){
				$data = array('banner_id'=>intval($this->data['id']),
							  'channel_id'=>intval($channel_id));
				if($this->BannerChannel->isUnique($data,false)){
					$this->BannerChannel->create($data);
					$this->BannerChannel->save();
				}
			}
			$this->set('msg',"Your changes has been saved successfully !");
		}else{
			$this->set('msg','Unable to save your changes, please try again later !');
		}
	}
	private function _upload_image(){
		if ($this->data['Banner']['img']['size']>0 && !$this->data['Banner']['img']['error']) {
			//upload file
			$tmp_name = $this->data['Banner']['img']['tmp_name'];
			$filename = date("YmdHis").".{$this->data['Banner']['img']['name']}";
			$filename = str_replace(" ", "_", $filename);
			$destination = "content/banner/".$filename;
			$file_ok = false;
			$channels = array();
			foreach($this->request->data['avail'] as $channel_id){
				@$channels[$channel_id] = 1;
			}
	        if(move_uploaded_file($tmp_name, $destination)){
		        $data = array("filename"=>$filename,
		        				"is_active"=>intval($this->data['status']),
		        				"urlto"=>$this->data['urlto'],
		        				"banner_type"=>$this->data['banner_type'],
		        				"name"=>$this->data['name'],
		        				"created_time"=>date("Y-m-d H:i:s")
								);
								
				if($this->data['banner_type']==2){
				//we need the bigger version one for top banner, 980x100 pixels
					$img = $this->PImage->resizeImage('resizeCrop', $filename, 
													"content/banner/", 
													"726x100_".$filename, 
													726, 100, 100);
				
				//also create the side banner
				//300x250 pixels
				}else if($this->data['banner_type']==5){
						$img = $this->PImage->resizeImage('resize', $filename, 
														"content/banner/", 
														"254x100_".$filename, 
														254, 100, 100);
					
				}else if($this->data['banner_type']==1||$this->data['banner_type']==4){
					$img = $this->PImage->resizeImage('resizeCrop', $filename, 
												"content/banner/", 
												"300x250_".$filename, 
												300, 250, 100);
				}else{						
					$img = $this->PImage->resizeImage('resizeCrop', $filename, 
												"content/banner/", 
												"980x425_".$filename, 
												980, 425, 100);
				}
				$thumb = $this->PImage->resizeImage('resize', $filename, 
													"content/banner/", 
													"thumb_".$filename, 
													300, 250, 100);
				if($img && $thumb){
					$file_ok = true;
				}else{
					//ups, not good, the upload is failed, so make sure the files are deleted
					@unlink("content/banner/980x100_{$filename}");
					@unlink("content/banner/300x250_{$filename}");
					@unlink("content/banner/980x425_{$filename}");
					@unlink("content/banner/726x100_{$filename}");
					@unlink("content/banner/254x100_{$filename}");
					@unlink("content/banner/thumb_{$filename}");
				}
				//-->
			}
			if($file_ok){
				if($this->Banner->save($data)){
					//add its associaton with channels
					foreach($channels as $channel_id=>$val){
						$data = array('banner_id'=>intval($this->Banner->id),'channel_id'=>intval($channel_id));
						if($this->BannerChannel->isUnique($data,false)){
							$this->BannerChannel->create($data);
							$this->BannerChannel->save();
						}
					}
					$this->set('msg',"The Banner Image has been uploaded successfully !");
				}else{
					$this->set('msg','Cannot upload the image, please try again later !');
				}
			}else{
				$this->set('msg','We failed to resize your image. Please tray again later !');
			}
	    }
		return $this->Banner->id;
	}
}
?>