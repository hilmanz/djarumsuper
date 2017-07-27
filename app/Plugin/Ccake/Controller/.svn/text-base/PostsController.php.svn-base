<?php
app::uses('Sanitize','Utility');
class PostsController extends CcakeAppController {
	public function adm_index(){
		$this->attachCategories();
		$category_id = (isset($this->request->query['category_id'])) ? intval($this->request->query['category_id']) : 0;
		$this->set('category_id',$category_id);

		if($category_id>0){
			$this->paginate = array('conditions'=>array('Post.post_category_id'=>$category_id),
									'limit'=>25);
		}else{
			//find everything
			$this->paginate = array('limit'=>25);
		}
		$this->Post->bindModel(array(
			'belongsTo'=>array(
							'Page',
							'PostCategory'
							)
			));
		$posts = $this->paginate('Post');
		
	
		$this->set('posts',$posts);
	}
	public function adm_create(){
		$this->attachCategories();	
		$this->set('USE_WYSIWYG',true);
		if($this->request->is('post')){
			$page = $this->createPage();
			if($page['Page']['id'] > 0){
				//create a post
				$this->Post->create();
				if($this->Post->isUnique(array(
						'page_id'=>$page['Page']['id'],
						'post_category_id'=>$this->request->data['category']
						),false
					)){
					
					$post = $this->Post->save(array(
							'page_id'=>$page['Page']['id'],
							'post_category_id'=>$this->request->data['category'],
							'summary'=>$this->request->data['summary'],
							'post_dt'=>date("Y-m-d H:i:s"),
							'n_status'=>'0'
					));
					
					
					if($post['Post']['id'] > 0){
						$this->Session->setFlash("the post has been saved successfully !");
					}else{
						$this->Session->setFlash("Cannot save the posts, please try again later !");
					}
				}else{
					$this->Session->setFlash("The post is already exists");
				}
				
			}else{
				$this->setFlash("Cannot save the posts, please try again later !");
			}
		}
	}
	public function adm_edit($post_id){
		$this->attachCategories();	
		$this->set('USE_WYSIWYG',true);
		$this->set('post_id',intval($post_id));
		if($this->request->is('post')){
			$page = $this->updatePage();
			if($page['Page']['id'] > 0){
				//update a post
				
				$this->Post->id = $post_id;
				$post = $this->Post->save(array(
						'page_id'=>$page['Page']['id'],
						'post_category_id'=>$this->request->data['category'],
						'summary'=>$this->request->data['summary'],
						'post_dt'=>date("Y-m-d H:i:s"),
						'n_status'=>'0'
				));

				if($post){
					$this->Session->setFlash("the post has been updated successfully !");
				}else{
					$this->Session->setFlash("Cannot save the posts, please try again later !");
				}
			
				
			}else{
				$this->setFlash("Cannot save the posts, please try again later !");
			}
		}

		$this->Post->bindModel(array(
		'belongsTo'=>array(
						'Page',
						'PostCategory'
						)
		));
		$post = $this->Post->findById($post_id);
		$this->set('post',$post);
		
	}
	public function adm_delete($id){
		$this->Post->bindModel(array(
		'belongsTo'=>array(
						'Page',
						'PostCategory'
						)
		));
		$post = $this->Post->findById($id);

		if(isset($post['Page'])){
			$confirm = intval(@$this->request->query['confirm']);
			if($confirm==0){
				$this->showDialog(
						array(
							'caption'=>'Alert',
							'text'=>"Are you sure want to delete '{$post['Page']['title']}'",
							'yes_url'=>'/adm/ccake/posts/delete/'.$id.'?confirm=1',
							'no_url'=>'/adm/ccake/posts',
							'yes_label'=>"Delete it Anyway",
							'no_label'=>"Sorry, I changed my mind."
							),
						'confirm');
			}else{
				$this->Post->id = $post['Post']['id'];
				$rs = $this->Post->delete();
				if($rs==1){
					$msg = "the Post has been deleted successfully !";
				}else{
					$msg = "Sorry, the Post cannot be deleted. Make sure that the page is still exists !";
				}
				$this->showDialog(array(
						'caption'=>"Removing '{$post['Page']['title']}'",
						'text'=>$msg,
						'next_url'=>'/adm/ccake/posts',
						'label'=>"Back to Post list."
					));
			}
		}else{
			$this->showDialog(array(
						'caption'=>"Post not found",
						'text'=>"the post is not exists or no longer exists.",
						'next_url'=>'/adm/ccake/posts',
						'label'=>"Back to page list."
					));
		}
		
	}
	private function attachCategories(){
		$this->loadModel('PostCategory');
		$categories = $this->PostCategory->find('all',array('limit'=>'1000'));
		$this->set('categories',$categories);
	}

	private function createPage(){
		$this->loadModel('Page');
		$page_id = $this->slugify(date("Y-m-d").'-'.$this->request->data['title']);
		$rs = $this->Page->findByPage_id($page_id);
		if(!isset($rs['Page'])){
			$this->Page->create();
			$rs = $this->Page->save(array(
				'title'=>$this->request->data['title'],
				'page_id'=>$page_id,
				'content'=>$this->request->data['content'],
			));
		}
		
		
		return $rs;
	}
	private function updatePage(){
		$this->loadModel('Page');
		$rs = $this->Page->save(array(
			'title'=>$this->request->data['title'],
			'content'=>$this->request->data['content'],
		));
		return $rs;
	}


	public function index($slug,$action=null,$id=null){
		$this->loadModel('PostCategory');
		$this->set('slug',Sanitize::clean($slug));
		$category = $this->PostCategory->findBySlug($slug);
		$this->set('category_name',$category['PostCategory']['name']);
		
		$this->paginate = array('conditions'=>array('Post.post_category_id'=>
									$category['PostCategory']['id']),
									'limit'=>25);
		$this->Post->bindModel(array(
			'belongsTo'=>array(
							'Page',
							'PostCategory'
							)
			));

		if(!isset($action)){
			$posts = $this->paginate('Post');
			$this->set('posts',$posts);	
		}else{
			$this->set('CATEGORY_SLUG',Sanitize::clean($slug));
			$this->set('POST_ID',$id);
			$post = $this->Post->findById($id);
			$this->set('post',$post);
			$this->render('read');
		}
	}
	public function view(){
		$this->loadModel('PostCategory');
		
		$categorySlug = Sanitize::clean($this->request->params['categorySlug']);
		$postSlug = Sanitize::clean($this->request->params['postSlug']);

		$this->set('slug',$categorySlug);

		$category = $this->PostCategory->findBySlug($categorySlug);

		$this->set('category_name',$category['PostCategory']['name']);
		$this->set('CATEGORY_SLUG',$categorySlug);

		$this->Post->bindModel(array(
			'belongsTo'=>array(
							'Page',
							'PostCategory'
							)
			));
		$post = $this->Post->find('first',array('conditions'=>array(
				'post_category_id'=>$category['PostCategory']['id'],
				'Page.page_id'=>$postSlug
			)));
		
		$this->set('POST_ID',$post['Post']['id']);
		$this->set('post',$post);
		$this->render('read');
	}
	public function widget_recent_posts($category_slug=null){
		$this->Post->bindModel(array(
		'belongsTo'=>array(
						'Page',
						'PostCategory'
						)
		));

		$limit = (isset($this->request->query['total']))?intval($this->request->query['total']) : 5;
		if($category_slug!=null){
			$this->loadModel('PostCategory');
			$cat = $this->PostCategory->findBySlug($category_slug);
			$post_id = intval($this->request->query['id']);
			$posts = $this->Post->find('all',array(
				'conditions'=>array('Post.post_category_id'=>$cat['PostCategory']['id'],'Post.id <> '.$post_id),
				'limit'=>5,
				'order'=>array('Post.id ASC')
			));	
		}else{
			$posts = $this->Post->find('all',array(
				'limit'=>5,
				'order'=>array('Post.id ASC')
			));	
		}
		
		return $posts;
	}
	public function widget_related_posts($category_slug=null){
		$this->Post->bindModel(array(
		'belongsTo'=>array(
						'Page',
						'PostCategory'
						)
		));

		$limit = (isset($this->request->query['total']))?intval($this->request->query['total']) : 5;
		if($category_slug!=null){
			$this->loadModel('PostCategory');
			$cat = $this->PostCategory->findBySlug($category_slug);
			$post_id = intval($this->request->query['id']);
			$posts = $this->Post->find('all',array(
				'conditions'=>array('Post.post_category_id'=>$cat['PostCategory']['id'],'Post.id <> '.$post_id),
				'limit'=>5,
				'order'=>array('Post.id ASC')
			));	
		}else{
			$posts = $this->Post->find('all',array(
				'limit'=>5,
				'order'=>array('Post.id ASC')
			));	
		}
		
		return $posts;
	}
}