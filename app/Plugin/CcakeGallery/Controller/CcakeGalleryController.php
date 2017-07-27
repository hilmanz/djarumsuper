<?php
App::uses('AppController','CcakeFileManagerAppController','Controller');
class CcakeGalleryController extends CcakeGalleryAppController{
	public function adm_index(){
		$limit = 25;
		$this->paginate = array(
				'limit'=>$limit
			);
		$this->loadModel('Gallery');
		$rs = $this->paginate('Gallery');
		$galleries = array();
		if(sizeof($rs)>0){
			foreach($rs as $n=>$r){
				if($r['Gallery']['thumb']!=null){
					if(substr($r['Gallery']['thumb'],0,7)!='http://'){
						$chunk = explode('/',$r['Gallery']['thumb']);
						$filename = 'thumbs/0_'.$chunk[sizeof($chunk)-1];
						$r['Gallery']['thumb'] = '/files';
						for($i=0;$i<(sizeof($chunk)-1);$i++){
							$r['Gallery']['thumb'] .= '/'.$chunk[0];	
						}
						$r['Gallery']['thumb'].='/'.$filename;

						$r['Gallery']['thumb'] = Router::url($r['Gallery']['thumb']);
					}
				}
				$galleries[] = $r['Gallery'];
			}
		}
		$this->set('galleries',$galleries);
	}
}
?>