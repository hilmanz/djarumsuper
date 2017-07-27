<?php
/**
 * a model for On the go component
 */
 class Trip extends AppModel{
 	public $useTable = false;
	public $paginate = array(
					    'findType'=>'Trip'
						);
	
	public function getArticles($article_id,$province_id,$category_id,$limit=5){
		if($category_id>0 && $province_id > 0){
			$sql = "SELECT * FROM articles Article 
					INNER JOIN article_categories AS ArticleCategory
					ON ArticleCategory.article_id = Article.id
					INNER JOIN categories AS Category
					ON ArticleCategory.category_id = Category.id
					INNER JOIN users Author
					ON Article.author_id = Author.id
					INNER JOIN provinces as Province
					ON Article.province_id = Province.id
					WHERE Article.province_id=$province_id
					AND ArticleCategory.category_id = $category_id
					AND Article.id NOT IN ({$article_id})
					AND Article.n_status = 1
					GROUP BY Article.id
					ORDER BY Article.id DESC LIMIT 0,{$limit};";
		}else{
			$sql = "SELECT * FROM articles Article 
					INNER JOIN article_categories AS ArticleCategory
					ON ArticleCategory.article_id = Article.id
					INNER JOIN categories AS Category
					ON ArticleCategory.category_id = Category.id
					INNER JOIN users Author
					ON Article.author_id = Author.id
					INNER JOIN provinces as Province
					ON Article.province_id = Province.id
					WHERE Article.province_id=$province_id
					AND Article.id NOT IN ({$article_id})
					AND Article.n_status = 1
					GROUP BY Article.id
					ORDER BY Article.id DESC LIMIT 0,{$limit};";
					
		}
		 $rs = $this->query($sql);
		 $n = sizeof($rs);
		
		 for($i=0;$i<$n;$i++){
		 	//$p['MainImg'][0]['filename']
		 	$rs[$i]['MainImage'] = array();
			
		 	$images = $this->query("SELECT filename FROM article_assets Assets WHERE article_id = {$rs[$i]['Article']['id']} AND is_main=1 LIMIT 2");
			if(sizeof($images)>0){
				foreach($images as $img){
					$rs[$i]['MainImg'][] = array('filename'=>$img['Assets']['filename']);
				}
			}
			
		 }
		 return $rs;
	}
	public function getProvinceArticleCounts($province_id,$ajax = true){
		$province_id = intval($province_id);
		$sql = "SELECT category_id,total FROM (SELECT ArticleCategory.category_id,COUNT(ArticleCategory.category_id) AS total 
				FROM articles Article 
				INNER JOIN article_categories ArticleCategory
				ON ArticleCategory.article_id = Article.id 
				WHERE Article.province_id={$province_id} AND ArticleCategory.category_id IN (1,2,3)
				GROUP BY ArticleCategory.category_id) a";
		
		$rs = $this->query($sql);
		$result = array("land"=>0,"water"=>0,"air"=>0);
		if(sizeof($rs)>0){
			foreach($rs as $r){
				if($r['a']['category_id']==1){
					$result['land'] = intval($r['a']['total']);
				}
				if($r['a']['category_id']==2){
					$result['water'] = intval($r['a']['total']);
				}
				if($r['a']['category_id']==3){
					$result['air'] = intval($r['a']['total']);
				}
			}
		}
		if($ajax){
			return json_encode($result);
		}else{
			return $result;
		}
	}
	public function getCategoryCounts(){
		$sql = "SELECT category_id,total FROM (SELECT ArticleCategory.category_id,COUNT(ArticleCategory.category_id) AS total 
				FROM articles Article 
				INNER JOIN article_categories ArticleCategory
				ON ArticleCategory.article_id = Article.id 
				WHERE ArticleCategory.category_id IN (1,2,3) AND Article.province_id <> 0
				GROUP BY ArticleCategory.category_id) a";
		
		$rs = $this->query($sql);
		$result = array("land"=>0,"water"=>0,"air"=>0);
		if(sizeof($rs)>0){
			foreach($rs as $r){
				if($r['a']['category_id']==1){
					$result['land'] = intval($r['a']['total']);
				}
				if($r['a']['category_id']==2){
					$result['water'] = intval($r['a']['total']);
				}
				if($r['a']['category_id']==3){
					$result['air'] = intval($r['a']['total']);
				}
			}
		}
		return ($result);
	}
	// paginate and paginateCount implemented on a behavior.
	function paginate($conditions, $fields=null, $order=null, $limit=1, $page = 1, $recursive = null, $extra = array()) {
		
		$start = ($page-1)*$limit;
		
		//$sql = ""
		if(isset($conditions['province_id'])){
			if(isset($conditions['category_id'])&&$conditions['category_id']>0){
				$sql = "SELECT * FROM articles Article 
						INNER JOIN article_categories AS ArticleCategory
						ON ArticleCategory.article_id = Article.id
						INNER JOIN categories AS Category
						ON ArticleCategory.category_id = Category.id
						WHERE Article.province_id={$conditions['province_id']} 
						AND ArticleCategory.category_id = {$conditions['category_id']} 
						AND Article.n_status=1
						GROUP BY Article.id
						ORDER BY Article.id DESC LIMIT {$start},{$limit};";
			}else{
				$sql = "SELECT * FROM articles Article 
						INNER JOIN article_categories AS ArticleCategory
						ON ArticleCategory.article_id = Article.id
						INNER JOIN categories AS Category
						ON ArticleCategory.category_id = Category.id
						WHERE Article.province_id={$conditions['province_id']}
						AND Article.n_status=1
						AND ArticleCategory.category_id IN (1,2,3)
						GROUP BY Article.id
						ORDER BY Article.id DESC LIMIT {$start},{$limit};";
			}
		}else{
			if(isset($conditions['category_id'])){
				$sql = "SELECT * FROM articles Article 
							INNER JOIN article_categories AS ArticleCategory
							ON ArticleCategory.article_id = Article.id
							INNER JOIN categories AS Category
							ON ArticleCategory.category_id = Category.id
							INNER JOIN users Author
							ON Article.author_id = Author.id
							INNER JOIN provinces as Province
							ON Article.province_id = Province.id
							WHERE Article.n_status=1
							AND Article.province_id <> 0
							AND ArticleCategory.category_id = {$conditions['category_id']}
							GROUP BY Article.id 
							ORDER BY Article.id DESC LIMIT {$start},{$limit};";
			}else{
				$sql = "SELECT * FROM articles Article 
							INNER JOIN article_categories AS ArticleCategory
							ON ArticleCategory.article_id = Article.id
							INNER JOIN categories AS Category
							ON ArticleCategory.category_id = Category.id
							INNER JOIN users Author
							ON Article.author_id = Author.id
							INNER JOIN provinces as Province
							ON Article.province_id = Province.id
							WHERE Article.n_status=1
							AND Article.province_id <> 0
							AND ArticleCategory.category_id IN (1,2,3)
							GROUP BY Article.id 
							ORDER BY Article.id DESC LIMIT {$start},{$limit};";
			}
		}
		 $rs = $this->query($sql);
		 $n = sizeof($rs);
		 for($i=0;$i<$n;$i++){
		 	//$p['MainImg'][0]['filename']
		 	$rs[$i]['MainImage'] = array();
			
		 	$images = $this->query("SELECT filename FROM article_assets Assets WHERE article_id = {$rs[$i]['Article']['id']} AND is_main=1 LIMIT 2");
			if(sizeof($images)>0){
				foreach($images as $img){
					$rs[$i]['MainImg'][] = array('filename'=>$img['Assets']['filename']);
				}
			}
			
		 }
		
		 return $rs;
	}
	
	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		if(isset($conditions['province_id'])){	
			if(isset($conditions['category_id'])&&$conditions['category_id']>0){
			  $sql = "SELECT COUNT(id) as total FROM 
			  		(SELECT Article.id FROM articles Article 
					 INNER JOIN article_categories AS ArticleCategory
					 ON ArticleCategory.article_id = Article.id
					 INNER JOIN categories AS Category
					 ON ArticleCategory.category_id = Category.id
					 WHERE Article.province_id={$conditions['province_id']} 
					 AND ArticleCategory.category_id = {$conditions['category_id']} 
					 AND Article.n_status=1
					 GROUP BY Article.id) a;";
			}else{

				$sql = "SELECT COUNT(id) AS total FROM (SELECT Article.id
					FROM articles Article 
					INNER JOIN article_categories AS ArticleCategory ON ArticleCategory.article_id = Article.id 
					INNER JOIN categories AS Category ON ArticleCategory.category_id = Category.id 
					WHERE Article.province_id={$conditions['province_id']}
					AND ArticleCategory.category_id IN (1,2,3)
					AND Article.n_status=1
					GROUP BY Article.id) a;";
			}
		}else{
			if(isset($conditions['category_id'])){
				$sql = "SELECT COUNT(id) as total FROM (SELECT Article.id FROM articles Article 
						 INNER JOIN article_categories AS ArticleCategory
						 ON ArticleCategory.article_id = Article.id
						 INNER JOIN categories AS Category
						 ON ArticleCategory.category_id = Category.id
						 WHERE Article.n_status=1
						 AND ArticleCategory.category_id = {$conditions['category_id']}
						 AND Article.province_id <> 0
						 GROUP BY Article.id) a";
			}else{
				$sql = "SELECT COUNT(id) as total FROM (SELECT Article.id FROM articles Article 
						 INNER JOIN article_categories AS ArticleCategory
						 ON ArticleCategory.article_id = Article.id
						 INNER JOIN categories AS Category
						 ON ArticleCategory.category_id = Category.id
						 WHERE Article.n_status=1
						 AND Article.province_id <> 0
						 GROUP BY Article.id) a";
			}
		}
		$q = $this->query($sql);
		return intval($q[0][0]['total']);
		  	
	}
 }
?>