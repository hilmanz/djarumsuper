<?php
/**
 * a model for On the go component
 */
 class ForumAnswer extends AppModel{
 	public $name = 'ForumAnswers';
	public $paginate = array(
					    'findType'=>'ForumAnswers'
						);
	// paginate and paginateCount implemented on a behavior.
	function paginate($conditions, $fields=null, $order=null, $limit=1, $page = 1, $recursive = null, $extra = array()) {
		
		$start = ($page-1)*$limit;
	   
		$sql = "SELECT Forum.*,b.post_id,COUNT(b.id) AS total
				FROM Forums Forum LEFT JOIN 
				Forum_answers b ON Forum.id = b.post_id
				GROUP BY b.post_id
				ORDER BY total DESC LIMIT {$start},{$limit}";
				
		 return $this->query($sql);
	}
	
	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
	     $sql = "SELECT COUNT(id) AS total FROM (SELECT a.*,b.post_id,COUNT(b.id) AS total
				 FROM forums a LEFT JOIN 
				 Forum_answers b ON a.id = b.post_id
				 GROUP BY b.post_id) c ;";
		  $q = $this->query($sql);
		  return ($q[0][0]['total']);
		  	
	}
	function getRecentPost($total = 3){
		$sql = "SELECT Forum.*
				FROM forums Forum 
				ORDER BY Forum.id DESC LIMIT {$total}";
				
		 return $this->query($sql);
	}
 }
?>