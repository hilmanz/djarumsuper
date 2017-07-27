<?php
/**
 * ArticleController
 * @author Hapsoro Renaldy <dufronte@gmail.com>
 * 
 */
App::uses('AppHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
 class ArticlesController extends AppController{
 	var $components = array('PImage','BannerWidget','Point','Crypto',
 							'DestinationWidget','GalleryWidget','LoginSession',
 							'CcakeFileManager.Thumbnail');
	var $helpers  = array(
              'Html', 
              'Paginator',
              'CcakeFileManager.Filemanager'
              );
	var $paginate = array(
              'limit' => 8,
              'order' => array(
                'Article.id' => 'DESC'
                )
              );      
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		
		Cache::clear();
		clearCache();
		
	}
	public function beforeRender(){
		
		parent::beforeRender();
		
	}
	
	/**
	 * the landing page of article 
	 * the landing page should show the featured article from every main category.
	 * so far we only show from category Land, Water, and Air
	 */
	public function index(){
		
		$this->layout="default";
		$this->loadModel('Channel');
		$this->loadModel('Category');
		$this->loadModel('ArticleCategory');
		$this->loadModel('ArticleAsset');
		
		
		$land = $this->Channel->findById(6);
		$category_id = array();
		foreach($land['Category'] as $n=>$category){
			$category_id[] = $category['id'];
		}
		unset($land);
		
		
		$water = $this->Channel->findById(7);
		
		foreach($water['Category'] as $n=>$category){
			$category_id[] = $category['id'];
		}
		unset($water);
		
		$air = $this->Channel->findById(8);
		
		foreach($air['Category'] as $n=>$category){
			$category_id[] = $category['id'];
		}
		unset($air);
		
		$featured_articles = $this->ArticleCategory->find('all',
												array('conditions'=>array('ArticleCategory.category_id'=>$category_id,
																		'ArticleCategory.is_featured'=>1,
																		'n_status'=>1),
												'limit'=>4,
												'order'=>'ArticleCategory.article_id DESC'));
		
		$channels = array('6'=>'land','7'=>'water','8'=>'air');
		foreach($featured_articles as $n=>$featured){
			//specify channel
			$featured_articles[$n]['Channel']['name'] = $channels[$featured['Category']['channel_id']];
			//retrieve its assets
			$assets = $this->ArticleAsset->find('all',array(
												'conditions'=>array('article_id'=>$featured['Article']['id'],
																	'is_main'=>1),
												'limit'=>1
												));
			$featured_articles[$n]['MainImg'] = $assets[0]['ArticleAsset'];
			$tc = $this->Crypto->urlencode64(
						serialize(array('article_id'=>$featured['Article']['id'],
									'request_time'=>date("Y-m-d"),
									'rand'=>rand(1111,9999))));
			$featured_articles[$n]['tc'] = $tc;
		}
		
		$this->set('featured_articles',$featured_articles);
		//$this->set('featured',$featured);
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(1,$this->BannerChannel,4);
		$this->set('banners',$banners);
		$banners2 = $this->BannerWidget->getDashboardSidebarBanner(1,$this->BannerChannel,Configure::read('DashboardSidebannerLimit'));
		$this->set('dashboard_sidebar_banners',$banners2);
		$top_banners = $this->BannerWidget->getTopBanner(1,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(1,$this->BannerChannel);
		
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(1,$this->BannerChannel);
		
		$this->set('head_banners',$head_banner);
		
		//gallery widget
		$this->loadModel('Gallery');
		$gallery = $this->GalleryWidget->getLatest($this,$this->Gallery,$this->PImage,20);
		
		$this->set('gallery',$gallery);

		//supermusic recent posts
		$supermusic = $this->getRecentPost('music',4);
		$this->set('supermusic',$supermusic);

		//aktifitas recent posts
		$aktifitas = $this->getRecentPost('aktifitas',2);
		$this->set('aktifitas',$aktifitas);
		
		//destination widget
		$this->loadModel('Trip');
		$destination = $this->DestinationWidget->getLatest($this->Trip,$this->PImage);
		//pr($destination);

		$this->set('destination',$destination);
		
		/*
		
		//meeting posts
		$this->loadModel("ForumAnswer");
		$this->loadModel("Forum");
		
		//on the go
		$this->loadModel("OtgAnswers");
		$this->loadModel("OtgAnswer");
		$conditions = array('n_status'=>'1');
		
		$top_otg = $this->OtgAnswer->getTopEvents(2);
		$this->set('meeting',$top_otg);
		*/
		//-->
	}
	private function getRecentPost($channel_str,$total=3){
		$this->loadModel('ArticleAsset');
		$this->loadModel('Category');
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		


		$channel = $this->Channel->findByName_str($channel_str);
		
		if(!isset($channel['Category'])){
			$channel['Category'] = array();
			$categories = $this->Category->findByChannel_id($channel['Channel']['id']);
			foreach($categories as $category){

				$channel['Category'][] = $category;
			}
		}
		$category_ids = array();

		foreach($channel['Category'] as $category){
			$category_ids[] = "'".$category['id']."'";
		}
		$posts = $this->Article->query("SELECT * FROM articles Article
		INNER JOIN article_categories Category
		ON Article.id = Category.article_id
		WHERE Category.category_id IN (".implode(',',$category_ids).") 
		ORDER BY Article.id DESC LIMIT {$total};");
		for($i=0;$i<sizeof($posts);$i++){
			$posts[$i]['Channel'] = $channel['Channel'];
			$posts[$i]['Category'] = $channel['Category'];
			$images = $this->ArticleAsset->find('all',array('limit'=>20,
															'conditions'=>array(
																'ArticleAsset.article_id'=>$posts[$i]['Article']['id'],
																'is_main'=>1
															 )));
			$posts[$i]['Assets'] = array();
			while(sizeof($images)>0){
				$img = array_shift($images);
				$posts[$i]['Assets'][] = $img['ArticleAsset'];
			}
		}
		return $posts;
	}

	/**
	 * channel adventure
	 */
	function adventure($group_str=null,$view=null,$article_id=null){
		$this->loadModel('Category');
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		if($view==null){
			$category = $this->Category->findByName_str($group_str);
			$this->_getGroupLanding($category);
	
		}else{
			$category = $this->Category->findByName_str($group_str);
				
			$this->_getGroupArticle($category,intval($article_id));
		}
		$top_banners = $this->BannerWidget->getTopBanner(1,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(1,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(1,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
	}
	/**
	 * channel adventure - land
	 */
	function land($group_str=null,$view=null,$article_id=null){
		$this->set('curr_page','ADVENTURE');
		$this->loadModel('Category');
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		
		//top banners
		$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		//side banner
		$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
		$this->set('banners',$banners);
		
		$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		
		if($view==null){
			if($group_str==null){
				$channel = $this->Channel->findByName_str('land');
				$this->_getGroupLandingMultiCat($channel);
			}else{
				$category = $this->Category->findByName_str($group_str);
				$this->_getGroupLanding($category);
			}
			$this->render('adventure');
		}else{
			$category = $this->Category->findByName_str($group_str);
			
			$this->_getGroupArticle($category,intval($article_id));

		}
		
	}
	/**
	 * channel adventure - water
	 */
	function water($group_str=null,$view=null,$article_id=null){
		$this->set('curr_page','ADVENTURE');
		$this->loadModel('Category');
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		//top banners
		$top_banners = $this->BannerWidget->getTopBanner(7,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(7,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		//side banner
		$banners = $this->BannerWidget->getBanner(7,$this->BannerChannel);
		$this->set('banners',$banners);
		$head_banner = $this->BannerWidget->getHeadBanner(7,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		if($view==null){
			if($group_str==null){
				$channel = $this->Channel->findByName_str('water');
				$this->_getGroupLandingMultiCat($channel);
			}else{
				
				$category = $this->Category->findByName_str($group_str);
				$this->_getGroupLanding($category);
				
			}
			$this->render('adventure');
		}else{

			$category = $this->Category->findByName_str($group_str);
			$this->_getGroupArticle($category,intval($article_id));
		}
		
	}
	/**
	 * channel adventure - air
	 */
	function air($group_str=null,$view=null,$article_id=null){
		$this->set('curr_page','ADVENTURE');
		$this->loadModel('Category');
		$this->loadModel('Channel');
		$this->loadModel('BannerChannel');
		//top banners
		$top_banners = $this->BannerWidget->getTopBanner(8,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(8,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		//side banner
		$banners = $this->BannerWidget->getBanner(8,$this->BannerChannel);
		$head_banner = $this->BannerWidget->getHeadBanner(8,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		$this->set('banners',$banners);
		if($view==null){
			if($group_str==null){
				$channel = $this->Channel->findByName_str('air');
				$this->_getGroupLandingMultiCat($channel);
			}else{
				$category = $this->Category->findByName_str($group_str);
				$this->_getGroupLanding($category);
			}
			$this->render('adventure');
		}else{
			$category = $this->Category->findByName_str($group_str);
			$this->_getGroupArticle($category,intval($article_id));
		}
		
	}
	/**
	 * channel journals
	 */
	 function journals($group_str=null,$view=null,$article_id=null){
	 	$this->set('curr_page','ADVENTURE');
		$this->loadModel('Category');
		$category = $this->Category->findById(4);
		if($view==null){
			$this->_getGroupLanding($category);
		}else{
			$this->_getGroupArticle($category,intval($article_id));
		}
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(2,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(2,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(2,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(2,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
	}
	
	 /**
	  * Channel Events
	  */
	 function events($group_str,$view=null,$article_id=null){
		$this->loadModel('Category');
		$category = $this->Category->findById(6);
		if($view==null){
			$this->_getGroupLanding($category);
		}else{
			$this->_getGroupArticle($category,intval($article_id));
		}
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
	}
	 /**
	  * Channel Products
	  */
	 public function products($group_str=null,$view=null,$article_id=null){

		$this->loadModel('Category');
		$category = $this->Category->findById(29);
		if($view==null){
			$this->_getGroupLanding($category);
		}else{

			$this->_getGroupArticle($category,intval($article_id));
		}
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(29,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(29,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(29,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(29,$this->BannerChannel);
		$this->set('head_banners',$head_banner);

		if($view!=null){
			$this->render('product_detail');
		}
	}
	 /**
	 * channel Destination Landing (ini landing untuk halaman trip)
	 */
	 function destinations($group_str=null,$view=null,$article_id=null){
	 	if($group_str=="index"||$group_str==""){
	 		$this->redirect('/articles/trip');
	 	}else{

		 	$this->set('curr_page','TRIP');
			$this->loadModel('Category');
			$this->loadModel('Province');
			$this->loadModel('Trip');


			$category = $this->Category->findByName_str('featured_'.$group_str);
			
			
			$this->loadModel('Channel');
			
			switch($group_str){
				case "land":
					
					$this->set('land',1);
				break;
				case "water":
					
					$this->set('water',1);
				break;
				case "air":
				
					$this->set('air',1);
				break;
				default:
					
				break;
			}
			
			$this->layout="default";//use the default layout
			$this->loadModel('Trip');
			$this->loadModel('User');
			$conditions = array("category_id"=>$category['Category']['id']);

			$this->paginate = array('Trip'=>
								array('conditions'=>$conditions,
							  	'limit'=> 10,
							   )
						);
			$posts = $this->paginate('Trip');
			if(is_array($posts)){
				foreach($posts as $n=>$v){
					//$posts[$n]['Province'] = $province;
					$author = $this->User->findById($v['Article']['author_id'],array('id','name'));
					$posts[$n]['Author'] = $author['User'];
					$tc = $this->Crypto->urlencode64(
								serialize(array('article_id'=>$v['Article']['id'],
											'request_time'=>date("Y-m-d"),
											'rand'=>rand(1111,9999))));
					$posts[$n]['tc'] = $tc;
				}
			}
			
			$channel_name='trip';
			$this->set('channel_name',$channel_name);
			$this->set('posts',$posts);
			//show a banner please
			$this->loadModel('BannerChannel');
			$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
			$this->set('banners',$banners);
			$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
			$this->set('top_banners',$top_banners);
			$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
			$this->set('top_banners_small',$top_banners_small);
			$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
			$this->set('head_banners',$head_banner);
			
			$this->set('crypto',$this->Crypto);
			$this->set("domain",Configure::read('Custom.Domain'));
		}
	}
	 /**
	  * channel trip
	  */
	  function trip($group_str=null,$category=null,$view=null,$article_id=null){
	  	$this->set('curr_page','TRIP');
	  	
	  	
		$this->loadModel('Category');
		$this->loadModel('Province');
		$this->loadModel('Trip');
		

		
		if($view==null&&$article_id!=null){
			$category = $this->Category->findByName_str($group_str);
			$this->layout = "default";
			$this->_getGroupArticle($category,intval($article_id));
		}else if($category!=null&&$view==null){
			$province = $this->Province->findByName_str($group_str);
			$this->TripArticlesByCategory($province['Province'],$category);
		}else if($category!=null&&$view!=null){
			$province = $this->Province->findByName_str($group_str);
			$this->ReadTripArticleByCategory($province['Province'],$category,$article_id);
			
		}else if($group_str!=null&&@$this->request->query['ajax']==1){
			
			$this->layout="ajax";
			if(isset($this->request->query['count'])){
				//return each category counts for these province.
				$province = $this->Province->findByName_str($this->request->query['p']);
				
				print $this->Trip->getProvinceArticleCounts(intval($province['Province']['id']));
				//print json_encode(array('air'=>0,'water'=>2,'land'=>15));
				die();
			}else{
				$province = $this->Province->findByName_str($group_str);
				$categories = $this->getTripCategories($province['Province']);
				$trip_counts = $this->Trip->getProvinceArticleCounts(intval($province['Province']['id']),false);
				$posts = array();

				if($trip_counts['land']>0){
					$land = $this->Trip->getArticles(0,intval($province['Province']['id']),1,1);
					array_push($posts,$land[0]);
				}else{
					array_push($posts,array());
				}
				if($trip_counts['water']>0){
					$water = $this->Trip->getArticles(0,intval($province['Province']['id']),2,1);
					array_push($posts,$water[0]);
				}else{
					array_push($posts,array());
				}
				if($trip_counts['air']>0){
					$air = $this->Trip->getArticles(0,intval($province['Province']['id']),3,1);
					array_push($posts,$air[0]);
				}else{
					array_push($posts,array());
				}

				
				
				

				$this->set('dest_count',$trip_counts['land']+$trip_counts['air']+$trip_counts['water']);
				$this->set('province',$province['Province']);
				$this->set('categories',$categories);
				//$this->set('posts',$this->TripArticlesByProvince($province,3));
				$this->set('posts',$posts);
				$this->set('channel_name','trip');
				$this->render("ajax_trip_list");
			}
		}else{
			//$this->getTripArticles();
			$this->loadBanners(6);

			
			$this->Article->bindModel(array(
				'belongsTo'=>array(
						'ArticleCategory'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'ArticleCategory.article_id = Article.id'
							)
						),
						'Category'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'Category.id = ArticleCategory.category_id',
								'Category.channel_id'=>4
							)
						),
						'User'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'User.id = Article.author_id'
							)
						),
						'Province'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'Province.id = Article.province_id',
								'Province.id > 0'
							)
						)
					)
				)
			);
			$this->paginate = array('conditions'=>array('Article.n_status'=>1),
								'limit'=>8,'order'=>array('Article.id'=>'DESC'));
			$posts = $this->Paginate('Article');
			
			$posts = $this->attachMainImages($posts);

			
			$this->set('posts',$posts);
		}	

	}
	private function attachMainImages($posts){
		$this->loadModel('ArticleAsset');
		for($i=0;$i<sizeof($posts);$i++){
		 	$posts[$i]['MainImage'] = array();
			$images = $this->ArticleAsset->find('all',array(
							'conditions'=>array('ArticleAsset.article_id'=>$posts[$i]['Article']['id'],
												'ArticleAsset.is_main'=>1),
							'limit'=>2)
						);
			if(sizeof($images)>0){
				foreach($images as $img){
					$posts[$i]['MainImg'][] = array('filename'=>$img['ArticleAsset']['filename']);
				}
			}
		 }
		 return $posts;
	}
	/*
	*	$channel_id  the current channel_id
	*	$head_only  load only top or header banner(s), default : true
	*/
	private function loadBanners($channel_id,$head_only=true){
		$this->loadModel('BannerChannel');
		//show top banners
		$top_banners = $this->BannerWidget->getTopBanner($channel_id,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner($channel_id,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);

		if(!$head_only){
			$this->loadModel('BannerChannel');
			$banners = $this->BannerWidget->getBanner($channel_id,$this->BannerChannel);

			$this->set('banners',$banners);
		}
	}
	private function ReadTripArticleByCategory($province,$category,$article_id){
		$this->layout="default";//use the default layout
		
		$this->loadModel('User');
		$this->loadModel('ArticleCategory');
		$this->loadModel('UserPoint');
		$this->loadModel('UserPointHistory');
		$this->loadModel('Trip');
		$category_id=0;
		switch($category){
			case "land":
				$category_id=1;
			break;
			case "water":
				$category_id=2;
			break;
			case "air":
				$category_id=3;
			break;
			default:
				$category_id=0;
			break;
		}
		if(isset($this->request->query['ajax'])){
			if($this->Session->check('FBLogin')){
				$me = unserialize($this->Session->read("FBLogin"));
				$share_type = intval($this->request->query['share_type']);//1->fb, 2->tw, 3->email
				if(isset($this->request->query['tc'])){
					$tc = unserialize($this->Crypto->urldecode64($this->request->query['tc']));
					if($me['fb_id']!=null&&strlen($this->request->query['post_id'])>0){
						if($article_id>0 && $tc['article_id']==$article_id){
							switch($share_type){
								case 1://twitter
									$this->Point->addPoint($me['fb_id'],1,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								case 2://fb
									$this->Point->addPoint($me['fb_id'],2,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								case 3://email
									$this->Point->addPoint($me['fb_id'],3,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								default:
								break;
							}
							$arr = array("status"=>1);
							print json_encode($arr);
						}else{
							$arr = array("status"=>99);
							print json_encode($arr);				
						}
					}else{
						$arr = array("status"=>99);
						print json_encode($arr);				
					}
				}else{
					$arr = array("status"=>0);
					print json_encode($arr);
				}
			}else{
				$arr = array("status"=>-1);
				print json_encode($arr);
			}
			die();
		}else{
			
			
			//load article
			$rs = $this->Article->findById($article_id);
			//$this->_setCategoryVars($rs);
			$tc = $this->Crypto->urlencode64(
				serialize(array('article_id'=>$article_id,'request_time'=>date("Y-m-d"),'rand'=>rand(1111,9999))));
			
			if(isset($rs)){
				//content author
				$author = $this->User->findById($rs['Article']['author_id'],array('id','name'));
				//featured list
			
				$featured = $this->Trip->getArticles($article_id,$province['id'],$category_id,8);
				
				
				$this->loadModel('ArticleRate');
				$rate = $this->ArticleRate->findByArticle_id($rs['Article']['id']);

				if(intval(@$rate['ArticleRate']['total_hits'])>0){
					$this->set('rate',ceil(intval($rate['ArticleRate']['total_point'])/intval($rate['ArticleRate']['total_hits'])));
				}
				
				//ratings for each featured articles
				if(is_array($featured)){
					foreach($featured as $n=>$v){
						$f_rate = $this->ArticleRate->findByArticle_id($v['Article']['id']);
						if(isset($f_rate['ArticleRate']['total_point'])){
							$featured[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
						}
					}
				}
				//set everything
				$this->set('back_url','javascript:history.go(-1);');
				$this->set('article',$rs['Article']);
				
				$this->set('MainImg',$rs['MainImg']);
				$this->set('Province',$rs['Province']);
				$this->set('category',$category);
				$this->set('author',$author['User']);
				$this->set('featured',$featured);
				$this->set('tc',$tc);
				$this->set('crypto',$this->Crypto);
				$this->set("domain",Configure::read('Custom.Domain'));
				//show a banner please
				$this->loadModel('BannerChannel');
				$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
				$this->set('banners',$banners);
				$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
				$this->set('top_banners',$top_banners);
				$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
				$this->set('top_banners_small',$top_banners_small);
				$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
				$this->set('head_banners',$head_banner);
				$this->set('channel_name','trip');
				$this->render('trip_read');
				
				
			}else{
				$this->flash("Page not found !","/");
			}
		}
		
		
		
	}
	private function TripArticlesByProvince($province,$total=3){
		$province_id = $province['Province']['id'];
		
		$this->loadModel('Channel');
		$this->loadModel('Trip');
		$this->loadModel('User');
		$conditions = array("province_id"=>$province_id,'n_status'=>1);
		$this->paginate = array('Trip'=>
							array('conditions'=>$conditions,

						  	'limit'=> $total,
						   )
					);
		$posts = $this->paginate('Trip');

		if(is_array($posts)){
			foreach($posts as $n=>$v){
				$posts[$n]['Province'] = $province;
				$author = $this->User->findById($v['Article']['author_id'],array('id','name'));
				$posts[$n]['Author'] = $author['User'];
			}
		}
		
		return $posts;
	}
	private function TripArticlesByCategory($province,$category,$total=8){
		
		$province_id = $province['id'];
		$this->loadModel('Channel');
		$category_id=0;
		switch($category){
			case "land":
				$category_id=1;
			break;
			case "water":
				$category_id=2;
			break;
			case "air":
				$category_id=3;
			break;
			default:
				$category_id=0;
			break;
		}
		
		$this->layout="default";//use the default layout
		$this->loadModel('Trip');
		$this->loadModel('User');
		$conditions = array("province_id"=>$province_id,"category_id"=>$category_id);
		$this->paginate = array('Trip'=>
							array('conditions'=>$conditions,
						  	'limit'=> $total,
						   )
					);
		$posts = $this->paginate('Trip');
		if(is_array($posts)){
			foreach($posts as $n=>$v){
				$posts[$n]['Province'] = $province;
				$author = $this->User->findById($v['Article']['author_id'],array('id','name'));
				$posts[$n]['Author'] = $author['User'];
			}
		}
		
		$channel_name='trip';
		$this->set('channel_name',$channel_name);
		$this->set('posts',$posts);
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		
		//meeting posts
		$this->loadModel("ForumAnswer");
		$this->loadModel("Forum");
		
		//$meetingpost = $this->ForumAnswer->getRecentPost(3);
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
		
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		
		
		
		$this->render('trip');
	}
	private function getTripArticles($total=12){
		$this->layout="default";//use the default layout
		$this->loadModel('Trip');
		$conditions = array("n_status"=>1);
		$this->paginate = array('Trip'=>
							array('conditions'=>$conditions,
						  	'limit'=> $total,
						   )
					);
		
		$posts = $this->paginate('Trip');
		
		$channel_name='trip';
		$this->set('channel_name',$channel_name);
		$this->set('posts',$posts);
		//meeting posts
		//meeting posts
		$this->loadModel("ForumAnswer");
		$this->loadModel("Forum");
		
		//$meetingpost = $this->ForumAnswer->getRecentPost(3);
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
		
		//show a banner please
		$this->loadModel('BannerChannel');
		$banners = $this->BannerWidget->getBanner(6,$this->BannerChannel);
		$this->set('banners',$banners);
		$top_banners = $this->BannerWidget->getTopBanner(6,$this->BannerChannel);
		$this->set('top_banners',$top_banners);
		$top_banners_small = $this->BannerWidget->getTopSmallBanner(6,$this->BannerChannel);
		$this->set('top_banners_small',$top_banners_small);
		$head_banner = $this->BannerWidget->getHeadBanner(6,$this->BannerChannel);
		$this->set('head_banners',$head_banner);
		
		$this->render('trip');
	}
	private function getTripCategories($province){
		$id = $province['id'];
		//get counter for each category for all posts of these province.
		//--land
		$sql = "SELECT COUNT(Article.id) AS total FROM articles Article 
				INNER JOIN article_categories AS ArticleCategory
				ON ArticleCategory.article_id = Article.id
				WHERE Article.province_id={$province['id']} 
				AND ArticleCategory.category_id IN (1);";
		$land = $this->Province->query($sql);
		
		//water
		$sql = "SELECT COUNT(Article.id) AS total FROM articles Article 
				INNER JOIN article_categories AS ArticleCategory
				ON ArticleCategory.article_id = Article.id
				WHERE Article.province_id={$province['id']} 
				AND ArticleCategory.category_id IN (2);";
		$water = $this->Province->query($sql);
		
		//air
		$sql = "SELECT COUNT(Article.id) AS total FROM articles Article 
				INNER JOIN article_categories AS ArticleCategory
				ON ArticleCategory.article_id = Article.id
				WHERE Article.province_id={$province['id']} 
				AND ArticleCategory.category_id IN (3);";
		$air = $this->Province->query($sql);
		
		$rs= array("land"=>$land[0][0]['total'],
				   "water"=>$water[0][0]['total'],
				   "air"=>$air[0][0]['total']);
		return $rs;
	}
	public function admin_provinces(){
		clearCache();
		$this->loadModel("Province");
		$province = $this->Province->find('all');
		$this->set('provinces',$province);
	}
	public function admin_edit_province(){
		clearCache();
		$this->loadModel("Province");
		if(isset($this->request->query['id'])){
			$data = $this->Province->findById($this->request->query['id']);
			$this->set('data',$data);
		}else{
			$this->show_message("the province is not found",array("label"=>"Continue","url"=>"/admin/articles/provinces"));
		}
	}
	private function show_message($msg,$link){
		$this->set('message',$msg);
		$this->set('link',$link);
		$this->set("autolink",true);
		$this->render('admin_result');
	}
	public function admin_update_province(){
		clearCache();
		if(isset($this->request->data['id'])&&strlen($this->request->data['id'])>0){
			$this->loadModel("Province");
			$this->Province->id=$this->request->data['id'];
			$this->Province->save($this->request->data);
			$this->show_message("The province's description has been changed successfully !'",array("label"=>"Continue","url"=>"/admin/articles/provinces"));
		}else{
			$this->show_message("cannot proceed your request.",array("label"=>"Continue","url"=>"/admin/articles/provinces"));
		}
	}
	private function _getTripLatestArticle($province_id){
		$this->loadModel('ArticleCategory');
		$this->loadModel('ArticleAsset');
		$province_id = intval($province_id);
		$articles = $this->Article->query("SELECT * FROM articles Article
										   INNER JOIN 
										   article_categories ArticleCategory
										   ON Article.id = ArticleCategory.article_id
										   INNER JOIN categories Category
										   ON ArticleCategory.category_id = Category.id
										   WHERE Article.province_id={$province_id}
										   AND Category.channel_id IN (6,7,8)
										   ORDER BY Article.id DESC LIMIT 6");		
		foreach($articles as $n=>$v){
			$asset = $this->ArticleAsset->find('first',array('conditions'=>array('article_id'=>$v['Article']['id'],
																				  'is_main'=>1),
															  'limit'=>1));
																
			$articles[$n]['MainImg'] = $asset['ArticleAsset'];
		}
		//find the category matched for these
		$this->set("posts",$articles);
		
	}
	private function _getGroupArticle($cat=null,$article_id=null){
	
		$this->loadModel('User');
		$this->loadModel('ArticleCategory');
		$this->loadModel('UserPoint');
		$this->loadModel('UserPointHistory');
		$this->loadModel('ArticleRate');
		if(isset($this->request->query['ajax'])){
			if($this->Session->check('FBLogin')){
				$me = unserialize($this->Session->read("FBLogin"));
				$share_type = intval($this->request->query['share_type']);//1->fb, 2->tw, 3->email
				if(isset($this->request->query['tc'])){
					$tc = unserialize($this->Crypto->urldecode64($this->request->query['tc']));
					if($me['fb_id']!=null&&strlen($this->request->query['post_id'])>0){
						if($article_id>0 && $tc['article_id']==$article_id){
							switch($share_type){
								case 1://twitter
									$this->Point->addPoint($me['fb_id'],1,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								case 2://fb
									$this->Point->addPoint($me['fb_id'],2,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								case 3://email
									$this->Point->addPoint($me['fb_id'],3,"article_{$article_id}",$this->UserPoint,$this->UserPointHistory);
								break;
								default:
								break;
							}
							$arr = array("status"=>1);
							print json_encode($arr);
						}else{
							$arr = array("status"=>99);
							print json_encode($arr);				
						}
					}else{
						$arr = array("status"=>99);
						print json_encode($arr);				
					}
				}else{
					$arr = array("status"=>0);
					print json_encode($arr);
				}
			}else{
				$arr = array("status"=>-1);
				print json_encode($arr);
			}
			die();
		}else{
			
			$this->_setCategoryVars($cat);
			$category = $cat['Category'];
			//load article
			$rs = $this->Article->findById($article_id);
			$tc = $this->Crypto->urlencode64(
				serialize(array('article_id'=>$article_id,'request_time'=>date("Y-m-d"),'rand'=>rand(1111,9999))));
			
			//check article and category relationships
			$check = $this->ArticleCategory->find('first',
											array('conditions'=>array('article_id'=>$rs['Article']['id'],
																	  'ArticleCategory.category_id'=>$category['id'])
					));
			
			if($check['ArticleCategory']['category_id']==$category['id']){
				//content author
				$author = $this->User->findById($rs['Article']['author_id'],array('id','name'));
				//featured list
				$featured = $this->ArticleCategory->find('all',array('conditions'=>
																array('ArticleCategory.category_id'=>$category['id'],
																		'ArticleCategory.is_featured'=>1,
																		'n_status'=>1),
															'limit'=>8,
															'order'=>'ArticleCategory.category_id DESC',
															));
				
				foreach($featured as $n=>$v){
					$article = $this->Article->findById($v['ArticleCategory']['article_id']);	
					$featured[$n]['Article'] = $article['Article'];
					$featured[$n]['MainImg'] = $article['MainImg'];
					//ratings for each featured articles
					$f_rate = $this->ArticleRate->findByArticle_id($v['ArticleCategory']['article_id']);
					if(isset($f_rate['ArticleRate']['total_point'])){
						$featured[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
					}
				}
				
				//get rates
				$this->loadModel('ArticleRate');
				$rate = $this->ArticleRate->findByArticle_id($rs['Article']['id']);
				if($rate['ArticleRate']['total_hits']>0){
					$this->set('rate',ceil(intval($rate['ArticleRate']['total_point'])/intval($rate['ArticleRate']['total_hits'])));
				}

				//set everything
				$this->set('back_url','javascript:history.go(-1);');
				$this->set('article',$rs['Article']);
				$this->set('MainImg',$rs['MainImg']);
				$this->set('cat',$cat);
				$this->set('author',$author['User']);
				$this->set('Province',$rs['Province']);
				$this->set('featured',$featured);
				$this->set('tc',$tc);
				$this->set('crypto',$this->Crypto);
				$this->set("domain",Configure::read('Custom.Domain'));
				
				//banners !need to refactoring these.
				$this->loadModel('BannerChannel');
				$top_banners = $this->BannerWidget->getTopBanner(1,$this->BannerChannel);
				$this->set('top_banners',$top_banners);
				$top_banners_small = $this->BannerWidget->getTopSmallBanner(1,$this->BannerChannel);
				
				$this->set('top_banners_small',$top_banners_small);
				$head_banner = $this->BannerWidget->getHeadBanner(1,$this->BannerChannel);
				$this->set('head_banners',$head_banner);

				//destination widget
				$this->loadModel('Trip');
				$destination = $this->DestinationWidget->getLatest($this->Trip,$this->PImage);
				//pr($destination);

				$this->set('destination',$destination);

				//related articles
				//supermusic recent posts
				
				$related_articles = $this->getRecentPost($cat['Channel']['name_str'],4);
				$this->set('related_articles',$related_articles);

				//gallery widget
				$this->loadModel('Gallery');
				$this->loadModel('Video');
				$gallery = $this->GalleryWidget->getLatest($this,$this->Gallery,$this->PImage,4);
			
				$video = $this->GalleryWidget->getRecentVideos($this->Video,4);
				
				$this->set('gallery',$gallery);
				$this->set('video',$video);



				//supermusic recent posts
				$supermusic = $this->getRecentPost('music',4);
				$this->set('supermusic',$supermusic);

				//aktifitas recent posts
				$aktifitas = $this->getRecentPost('aktifitas',2);
				$this->set('aktifitas',$aktifitas);

				//myadventure recent posts
				$land = $this->getRecentPost('land',1);
				$water = $this->getRecentPost('water',1);
				$air = $this->getRecentPost('air',1);

				$adventure = array();
				$adventure[] = $land[0];
				$adventure[] = $water[0];
				$adventure[] = $air[0];

				$this->set('adventure',$adventure);

				$this->render('article_detail');
				
				
				
			}else{
				$this->flash("Page not found !","/");
			}
		}
	}
	private function _getGrouplandingMultiCat($cat){
		$channel = $cat["Channel"];
		$category = $cat['Category'];
		$this->loadModel('ArticleRate');
		$this->set("domain",Configure::read('Custom.Domain'));
		if(strlen($channel['name_str'])==0){
			$category_name = 'default';
			$this->redirect("/");
			//$this->render('adventure');
		}else{
			$this->_setCategoryVars($cat);
			
			$page = intval(@$this->request->query['page']);
			if($page==0){
				$page = 1;
			}
			$category_id=array();
			foreach($category as $c){
				$category_id[] = $c['id'];
			}

			$conditions = array('id'=>$category_id);
			
			$this->loadModel('ArticleCategory');
			
			$conditions = array('ArticleCategory.category_id'=>$category_id,'n_status'=>1);
			$this->paginate = array('ArticleCategory'=>
									array('conditions'=>$conditions,
										  'limit'=> 8,
										  'order'=>'ArticleCategory.article_id DESC',
										   'group' => 'ArticleCategory.article_id')
							);
						
			$article_cats = $this->paginate('ArticleCategory');
			//now get the articles
			$article_ids = array();
			foreach($article_cats as $ac){
				$article_ids[] = $ac['ArticleCategory']['article_id'];
			}
			$posts = $this->Article->findAllById($article_ids,array(),array('Article.id'=> 'DESC'));
			foreach($posts as $n=>$p){
				$cats = $p['ArticleCategory'];
				foreach($cats as $c){
					foreach($category_id as $cids){
						if($cids==$c['category_id']){
							$aCategory = $this->Category->findById($cids);
							$posts[$n]['Category'] = $aCategory['Category'];
							break;
						}
					}
				}
				//ratings for each featured articles
				$f_rate = $this->ArticleRate->findByArticle_id($p['Article']['id']);
				if(isset($f_rate['ArticleRate']['total_point'])){
					$posts[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
				}
				$tc = $this->Crypto->urlencode64(
								serialize(array('article_id'=>$p['Article']['id'],
											'request_time'=>date("Y-m-d"),
											'rand'=>rand(1111,9999))));
				$posts[$n]['tc'] = $tc;
			}
			$this->set('posts',$posts);
			if(sizeof($posts)==0){
				$this->render("not_found");
			}
			
		}
	}
	private function _getGrouplanding($cat){
		
		$this->loadModel('ArticleCategory');
		$this->loadModel('ArticleRate');
		$channel = $cat["Channel"];
		$category = $cat['Category'];
		
		
		$this->set("domain",Configure::read('Custom.Domain'));
		
		if(strlen($channel['name_str'])==0){
			//$category_name = 'default';
			//$this->redirect("/");
			$this->render('not_found');
		}else{
			$this->_setCategoryVars($cat);
			
			$page = intval(@$this->request->query['page']);
			if($page==0){
				$page = 1;
			}
			
			$conditions = array('category_id'=>$category['id']);
			
			/*
			$this->paginate = array('Article'=>array('conditions'=>$conditions,
														'limit'=>3,
														'order'=>'Article.id DESC'));
			*/
			
			$conditions = array('ArticleCategory.category_id'=>$category['id']);
			$this->paginate = array('ArticleCategory'=>
									array('conditions'=>$conditions,
										  'limit'=> 8,
										  'order'=>'ArticleCategory.article_id DESC',
										   'group' => 'ArticleCategory.article_id')
							);
						
			$article_cats = $this->paginate('ArticleCategory');
			 
			//now get the articles
			$article_ids = array();
			foreach($article_cats as $ac){
				$article_ids[] = $ac['ArticleCategory']['article_id'];
			}
			$posts = $this->Article->findAllById($article_ids,array(),array('Article.id'=> 'DESC'));
			foreach($posts as $n=>$p){
				$cats = $p['ArticleCategory'];
				foreach($cats as $c){
					if($category['id']==$c['category_id']){
						$aCategory = $this->Category->findById($category['id']);
						$posts[$n]['Category'] = $aCategory['Category'];
						break;
					}
					
				}
				//ratings for each featured articles
				$f_rate = $this->ArticleRate->findByArticle_id($p['Article']['id']);
				if(isset($f_rate['ArticleRate']['total_point'])){
					$posts[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
				}
				$tc = $this->Crypto->urlencode64(
								serialize(array('article_id'=>$p['Article']['id'],
											'request_time'=>date("Y-m-d"),
											'rand'=>rand(1111,9999))));
				$posts[$n]['tc'] = $tc;
			
			}
			$this->set('posts',$posts);
			
			if(sizeof($posts)==0){
				$this->render("not_found");
			}
			
		}
	}
	
	private function _setCategoryVars($cat){
		$channel = $cat['Channel'];
		$category = $cat['Category'];
		
		//default layout settings
		$view_style = array('air'=>'airPage',
							 'water'=>'waterPage',
							 'land'=>'landPage',
							 'default'=>'homePage');
		
		
		$air = false;
		$water = false;
		$land = false;
		
		
		
		if($channel['name_str']=="air"||$channel['name_str']=="water"||$channel['name_str']=="land"){
			if($channel['name_str']=='air'){$air = true;}
			if($channel['name_str']=='water'){$water = true;}
			if($channel['name_str']=='land'){$land = true;}
			
			$this->set('container_style',$view_style[$channel['name_str']]);
		}else{
			$air = true;
			$water = true;
			$land = true;
			$this->set('container_style',$view_style['default']);
		}
		
		
		$this->set('air',$air);
		$this->set('water',$water);
		$this->set('land',$land);
		
		$this->set('channel_name',$channel['name_str']);
	}
	function add(){
		if($this->request->is('post')){
			$this->_addPost();
		}else{
			$this->_addGet();
		}
		
	}
	 function _addGet(){
	 	
	 }
	 function _addPost(){
	 	
	 	
	 }
	 /**
	  * Admin stuffs
	  */
	  function admin_index($category_id=0,$total=null){
	  		$this->layout="admin";
	  		$category_id = intval($category_id);
			if($category_id>0){
				$this->_list_article_by_category($category_id,$total);
			}else{
	  			$this->_list_all_article($total);
			}
	  }
	  private function _list_article_by_category($category_id,$total=null){
	  	$this->disableCache();
		$this->loadModel('ArticleCategory');
		$this->loadModel('Category');
  		$total = intval(@$total);
		if($total==0){
			$total =50;
		}
		if($total>50){
			$total = 50;
		}
		$searchQuery = (isset($this->request->query['search']))?$this->request->query['search']:'';
		
		$this->paginate = array('ArticleCategory'=>array('limit'=>$total,
								'order'=>'ArticleCategory.article_id DESC',
								'conditions'=>array('ArticleCategory.category_id'=>$category_id),
								'join'=>array('Category')));
		$posts = $this->paginate('ArticleCategory');
		foreach($posts as $n=>$p){
			//Article
			$article = $this->Article->findById($p['ArticleCategory']['article_id']);
			$posts[$n]['Article'] = $article['Article'];
			$categories = $this->ArticleCategory->findAllByArticle_id($p['ArticleCategory']['article_id']);
			$posts[$n]['categories'] = $categories;
		}
		
		$this->set('total_rows',$total);
		$this->set('posts',$posts);
		$this->set('categories',$this->Category->find('all'));
	  }
	  private function _list_all_article($total=null){
	  	$this->disableCache();
		Cache::clear();
		$this->loadModel('ArticleCategory');
		$this->loadModel('Category');
  		$total = intval(@$total);
		$searchQuery = "";
		if(isset($this->request->query['search'])){
			$searchQuery = $this->request->query['search'];
		}
		if($total==0){
			$total =50;
		}
		if($total>50){
			$total = 50;
		}
		$this->Article->cacheQueries=false;
		if(strlen($searchQuery)>0){
			$this->paginate = array('Article'=>array('conditions'=>"Article.title like '%{$searchQuery}%'",'limit'=>$total,'order'=>'Article.id DESC','join'=>array('Category')));
		}else{
  			$this->paginate = array('Article'=>array('limit'=>$total,'order'=>'Article.id DESC','join'=>array('Category')));
  		}
		$posts = $this->paginate('Article');
		//categories for each posts
		foreach($posts as $n=>$p){
			//categories
			$categories = $this->ArticleCategory->findAllByArticle_id($p['Article']['id']);
			$posts[$n]['categories'] = $categories;
		}
		$this->set('total_rows',$total);
		$this->set('posts',$posts);
		$this->set('categories',$this->Category->find('all'));
	  }
	  function admin_add(){
	  		clearCache();
		  	if($this->request->data&&$this->request->is('post')){
		  		$this->loadModel('ArticleCategory');
				$user = unserialize($this->Session->read("userlogin"));
				//var_dump($this->request->data);
				$data = array("author_id"=>$user['id'],"title"=>$this->request->data['title'],
							"category_id"=>0,
							"summary"=>$this->request->data['summary'],
							"content"=>$this->request->data['content'],
							"province_id"=>$this->request->data['province_id'],
							"youtube_video"=>$this->request->data['youtube'],
							"lat"=>$this->request->data['lat'],
							"lon"=>$this->request->data['lon'],
							"created_time"=>date("Y-m-d H:i:s"),
							"n_status"=>$this->request->data['status']
							);
				$this->Article->create($data);
				$rs = $this->Article->save();
				if($rs){
					//add new categories
					$categories = $this->request->data['categories'];
					$cats = explode(",",$categories);
					foreach($cats as $catID){
						$catID = intval($catID);
						$this->ArticleCategory->create(array('article_id'=>$this->Article->id,'category_id'=>$catID));
						$this->ArticleCategory->save();
					}
					//-->
					$this->set('msg',"Your article has been saved successfully !");
					$this->redirect("/admin/articles/edit/{$this->Article->id}?redirect=1");
				}else{
					
					$this->set('msg','Sorry, cannot validate your input, please try again later !');
				}
		  	}
			//populate category dropdown
			$this->loadModel('Category');
			$category = $this->Category->find('all');
			$this->set('category',$category);
			
			//provinces
			$this->loadModel('Province');
			$provinces = $this->Province->find('all',array('order'=>'Province.id ASC'));
			$this->set('provinces',$provinces);
	  	}
	  	function admin_featured($id=null,$is_featured=0){
	  		clearCache();
	  		$data = array('id'=>$id,"is_featured"=>$is_featured);
			if($this->Article->save($data)){
				$this->set("message","The change has been saved successfully !");
			}else{
				$this->set("message","Update failed, please try again later !");
			}
			$this->set("link",array("url"=>"/admin/articles","label"=>"Return to index"));
			$this->render("admin_result");
	  	}
		function admin_edit($id=null,$modifier=null,$subject_id=null,$status=null){
			
			clearCache();
			$this->disableCache();
			//load necessary asset
			$this->loadModel("ArticleAsset");
			$this->loadModel('Category');
			$this->loadModel('ArticleCategory');
			$this->loadModel('Province');
			
			if($this->request->data&&$this->request->is('post')){

				if(isset($this->request->data['ArticleAsset'])){
					//upload asset
					$id = $this->_upload_article_image();
				}else{
					//update article
					$id = $this->_update_article();
				}
			}else{
				
				if($modifier=='toggle_image'){
					
					$this->_toggle_image($id,$this->request->query['id'],$this->request->query['toggle']);
				}else if($modifier=='toggle_featured'){
					$this->_toggle_featured($subject_id,$status);
				}
			}
			//populate category dropdown
			$category = $this->Category->find('all');
			$this->set('category',$category);
			
			//ah yes, the article_id
			$article_id = intval($id);
			
			//the posts
			$post = $this->Article->findById($article_id);
			$this->set('post',$post);
			
			//the images
			$images = $this->ArticleAsset->findAllByArticle_id($article_id);
			$this->set('images',$images);
			
			//categories
			$categories = $this->ArticleCategory->findAllByArticle_id($article_id);
			$this->set('categories',$categories);
			
			//provinces
			$provinces = $this->Province->find('all',array('order'=>'Province.id ASC'));
			//channel
			$channels = array();
			foreach($categories as $cat){
				$channels[] = $this->Category->findById(@$cat['Category']['id']);
			}
			//debug($channels);die();
			//$this->set("channel",$c['Channel']['name_str']);
			$this->set('channels',$channels);
			$this->set('provinces',$provinces);
			
			if(isset($this->request->query['redirect'])){
				$this->set('msg','Your article has been saved, now you can upload an image or set where these article should be featured.');
			}
			
		}
		private function _toggle_image($article_id,$image_id,$status){
			$image_id = intval($image_id);
			if($status==0){
				$this->Article->query("UPDATE article_assets SET is_main=0 
				WHERE article_id = {$article_id}");
				$this->Article->query("UPDATE article_assets SET is_main=1
				WHERE id = {$image_id} AND article_id = {$article_id}");
			}else{
				$this->Article->query("UPDATE article_assets SET is_main=0
				WHERE id = {$image_id} AND article_id = {$article_id}");
			}

			
			
			

			
		}
		private function _toggle_featured($id,$status){
			$this->Article->query("UPDATE article_categories SET is_featured={$status} WHERE id={$id}");
			//$data = array("id"=>$id,"is_featured"=>$status);
			//$this->ArticleCategory->save($data);
			
		}
		private function _upload_article_image(){
			
			$id = $this->request->data['post_id'];
			$post = $this->Article->findById($id);
			
			if(sizeof($post['MainImg'])<20){
				if ($this->data['ArticleAsset']['img']['size']>0 && !$this->data['ArticleAsset']['img']['error']) {
					//upload file
					//$view = new View($this);
					//$html = $view->loadHelper('Html');
					$tmp_name = $this->data['ArticleAsset']['img']['tmp_name'];
					$filename = date("YmdHis").".{$this->data['ArticleAsset']['img']['name']}";
					$destination = "content/images/".$filename;
					$file_ok = false;
			        if(move_uploaded_file($tmp_name, $destination)){
				        $data = array("filename"=>$filename,"article_id"=>$this->request->data['post_id'],"is_main"=>0);
						//also create the thumbnail
						//160x110 pixels
						
						if($this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"thumb_".$filename, 
														195, 127, 70)){
													
							$this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"big_".$filename, 
														980, 425, 70);
														
														
							$this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"small2_".$filename, 
														220, 165, 70);		
							
							$this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"small3_".$filename, 
														140, 105, 70);
																										
							$this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"medium_".$filename, 
														600, 390, 70);
														
							$this->PImage->resizeImage('resize', $filename, 
														"content/images/", 
														"small_".$filename, 
														298, 195, 70);
																										
							$this->PImage->resizeImage('resizeCrop', $filename, 
														"content/images/", 
														null, 
														1024, 768, 80);
							
							$file_ok = true;
						}
						//-->
					}
					if($file_ok){
						if($this->ArticleAsset->save($data)){
							$this->set('msg',"The Image has been uploaded successfully !");
						}else{
							$this->set('msg','Cannot upload the image, please try again later !');
						}
					}else{
						$this->set('msg','We failed to resize your image. Please tray again later !');
					}
			    }
			}else{
				$this->set('msg','you can only have 20 images maximum per article ! Please remove one of the image first !');
			}
			return $id;
		}
		private function _update_article(){
			
			$id = $this->request->data['post_id'];
			$this->Article->id = $this->request->data['post_id'];
			$data = array(
						"id"=>$this->request->data['post_id'],
						"title"=>$this->request->data['title'],
						"summary"=>$this->request->data['summary'],
						"content"=>$this->request->data['content'],
						"province_id"=>$this->request->data['province_id'],
						"youtube_video"=>$this->request->data['youtube'],
						"lat"=>$this->request->data['lat'],
						"lon"=>$this->request->data['lon'],
						"n_status"=>$this->request->data['status']
						);
			$categories = $this->request->data['categories'];
			$rs = $this->Article->save($data,true);
			if($rs){
				//reset the categories
				$dbName = $this->ArticleCategory->getDataSource()->config['database']; 
				$this->ArticleCategory->query("DELETE FROM {$dbName}.article_categories WHERE article_id={$id}");
				//add new categories
				$cats = explode(",",$categories);
				foreach($cats as $catID){
					$catID = intval($catID);
					$this->ArticleCategory->create(array('article_id'=>$id,'category_id'=>$catID));
					$this->ArticleCategory->save();
				}
				//-->
				$this->set('msg',"Your article has been saved successfully !");
			}else{
				
				$this->set('msg','Sorry, cannot validate your input, please try again later !');
			}
			return $id;
		}
		function admin_groups(){
			clearCache();
		  	$this->loadModel("Category");
			$this->loadModel("Channel");
			
			if($this->request->is("post")){
				$this->_add_article();	
			}
			
			$categories = $this->Category->find('all');
			$channels = $this->Channel->find('all');
			$this->set('categories',$categories);
			$this->set('channels',$channels);
		}
		private function _add_article(){
			$channel_id = $this->request->data['channel_id'];
			$name = $this->request->data['name'];
			$name_str = $this->request->data['alias'];
			
			$data  = array("channel_id"=>$channel_id,"name"=>$name,"name_str"=>$name_str);
			
			
			
			$this->Category->create();
			$rs = $this->Category->save($data);
			
			if($rs){
				$msg = "New Category has been created successfully !";
			}else{
				$msg = "Cannot create the category, please try again later !";
			}
			$this->set("msg",$msg);
		}
		public function rate(){
			$article_id = intval($this->request->query['id']);
			$point = intval($this->request->query['point']);
			if($point<=5 && $this->Session->read("article_{$article_id}_voted")==null){
				$dbName = $this->Article->getDataSource()->config['database']; 
				$q = $this->Article->query("INSERT INTO {$dbName}.article_rates 
										(
										`article_id`, 
										`total_point`, 
										`total_hits`
										)
										VALUES
										(
										{$article_id}, 
										{$point}, 
										1
										)
										ON DUPLICATE KEY UPDATE
										total_point = total_point+VALUES(total_point),
										total_hits = total_hits+VALUES(total_hits);
										");
				if(is_array($q)){
					print json_encode(array('status'=>1));
					$this->Session->write("article_{$article_id}_voted",1);
					die();
				}
			}
			print json_encode(array('status'=>0));
			die();
		}

		public function music($view=null,$article_id=0){
			
			$this->loadModel('Category');
			$this->loadModel('Channel');
			$channel = $this->Channel->findByName_str('music');

			$category = array('Channel'=>$channel['Channel'],
							  'Category'=>$this->getCategoryFromChannelObject($channel));
			$category_id = $category['Category']['id'];
			if($view==null){
				$this->_getGroupLanding($category);
			}else{

				$this->_getGroupArticle($category,intval($article_id));
			}
			//show a banner please
			$this->loadModel('BannerChannel');
			$banners = $this->BannerWidget->getBanner($category_id,$this->BannerChannel);
			$this->set('banners',$banners);
			$top_banners = $this->BannerWidget->getTopBanner($category_id,$this->BannerChannel);
			$this->set('top_banners',$top_banners);
			$top_banners_small = $this->BannerWidget->getTopSmallBanner($category_id,$this->BannerChannel);
			$this->set('top_banners_small',$top_banners_small);
			$head_banner = $this->BannerWidget->getHeadBanner($category_id,$this->BannerChannel);
			$this->set('head_banners',$head_banner);
			


			if($view!=null){

				//destination widget
				$this->loadModel('Trip');
				$destination = $this->DestinationWidget->getLatest($this->Trip,$this->PImage);
				//pr($destination);

				$this->set('destination',$destination);

				//related articles
				//supermusic recent posts
				
				$related_articles = $this->getRecentPost('music',4);
				$this->set('related_articles',$related_articles);

				//gallery widget
				$this->loadModel('Gallery');
				$this->loadModel('Video');
				$gallery = $this->GalleryWidget->getLatest($this,$this->Gallery,$this->PImage,4);
				$video = $this->GalleryWidget->getRecentVideos($this->Video,4);
			
				$this->set('gallery',$gallery);
				$this->set('video',$video);

				//supermusic recent posts
				$supermusic = $this->getRecentPost('music',4);
				$this->set('supermusic',$supermusic);

				//aktifitas recent posts
				$aktifitas = $this->getRecentPost('aktifitas',2);
				$this->set('aktifitas',$aktifitas);

				//myadventure recent posts
				$land = $this->getRecentPost('land',1);
				$water = $this->getRecentPost('water',1);
				$air = $this->getRecentPost('air',1);

				$adventure = array();
				$adventure[] = $land[0];
				$adventure[] = $water[0];
				$adventure[] = $air[0];

				$this->set('adventure',$adventure);

				$this->render('supermusic_detail');	
			}else{
				$this->render('supermusic');	
			}
			
		}
		public function aktifitas($view=null,$article_id=0){
			
			$this->loadModel('Category');
			$this->loadModel('Channel');


			$channel = $this->Channel->findByName_str('aktifitas');

			$category = array('Channel'=>$channel['Channel'],
							  'Category'=>$this->getCategoryFromChannelObject($channel));
			$category_id = $category['Category']['id'];


			if($view==null){
				$this->_getGroupLanding($category);
			}else{

				$this->_getGroupArticle($category,intval($article_id));
			}
			//show a banner please
			$this->loadModel('BannerChannel');
			$banners = $this->BannerWidget->getBanner($category_id,$this->BannerChannel);
			$this->set('banners',$banners);
			$top_banners = $this->BannerWidget->getTopBanner($category_id,$this->BannerChannel);
			$this->set('top_banners',$top_banners);
			$top_banners_small = $this->BannerWidget->getTopSmallBanner($category_id,$this->BannerChannel);
			$this->set('top_banners_small',$top_banners_small);
			$head_banner = $this->BannerWidget->getHeadBanner($category_id,$this->BannerChannel);
			$this->set('head_banners',$head_banner);
			
			if($view!=null){
				//destination widget
				$this->loadModel('Trip');
				$destination = $this->DestinationWidget->getLatest($this->Trip,$this->PImage);
				//pr($destination);

				$this->set('destination',$destination);

				//related articles
				//supermusic recent posts
				
				$related_articles = $this->getRecentPost('aktifitas',4);
				$this->set('related_articles',$related_articles);

				//gallery widget
				$this->loadModel('Gallery');
				$this->loadModel('Video');
				$gallery = $this->GalleryWidget->getLatest($this,$this->Gallery,$this->PImage,4);
				$video = $this->GalleryWidget->getRecentVideos($this->Video,4);
			
				$this->set('gallery',$gallery);
				$this->set('video',$video);

				//supermusic recent posts
				$supermusic = $this->getRecentPost('music',4);
				$this->set('supermusic',$supermusic);

				//aktifitas recent posts
				$aktifitas = $this->getRecentPost('aktifitas',2);
				$this->set('aktifitas',$aktifitas);

				//myadventure recent posts
				$land = $this->getRecentPost('land',1);
				$water = $this->getRecentPost('water',1);
				$air = $this->getRecentPost('air',1);

				$adventure = array();
				$adventure[] = $land[0];
				$adventure[] = $water[0];
				$adventure[] = $air[0];

				$this->set('adventure',$adventure);
				$this->render('activity_detail');	
			}else{
				$this->render('activity');	
			}
			
		}
		private function getCategoryFromChannelObject($channel,$name_str='index'){
			foreach($channel['Category'] as $category){
				if($category['name_str']==$name_str){
					return $category;
				}
			}
		}

		private function getFeaturedArticles($article_id=0,$province_id=0,$category_id=0,$limit=8){
			$this->loadModel('ArticleRate');
			$this->loadModel('Trip');
			$featured = $this->Trip->getArticles($article_id,$province_id,$category_id,$limit);
					
			//ratings for each featured articles
			if(is_array($featured)){
				foreach($featured as $n=>$v){
					$f_rate = $this->ArticleRate->findByArticle_id($v['Article']['id']);
					if(isset($f_rate['ArticleRate']['total_point'])){
						$featured[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
					}
				}
			}
			return $featured;
		}
		private function getFeaturedTripArticles($limit=8){
			$this->loadModel('ArticleRate');

			$this->Article->bindModel(array(
				'belongsTo'=>array(
						'ArticleCategory'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'ArticleCategory.article_id = Article.id'
							)
						),
						'Category'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'Category.id = ArticleCategory.category_id',
								'Category.channel_id'=>4
							)
						),
						'User'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'User.id = Article.author_id'
							)
						),
						'Province'=>array(
							'foreignKey'=>false,
							'type'=>'inner',
							'conditions'=>array(
								'Province.id = Article.province_id'
							)
						)
					)
				)
			);
			
			$featured = $this->Article->find('all',array('limit'=>$limit,
														'conditions'=>array('Article.n_status'=>1),
														'order'=>array('Article.id'=>'DESC')));
			$featured = $this->attachMainImages($featured);
			if(is_array($featured)){
				foreach($featured as $n=>$v){
					$f_rate = $this->ArticleRate->findByArticle_id($v['Article']['id']);
					if(isset($f_rate['ArticleRate']['total_point'])){
						$featured[$n]['rate'] = ceil(intval($f_rate['ArticleRate']['total_point'])/intval($f_rate['ArticleRate']['total_hits']));
					}
				}
			}
			return $featured;
		}
		/** submit article page**/
		public function submit($channel_str){
			$this->loadModel('Category');
			$this->loadModel('Province');
			if($channel_str=='trip'){
				$this->submitTripArticle();
			}else if($channel_str=="adventure"){
				$this->submitAdventureArticle();
			}else{
				$this->redirect('/');
			}
		}
		private function submitAdventureArticle(){
			if($this->request->is('post')){
					$this->saveArticleSubmission();
			}
			$this->set('curr_page','ADVENTURE');
			$this->set('curr_page','TRIP');
			$this->loadBanners(6,false);
			
			$this->set('submit_trip',false);
			$this->set('hide_handicap',true);
			$this->set('categories',$this->Category->find('all',
				array(
					'conditions'=>array(
						'Category.channel_id'=>2
					),
					'limit'=>30	)
			));
			$this->set('provinces',
					$this->Province->find('all',
											array('limit'=>50)
										)
			);
		}
		private function submitTripArticle(){
			if($this->request->is('post')){
					$this->saveArticleSubmission();
			}
			$this->set('curr_page','TRIP');
			$this->loadBanners(6,false);
			$this->set('submit_trip',true);
			$this->set('featured',$this->getFeaturedTripArticles(3));
			$this->set('categories',$this->Category->find('all',
				array(
					'conditions'=>array(
						'Category.channel_id'=>4
					),
					'limit'=>30	)
			));
			$this->set('provinces',
					$this->Province->find('all',
											array('limit'=>50)
										)
			);

		}
		private function saveArticleSubmission(){
			$this->loadModel('Article');
			$this->loadModel('ArticleCategory');
			$this->loadModel('ArticleAsset');
			$me = $this->getCurrentUser();
			
			$this->Article->create();
			$rs = $this->Article->save(array(
				'category_id'=>$this->request->data['category_id'],
				'pronvince_id'=>$this->request->data['province_id'],
				'title'=>Sanitize::escape($this->request->data['title']),
				'content'=>Sanitize::escape($this->request->data['content']),
				'lat'=>$this->request->data['lat'],
				'lon'=>$this->request->data['lon'],
				'created_time'=>date("Y-m-d H:i:s"),
				'original_author_id'=>$me['Login']['id'],
				'youtube_video'=>Sanitize::escape($this->request->data['youtube_video'])
			));
			if(isset($rs['Article']) && intval($rs['Article']['id']) > 0){
				//linkage to category
				$this->ArticleCategory->query("
					INSERT IGNORE INTO article_categories
					(article_id,category_id,is_featured)
					VALUES
					({$rs['Article']['id']},{$this->request->data['category_id']},0)
				");

				//add file assets
				$att = explode(',',$this->request->data['attachments']);
				for($i=0;$i<sizeof($att);$i++){
					$this->ArticleAsset->create();
					$this->ArticleAsset->save(
						array(
							'article_id'=>$rs["Article"]['id'],
							'filename'=>$att[$i]
						)
					);
				}
				//-->
			}
			$this->redirect('/articles/success');
		}
		private function getCurrentUser(){
			$this->loadModel('Login');
			$me = unserialize($this->Session->read("FBLogin"));
			return $this->Login->findByFb_id($me['fb_id']);
		}
		/*
		* the page to tell user that the submission is success
		* and subject to moderation.
		*/
		public function success(){

		}

		public function send_comment(){
			$this->loadModel('ArticleComment');
			if($this->request->is('post')){
				$me = $this->getCurrentUser();
				
				if(intval($me['Login']['id'])>0){
					$this->ArticleComment->create();
					$rs = $this->ArticleComment->save(
						array('article_id'=>$this->request->data['post_id'],
							  'user_id'=>$me['Login']['id'],
							  'post_dt'=>date("Y-m-d H:i:s"),
							  'subject'=>$this->request->data['subject'],
							  'comment'=>$this->request->data['message'],
							  'rating'=>$this->request->data['rating']
							  )
					);
					if(isset($rs)){
						$this->Session->setFlash('Terima kasih atas komentar kamu !');
					}else{
						$this->Session->setFlash('Mohon maaf, komentar kamu tidak berhasil disimpan. Silahkan coba kembali !');
					}
				}
			}

			$this->redirect(Configure::read('WWW').Sanitize::escape($this->request->data['return']));
		}

		public function get_comments($article_id){
			$this->loadModel('ArticleComment');
			$this->loadModel('Login');
			//$this->layout = "ajax";

			//at the moment, we only retrieve 20 most recent comments
			$comments = $this->ArticleComment->find('all',array(
				'conditions'=>array('article_id'=>$article_id,
									'n_status'=>1),
				'limit'=>20,
				'order'=>array('ArticleComment.id'=>'DESC')
				)
			);
			//then retireve the user details from each comment
			for($i=0;$i<sizeof($comments);$i++){
				$user = $this->Login->findById($comments[$i]['ArticleComment']['user_id']);
				$comments[$i]['User'] = array('name'=>$user['Login']['name'],
												'fb_id'=>$user['Login']['fb_id']);
			}
			//$this->set('response',array('status'=>1,'comments'=>$comments));
			//$this->render('/Common/response');
			return $comments;
		}
}
?>