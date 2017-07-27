<?php
app::uses('Sanitize','Utility');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class BannersController extends CcakeAppController {
	
	
	public function adm_index(){
		$this->Banner->cache = false;
		
		$this->attachCategories();
		$this->attachZones();
		$total = 25;
		if(isset($this->request->query['category_id'])&&
				$this->request->query['category_id']!=0){
			$this->set('category_id',$this->request->query['category_id']);
			$this->paginate = array('conditions'=>array(
													'banner_category_id'=>
															intval($this->request->query['category_id'])),
									'limit'=>$total);
		}else{
			$this->paginate = array('limit'=>$total);
		}
		$this->Banner->bindModel(array(
			'belongsTo'=>array(
						'BannerCategory',
						'BannerZone'
						)
		));

		$banners = $this->paginate('Banner');
		
		//get its stats
		for($i=0;$i<sizeof($banners);$i++){
			$banners[$i]['stats'] = $this->getStats($banners[$i]['Banner']['id']);
		}
		
		$this->set('banners',$banners);
	}
	private function getStats($banner_id){
		$this->loadModel('BannerLog');
		$this->BannerLog->cache = false;
		$sql = "SELECT SUM(views) AS imp,
				SUM(clicks) AS click 
				FROM banner_logs WHERE banner_id={$banner_id} 
				GROUP BY banner_id;";
		$rs = $this->BannerLog->query($sql);
		if(isset($rs[0])){
			return $rs[0][0];	
		}else{
			return array('imp'=>0,'click'=>0);
		}
		
	}
	private function attachCategories(){
		$this->loadModel('BannerCategory');
		$this->BannerCategory->cache = false;
		$categories = $this->BannerCategory->find('all',array('limit'=>100));
		$this->set('categories',$categories);
	}
	private function attachZones(){
		$this->loadModel('BannerZone');
		$this->BannerZone->cache = false;
		$zones = $this->BannerZone->find('all',array('limit'=>100));

		$this->set('zones',$zones);
	}
	public function adm_categories(){
		$this->loadModel('BannerCategory');
		$this->BannerCategory->cache = false;
		if($this->request->is('post')){			
			$this->BannerCategory->create();
			if($this->BannerCategory->save(array(
					'name'=>$this->request->data['name'],
					'description'=>$this->request->data['description'],
					'size_limit'=>$this->request->data['width'].'x'.$this->request->data['height']
				))){
				$this->Session->setFlash('The category has been created successfully !');
			}else{
				$this->Session->setFlash('Cannot create the category, please try again later !');
			}
		}

		$this->paginate = array('limit'=>25);
		$categories = $this->paginate('BannerCategory');

		$this->set('categories',$categories);
	}


	//adm_zones()
	// manage ad zones.
	// ad zones is the area where the specific ads will be displayed.
	// the zones will be binded to specific url slug  for example,
	// the zone that bind to  /category/liga-inggris  will only displays
	// an Ad that related to 'Liga Inggris'
	public function adm_zones(){
		$this->loadModel('BannerZone');
		$this->BannerZone->cache = false;
		$this->paginate = array('limit'=>20);
		$rs = $this->paginate('BannerZone');
		$this->set('rs',$rs);
	}

	public function adm_add_zone(){
		$this->loadModel('BannerZone');
		$this->BannerZone->cache = false;
		if($this->request->is('post')){
			$this->BannerZone->create();
			$rs = $this->BannerZone->save($this->request->data);	
			if(isset($rs['BannerZone'])){
				$this->Session->setFlash('New Zone has been added successfully !');
			}else{
				$this->Session->setFlash('Cannot add new zone, please try again later !');
			}
		}else{
			$this->Session->setFlash('Invalid request, please try again later !');
		}
		$this->redirect('/adm/ccake/banners/zones');
	}

	public function adm_edit_category($id){
		$this->loadModel('BannerCategory');
		$this->BannerCategory->cache = false;
		if($this->request->is('post')){			
			$this->BannerCategory->id = $id;
			if($this->BannerCategory->save(array(
					'name'=>$this->request->data['name'],
					'description'=>$this->request->data['description'],
					'size_limit'=>$this->request->data['width'].'x'.$this->request->data['height']
				))){
				$this->Session->setFlash('The category has been updated successfully !');
			}else{
				$this->Session->setFlash('Cannot save the changes, please try again later !');
			}
		}
		$category = $this->BannerCategory->findById($id);
		$this->set('category',$category);
	}
	public function adm_delete_category($id){
		$this->loadModel('BannerCategory');
		$this->BannerCategory->cache = false;
		$banner = $this->BannerCategory->findById($id);
		if(!isset($banner['BannerCategory'])){
			$this->Session->setFlash('Sorry the category is not found !');
		}else{
			
			if($this->BannerCategory->delete($id)){
				$this->Session->setFlash('`'.$banner['BannerCategory']['name'].'` has been removed successfully !');
			}else{
				$this->Session->setFlash('Cannot remove `'.$banner['BannerCategory']['name'].'`. Please try again later !');
			}
		}
		
		$this->redirect('/adm/ccake/banners/categories');
	}
	public function adm_upload(){
		$_FILES['file']['name'] = str_replace(array(' ','\''),"_",$_FILES['file']['name']);
		$dir = new Folder(Configure::read('UPLOAD_DIR').'banners',true,0755);
		//make the folder writeable
		$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0777);
		if(move_uploaded_file($_FILES['file']['tmp_name'],
				Configure::read('UPLOAD_DIR').'banners/'.$_FILES['file']['name'])){
			
			//make the folder back to unwriteable
			$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0755);
			//save to db
			$data = array(
				'name'=>$this->request->data['name'],
				'banner_category_id'=>$this->request->data['banner_category_id'],
				'banner_zone_id'=>$this->request->data['banner_zone_id'],
				'url'=>$this->request->data['url'],
				'file'=>$_FILES['file']['name'],
				'file'=>$_FILES['file']['name'],
				'slot'=>$this->request->data['slot'],
				'upload_dt'=>date("Y-m-d H:i:s")
			);
			
			$this->loadModel('Banners');
			$rs = $this->Banners->save($data);

			$this->Session->setFlash('New Banner has been uploaded successfully !');
			
		}else{
			$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0755);
			$this->Session->setFlash('Cannot upload the banner, please try again later !');
			
		}
		$this->redirect('/adm/ccake/banners');
	}
	public function adm_delete($id){
		
		$this->loadModel('Banner');
		$this->Banner->cache = false;
		$banner = $this->Banner->findById($id);
		if(!isset($banner['Banner'])){
			$this->Session->setFlash('Sorry the file is not found !');
		}else{
			$dir = new Folder(Configure::read('UPLOAD_DIR').'banners',true,0755);
			//make the folder writeable
			$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0777);
			@unlink(Configure::read('UPLOAD_DIR').'banners/'.$banner['Banners']['banner_file']);
			$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0755);
			if($this->Banner->delete($id)){
				$this->Session->setFlash('`'.$banner['Banner']['name'].'` has been removed successfully !');
			}else{
				$this->Session->setFlash('Cannot remove `'.$banner['Banner']['name'].'`. Please try again later !');
			}
		}
		
		$this->redirect('/adm/ccake/banners');
	}

	public function adm_edit($id){
		$this->loadModel('Banner');
		$this->Banner->cache = false;
		if($this->request->is('post')){
			$this->Banner->id = $id;
			$this->Banner->save($this->request->data);
			$this->Session->setFlash("Banner Ads telah berhasil diupdate !");

			//jika ada file yg di upload..
			if(isset($_FILES['file']['tmp_name'])){
				$_FILES['file']['name'] = str_replace(array(' ','\''),"_",$_FILES['file']['name']);
				$dir = new Folder(Configure::read('UPLOAD_DIR').'banners',true,0755);
				//make the folder writeable
				$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0777);
				if(move_uploaded_file($_FILES['file']['tmp_name'],
					Configure::read('UPLOAD_DIR').'banners/'.$_FILES['file']['name'])){
				
					//make the folder back to unwriteable
					$dir->chmod(Configure::read('UPLOAD_DIR').'banners', 0755);
					//save to db
					$data = array(
						'file'=>$_FILES['file']['name'],
						'upload_dt'=>date("Y-m-d H:i:s")
					);

					$this->Banner->id = $id;
					$this->Banner->save($data);
				}
			}
		}

		$banner = $this->Banner->findById($id);
		$this->attachCategories();
		$this->attachZones();

		$this->set('rs',$banner);
	}
	public function get(){
		$slot = $this->request->query['slot'];
		$total = intval(@$this->request->query['total']);
		$show = intval(@$this->request->query['show']);

		$banners= $this->Banner->query("SELECT * FROM banners Banner
										WHERE slot='{$slot}' 
										ORDER BY RAND() LIMIT {$total}");
		return $banners;
	}

	/**
	* action for loading banner in widget_zone_banners.ctp
	* because it's a zoned ad, we need a slug to determine which ads to load
	* if the slug is set as '*' (without the quote), then it means we load any ads.
	* when specified, we load any banner which binded_slug is as same as specified.
	* the ads must be randomized.
	* dont forget to add view counts on the banner
	* Example Usage:
	* <?=$this->element('Ccake.widget_zone_banners',
    *                            array(
    *                              'zone'=>'featured-ad',
    *                              'size'=>'300x300',
    *                              'total'=>1
    *                            ))?> 
	*/
	public function widget_zone_banner($slug,$size){
		$this->Banner->bindModel(array(
			'belongsTo'=>array(
						'BannerCategory',
						'BannerZone'
						)
		));

		$banners = $this->Banner->find('all',array(
						'conditions'=>array(
							'BannerCategory.size_limit'=>$size,
							'BannerZone.binded_slug'=>$slug
						),
						'limit'=>intval($this->request->query['rows']),
						'order'=>array('RAND()')
					));
		//track views
		for($i=0;$i<sizeof($banners);$i++){
			$this->add_view_count($banners[$i]['Banner']['id'],
								  $banners[$i]['BannerZone']['binded_slug'],
								  $banners[$i]['BannerCategory']['size_limit']);
		}

		//-->
		return $banners;
	}
	// upon clicking the banner, the user will be redirected to the target url.
	// we track the click.
	// example usage : 
	// $url = Configure::read('WWW').'ccake/banners/click/1/*/300x300/?url='.$b['Banner']['url'];
	public function click($banner_id,$zone='*',$size='300x300'){
		//track the click
		$this->add_click_count($banner_id,$zone,$size);
		//redirect us
		$url = Sanitize::clean($this->request->query['url']);
		$this->redirect($url);
	}


	//the easy way to detect the ad zone within a specific page
	//we check the slugs one by one. if there's no slug exists in zone's binded-slug, 
	//we assume `*` as the zone.
	//example : $zone = $this->requestAction('/ccake/banners/detect_zone?url='.$this->request->url);
	public function detect_zone(){
		$slugs = explode('/',$this->request->query['url']);
		$this->loadModel('BannerZone');
		$zone = $this->BannerZone->find('all',array(
			'conditions'=>array('binded_slug'=>$slugs),
			'limit'=>5
		));

		if(sizeof($zone)>0){
			return $zone[0]['BannerZone']['binded_slug'];
		}else{
			return '*';
		}
	}

	// when we track ad views and clicks,
	// the view and click are bound to user_ip
	// so 1 ip can only tracked once every 1 hour.
	// we log the click or view in banner_logs by hour
	// see dthour field ? simply use date("Y-m-d h:00:00")

	//update - amien minta di bulk, jadi blockernya gw comment dulu. (duf)

	private function add_view_count($banner_id,$zone,$size){
		$this->loadModel('BannerLog');
		
		//cleaning up
		$banner_id = intval($banner_id);
		$zone = Sanitize::clean($zone);
		$size = Sanitize::clean($size);

		$session_name = 'view_'.$banner_id.'_'.$zone.'_'.$size;
		//$track_session = $this->Session->read($session_name);
		//if($track_session!=1){
			//we need user's ip
			$user_ip = $this->request->clientIp();
			$dthour = date("Y-m-d h:00:00");
			$sql = "INSERT INTO banner_logs(banner_id,zone,dthour,views,clicks,user_ip,ts)
					VALUES({$banner_id},'{$zone}','{$dthour}',1,0,'{$user_ip}',".time().")
					ON DUPLICATE KEY UPDATE
					views = views + VALUES(views);";
			$this->BannerLog->query($sql,false);
		//	$this->Session->write($session_name,1);
		//}
		
		
	}
	private function add_click_count($banner_id,$zone,$size){
		$this->loadModel('BannerLog');

		//cleaning up
		$banner_id = intval($banner_id);
		$zone = Sanitize::clean($zone);
		$size = Sanitize::clean($size);

		
		$session_name = 'click_'.$banner_id.'_'.$zone.'_'.$size;
		//$track_session = $this->Session->read($session_name);
		
		//if($track_session!=1){
			
			//we need user's ip
			$user_ip = $this->request->clientIp();
			$dthour = date("Y-m-d h:00:00");
			$sql = "INSERT INTO banner_logs(banner_id,zone,dthour,views,clicks,user_ip,ts)
					VALUES({$banner_id},'{$zone}','{$dthour}',0,1,'{$user_ip}',".time().")
					ON DUPLICATE KEY UPDATE
					clicks = clicks + VALUES(clicks);";
			$this->BannerLog->query($sql,false);
		//	$this->Session->write($session_name,1);
		//}
		
	}
}