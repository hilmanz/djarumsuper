<?php
/**
 * a model for On the go component
 */
 class OtgAnswers extends AppModel{
 	public $name = 'OtgAnswers';
	public $paginate = array(
					    'findType'=>'OtgAnswers'
						);
	// paginate and paginateCount implemented on a behavior.
	function paginate($conditions, $fields=null, $order=null, $limit=1, $page = 1, $recursive = null, $extra = array()) {
		
		$start = ($page-1)*$limit;
	   
		$sql = "SELECT *
				FROM  
				otg_answers as Reply
				INNER JOIN logins as User
				ON Reply.user_id = User.id
				WHERE Reply.post_id = {$conditions['post_id']}
				ORDER BY Reply.id ASC LIMIT {$start},{$limit}";


		 return $this->query($sql);
	}
	
	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
	     $sql = "SELECT COUNT(id) as total
				FROM  
				otg_answers as Reply
				WHERE post_id = {$conditions['post_id']}
				";
		  $q = $this->query($sql);
		  return ($q[0][0]['total']);
		  	
	}
	function getLastPost($post_id){
		$post_id = intval($post_id);
		$sql = "SELECT *
				FROM  
				otg_answers as Reply
				INNER JOIN logins as User
				ON Reply.user_id = User.id
				WHERE Reply.post_id = {$post_id}
				ORDER BY Reply.id DESC LIMIT 1";
				
		return $this->query($sql);
	}
 }
?>