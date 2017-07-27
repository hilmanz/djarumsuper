<?php
App::uses('AppController','CcakeFileManagerAppController','Controller');
App::uses('Sanitize', 'Utility');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
class UploadController extends CcakeFileManagerAppController{
	public $components = array('CcakeFileManager.Thumbnail');
	public function index(){
		$this->layout="ajax";
		$this->adm_index();
		
	}
	//upload method
	public function adm_index(){

		$this->layout = 'ajax';
		
		
		$base_path = Configure::read('UPLOAD_DIR');
		
		//check if the container is already exists in database
		$this->loadModel('FolderList');
		$folderRS = $this->FolderList->findByName('/');
		
		if(!isset($folderRS['FolderList']) || $folderRS['FolderList']['id']==null){
			$this->FolderList->create();
			$this->FolderList->save(array('name'=>'/',
										  'total_files'=>0,
										  'created_dt'=>date("Y-m-d H:i:s")));
		}
	
		$target_path = $base_path;
			
		

		$dir = new Folder($target_path, true, 0777);
		$dir->chmod($target_path,0777,false);
		$dir_path = '';
		
		$n_file_uploaded = 0;
		$uploaded_files = array();

		foreach($_FILES['file']['name'] as $n=>$filename){
			$filename = str_replace(array(' ','-','=',',','\'','\"','`','!','@','#','$','%','^','&','*','(',')'),
									'_',$filename);
			if(@move_uploaded_file($_FILES['file']['tmp_name'][$n],
				$base_path.$dir_path.$filename)){
					//is it an image by guessing its extensions ?
					preg_match('/([^\s]+(\.(?i)(jpg|png|gif))$)/',$filename,$matches);
					if(sizeof($matches)>0){
						$this->createThumbnail($base_path.$dir_path,
												$filename);
					}
					$uploaded_files[] = $filename;
					$n_file_uploaded++;
			}
		}

		if(isset($dir)){
			$dir->chmod($target_path,0755,false);
		}
		
		if($n_file_uploaded==sizeof(@$_FILES['file']['name'])){
			$this->loadModel('FolderList');

			$rs = $this->FolderList->findByName('/');
			$dir_content = $dir->read();
			$total_files = sizeof($dir_content[1]);

			if(isset($rs['FolderList'])){
				$this->FolderList->id = $rs['FolderList']['id'];
				$this->FolderList->save(array('total_files'=>$total_files));
			}
			
			$this->set('response',array('status'=>1,
										'files'=>$uploaded_files,
										'total'=>$total_files));
		
		}else{
			$this->set('response',array('status'=>0,'target'=>$target_path,'container'=>''));
		
		}
		$this->render('response');
	}
	private function createThumbnail($upload_dir,$filename){
		$tsize = Configure::read('THUMBNAIL_SIZES');
		$thumb_dir = $upload_dir.Configure::read('THUMBNAIL_DIR');
		$dir = new Folder($thumb_dir, true, 0777);
		$dir->chmod($thumb_dir,0777,false);

		foreach($tsize as $sizeName=>$setting){
			if($tsize[$sizeName]['width'] != $tsize[$sizeName]['height']){
				$c = $this->Thumbnail->resizeImage('resize', $filename, 
							$upload_dir, 
							Configure::read('THUMBNAIL_DIR')."/".$sizeName."_".$filename, 
							$tsize[$sizeName]['width'], 
							$tsize[$sizeName]['height'], 
							100);
			}else{

				$c = $this->Thumbnail->resizeImage('crop', $filename, 
							$upload_dir, 
							Configure::read('THUMBNAIL_DIR')."/".$sizeName."_".$filename, 
							$tsize[$sizeName]['width'], 
							$tsize[$sizeName]['height'], 
							100);
			}
			
		}
		
		$dir->chmod($thumb_dir,0755,false);
	}
	public function adm_folder(){
		$this->layout = "ajax";
		if(!isset($this->request->query['folder'])){
			$this->request->query['folder'] = '';
		}
		$folderPath = Sanitize::clean($this->request->query['folder']);
		$dir = new Folder(Configure::read('UPLOAD_DIR').$folderPath, false);
		$content = $dir->read();
		if($content){
			$collections = array();//file collections
			foreach($content[1] as $the_file){
				$download_url = Configure::read('UPLOAD_DIR_WWW').$folderPath.'/'.$the_file;
				$thumb_url = Configure::read('UPLOAD_DIR_WWW').$folderPath.Configure::read('THUMBNAIL_DIR').'/';
				$fsize = filesize(Configure::read('UPLOAD_DIR').$folderPath.'/'.$the_file);
				$collections[] = array('filename'=>$the_file,
									  'download_url'=>$download_url,
									  'thumb_url'=>$thumb_url,
									   'size'=>$fsize);
			}
			$this->set('response',array('status'=>1,'data'=>array('subfolders'=>$content[0],
													'files'=>$collections)));
		}else{
			$this->set('response',array('status'=>0,'data'=>array()));
		}
		$this->render('response');
	}
	public function adm_new_folder(){
		$this->layout = "ajax";
		$folderName = Sanitize::clean($this->request->query['name']);
		$this->loadModel('FolderList');
		$this->FolderList->create();
		$rs = $this->FolderList->save(
				array(
				'name'=>$folderName,
				'created_dt'=>date("Y-m-d H:i:s")
				)
			);
		if(isset($rs)){
			$this->set('response',array('status'=>1,'data'=>$rs));
		}else{
			$this->set('response',array('status'=>0));
		}
		$this->render('response');
	}
	public function adm_get_folders(){
		$this->layout = "ajax";
		$this->loadModel('FolderList');
		
		$rs = $this->FolderList->find('all',array('limit'=>1000));
		$this->set('response',array('status'=>1,'data'=>$rs));
		$this->render('response');
	}
	public function get_folders(){
		$this->layout = "ajax";
		$this->loadModel('FolderList');
		
		$rs = $this->FolderList->find('all',array('limit'=>1000));
		$this->set('response',array('status'=>1,'data'=>$rs));
		$this->render('response');
	}
	public function adm_delete(){
		$this->layout = "ajax";
		$folderName = Sanitize::clean($this->request->query['folder']);
		$filename = Sanitize::clean($this->request->query['file']);

		$f = new File(Configure::read('UPLOAD_DIR').$folderName.'/'.$filename);

		$dir = new Folder(Configure::read('UPLOAD_DIR').$folderName, false);
		
		if($f->delete()){
			$this->loadModel('FolderList');

			$rs = $this->FolderList->findByName($folderName);
			$dir_content = $dir->read();
			$total_files = sizeof($dir_content[1]);

			if(isset($rs['FolderList'])){
				$this->FolderList->id = $rs['FolderList']['id'];
				$this->FolderList->save(array('total_files'=>$total_files));
			}


			$this->set('response',array('status'=>1,'data'=>array('filename'=>$filename,'total'=>$total_files)));
		}else{
			$this->set('response',array('status'=>0,'data'=>array('filename'=>$filename)));
		}
		$this->render('response');
	}
	public function adm_remove_folder(){
		$this->layout = "ajax";
		$folderName = Sanitize::clean($this->request->query['folder']);
		$dir = new Folder(Configure::read('UPLOAD_DIR').$folderName, false);
		
		$is_ok = false;
		if(strlen($dir->path)>0){
			if($dir->delete()){
				$is_ok = true;
			}
		}else{
			$is_ok = true;
		}
		if($is_ok){
			$this->loadModel('FolderList');
			$rs = $this->FolderList->findByName($folderName);
			if(isset($rs['FolderList'])){
				$this->FolderList->id = $rs['FolderList']['id'];
				$this->FolderList->delete($this->FolderList->id);
				$this->set('response',array('status'=>1));
			}else{
				$this->set('response',array('status'=>0));
			}
		}else{
			$this->set('response',array('status'=>0));
		}
		$this->render('response');
	}
}
?>