<?php
/**
 * a component for displaying banner image on a 'widget'
 */
class DestinationWidgetComponent extends Component{
	public function getLatest($model,$image,$limit=3){
		$rs = $model->query("SELECT * FROM articles Article 
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
						GROUP BY Article.id 
						ORDER BY Article.id DESC LIMIT 0,{$limit};");
		$n = sizeof($rs);
		 for($i=0;$i<$n;$i++){
		 	//$p['MainImg'][0]['filename']
		 	$rs[$i]['MainImage'] = array();
		 	$images = $model->query("SELECT filename FROM article_assets Assets 
		 							WHERE article_id = {$rs[$i]['Article']['id']} 
		 							AND is_main=1 LIMIT 2");
			if(sizeof($images)>0){
				foreach($images as $img){
					$rs[$i]['MainImg'][] = array('filename'=>$img['Assets']['filename']);
				}
			}
			//get rates
			$rates = $model->query("SELECT * FROM article_rates 
									WHERE article_id = {$rs[$i]['Article']['id']} 
									LIMIT 1");
			$ratings = 0;
			if(isset($rates[0][0]['total_point'])){
				$ratings = floor($rates[0][0]['total_point']/$rates[0][0]['total_hits']);
			}
			$rs[$i]['ratings'] = $ratings;
			$rs[$i]['permalink'] = '/articles/trip/'.$rs[$i]['Province']['name_str'].
									'/'.$rs[$i]['Category']['name_str'].'/view/'.
									$rs[$i]['Article']['id'];
		 }
		return $rs;
	}
}
?>