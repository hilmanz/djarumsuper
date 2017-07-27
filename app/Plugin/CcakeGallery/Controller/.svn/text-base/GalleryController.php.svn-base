<?php
App::uses('AppController','CcakeFileManagerAppController','Controller');
App::uses('Sanitize', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
class GalleryController extends CcakeGalleryAppController {
	public $helpers = array('CcakeFileManager.Filemanager');
	public function adm_create(){
		if($this->request->is('post')&&strlen($this->request->data['name'])>0){
			$this->loadModel('Gallery');
			$this->Gallery->cache = false;
			$this->request->data['created_dt'] = date("Y-m-d H:i:s");
			$this->Gallery->create();
			$rs = $this->Gallery->save($this->request->data);
			if($rs){
				$this->redirect('/adm/ccake_gallery/gallery/view/'.$this->Gallery->id);
			}else{
				$this->Session->setFlash('Cannot create the gallery, please try again later !');
			}
		}
	}
	public function adm_upload_files(){
		$this->Gallery->cache = false;
		$gallery = $this->Gallery->findById($this->request->query['gallery_id']);
		$this->set('gallery',$gallery);
	}
	public function adm_view($gallery_id){
		$this->Gallery->cache = false;
		$gallery = $this->Gallery->findById($gallery_id);
		$this->set('gallery',$gallery);
		$this->set('gallery_id',intval($gallery_id));
	}

	public function adm_save(){
		$this->layout='ajax';
		if($this->request->is('post')){
			$files = $this->request->data['files'];
			$gallery_id = $this->request->data['gallery_id'];
			$caption = $this->request->data['caption'];
			$this->loadModel('Picture');
			$this->Gallery->cache = false;
			$this->Picture->cache = false;
			foreach($files as $n=>$file){
				$this->Picture->create();
				$this->Picture->save(array(
					'gallery_id'=>$gallery_id,
					'file'=>$file,
					'caption'=>$caption[$n],
					'upload_dt'=>date("Y-m-d H:i:s")
				));
			}
			//use first picture as the gallery's default picture.
			$pics = $this->Picture->findByGallery_id($gallery_id);
			$this->Gallery->id = $gallery_id;
			$this->Gallery->save(array('thumb'=>$pics['Picture']['file']));
			$this->set('response',array('status'=>1));
			
		}else{
			$this->set('response',array('status'=>0));
		}
		$this->render('response');
	}
	public function adm_load(){
		$this->layout='ajax';
		$this->loadModel('Picture');
		$this->Gallery->cache = false;
		$this->Picture->cache = false;
		try{
			$rs = $this->Picture->find('all',
									array('conditions'=>array('gallery_id'=>intval($this->request->query['gallery_id'])),
										  'limit'=>1000));
			$pics = array();
			foreach($rs as $r){
				
				if(substr($r['Picture']['file'],0,7)!='http://'){
					$chunk = explode('/',$r['Picture']['file']);
					//we assume if it begins with '/' then it's the file from our site.
					$filename = 'thumbs/0_'.$chunk[sizeof($chunk)-1];
					$r['Picture']['thumbs'] = '';
					for($i=0;$i<(sizeof($chunk)-1);$i++){
						$r['Picture']['thumbs'] .= '/'.$chunk[$i];	
					}
					$r['Picture']['thumbs'].='/'.$filename;
				}
				$pics[] = $r['Picture'];

			}
			$this->set('response',array('status'=>1,'data'=>$pics));
		}catch(Exception $e){
			$this->set('response',array('status'=>0));
		}
		
		$this->render('response');
	}
	//get listing of galleries.
	public function adm_list(){
		$this->layout="ajax";
		$since_id = (isset($this->request->query['since_id'])) ? intval($this->request->query['since_id']) : 0;
		$limit=10;
		$this->Gallery->cache = false;
		$rs = $this->Gallery->find('all',array(
				'conditions'=>array('Gallery.id > '.$since_id),
				'limit'=>$limit
			));
		$galleries = array();
		if(sizeof($rs)>0){
			foreach($rs as $n=>$r){
				if($r['Gallery']['thumb']!=null){
					if(substr($r['Gallery']['thumb'],0,7)!='http://'){
						$chunk = explode('/',$r['Gallery']['thumb']);
						$filename = 'thumbs/0_'.$chunk[sizeof($chunk)-1];
						$r['Gallery']['thumb'] = '/files';
						for($i=0;$i<(sizeof($chunk)-1);$i++){
							$r['Gallery']['thumb'] .= '/'.$chunk[$i];	
						}
						$r['Gallery']['thumb'].='/'.$filename;

						$r['Gallery']['thumb'] = Router::url($r['Gallery']['thumb']);
					}
				}
				$galleries[] = $r['Gallery'];
				$since_id = $r['Gallery']['id'];
			}
		}
		$this->set('response',array('status'=>1,'data'=>array('galleries'=>$galleries,'since_id'=>$since_id,'total_per_page'=>$limit)));
		$this->render('response');
	}
	public function adm_delete(){
		$this->layout = "ajax";
		$id = intval($this->request->query['id']);
		if($id>0){
			$this->Gallery->cache = false;
			$this->Gallery->id = $id;
			$rs = $this->Gallery->delete($id);
			if($rs){
				$this->loadModel('Picture');
				$this->Picture->cache = false;
				$this->Picture->deleteAll(array('gallery_id'=>$id));
			}
			$this->set('response',array('status'=>1));
		}else{
			$this->set('response',array('status'=>0));
		}

		$this->render('response');
	}
	public function adm_delete_picture(){
		$this->layout = "ajax";
		$id = intval($this->request->query['id']);
		$this->loadModel('Picture');
		$this->Picture->cache = false;
		$this->Gallery->cache = false;
		if($id>0){
			$pic = $this->Picture->findById($id);

			$rs = $this->Picture->delete($id);
			if($rs){
				//use first picture as the gallery's default picture.
				try{
					$pics = $this->Picture->findByGallery_id($pic['Picture']['gallery_id']);
					$this->Gallery->id = $pic['Picture']['gallery_id'];
					$this->Gallery->save(array('thumb'=>$pics['Picture']['file']));
				}catch(Exception $e){}
				$this->set('response',array('status'=>1));
			}else{
				$this->set('response',array('status'=>0));
			}
			
		}else{
			$this->set('response',array('status'=>0));
		}

		$this->render('response');
	}
	public function adm_update_pic(){
		$this->layout = "ajax";
		if($this->request->is('post')){
			$pic_id = Sanitize::clean($this->request->data['pic_id']);
			$caption = Sanitize::clean($this->request->data['caption']);
			$this->loadModel('Picture');
			$this->Picture->id = $pic_id;
			$this->Picture->cache = false;
			$this->Gallery->cache = false;
			$this->Picture->save(array('caption'=>$caption));
			$this->set('response',array('status'=>1));
		}else{
			$this->set('response',array('status'=>0));
		}

		$this->render('response');
	}
	public function adm_update_desc(){
		$this->layout = "ajax";
		if($this->request->is('post')){
			$id = Sanitize::clean($this->request->data['id']);
			$description = Sanitize::clean($this->request->data['description']);
			$this->loadModel('Gallery');
			$this->Gallery->cache = false;
			$this->Picture->cache = false;
			$this->Gallery->id = $id;
			$this->Gallery->save(array('description'=>$description));
			$this->set('response',array('status'=>1));
		}else{
			$this->set('response',array('status'=>0));
		}

		$this->render('response');
	}
	//showing the main index of gallery
	public function index(){

	}
	//view gallery's content page
	public function view($gallery_id){
		$gallery = $this->Gallery->findById($gallery_id);
		$this->set('gallery',$gallery['Gallery']);
	}
	public function load(){
		$this->layout = 'ajax';
		$since_id = intval($this->request->query['since_id']);
		$gallery = $this->Gallery->find('all',array('conditions'=>array('Gallery.id > '.$since_id),
										'limit'=>20,
										'order'=>array('Gallery.id ASC')));

		if(sizeof($gallery)>0){
			$new_since_id = $gallery[sizeof($gallery)-1]['Gallery']['id'];
			if(intval($new_since_id) > $since_id){
				$since_id = $new_since_id;
			}	
		}
		

		foreach($gallery as $n=>$r){
			if($r['Gallery']['thumb']!=null){
					if(substr($r['Gallery']['thumb'],0,7)!='http://'){
						$chunk = explode('/',$r['Gallery']['thumb']);
						$filename = 'thumbs/0_'.$chunk[sizeof($chunk)-1];
						$r['Gallery']['thumb'] = '/files';
						for($i=0;$i<(sizeof($chunk)-1);$i++){
							$r['Gallery']['thumb'] .= '/'.$chunk[$i];	
						}
						$r['Gallery']['thumb'].='/'.$filename;

						$r['Gallery']['thumb'] = Router::url($r['Gallery']['thumb']);
					}
				}
			$gallery[$n]['Gallery'] = $r['Gallery'];
		}
		$rs = array("status"=>"1","data"=>$gallery,"since_id"=>$since_id);
		$this->set('response',$rs);
		$this->render('response');
	}
	
	/**
	*	return the list of pics inside the gallery 
	* @param $gallery_id 
	* @return json
	*/
	public function pics($gallery_id){
		$this->layout = 'ajax';
		$since_id = intval($this->request->query['since_id']);

		$this->loadModel('Picture');

		$pictures = $this->Picture->find('all',array(
				'conditions'=>array('Picture.id > '.$since_id,
								 	'Picture.gallery_id'=>$gallery_id),
				'limit'=>25,
				'order'=>array('Picture.id ASC')
			));
		if(sizeof($pictures)>0){
			$new_since_id = $pictures[sizeof($pictures)-1]['Picture']['id'];
			if(intval($new_since_id) > $since_id){
				$since_id = $new_since_id;
			}	
		}

		foreach($pictures as $n=>$r){
			if($r['Picture']['file']!=null){
					if(substr($r['Picture']['file'],0,7)!='http://'){
						$chunk = explode('/',$r['Picture']['file']);
						$filename = 'thumbs/0_'.$chunk[sizeof($chunk)-1];
						$r['Picture']['thumb'] = '/files';
						$folder_name = '';
						for($i=0;$i<(sizeof($chunk)-1);$i++){
							$r['Picture']['thumb'] .= '/'.$chunk[$i];	
							$folder_name.= '/'.$chunk[$i];
						}
						$r['Picture']['thumb'].='/'.$filename;
						$r['Picture']['thumb'] = Router::url($r['Picture']['thumb']);
						$r['Picture']['folder_name'] = $folder_name;
						$r['Picture']['file'] = "files/".$r['Picture']['file'];
						
					}
				}

			$pictures[$n]['Picture'] = $r['Picture'];
		}
		$rs = array("status"=>"1","data"=>$pictures,"since_id"=>$since_id);
		$this->set('response',$rs);
		$this->render('response');
	}
}