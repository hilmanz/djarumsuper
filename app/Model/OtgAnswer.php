<?php
/**
 * a model for On the go component
 */
 class OtgAnswer extends AppModel{
 	public $name = 'OtgAnswers';
	public $paginate = array(
					    'findType'=>'OtgAnswers'
						);
	// paginate and paginateCount implemented on a behavior.
	function paginate($conditions, $fields=null, $order=null, $limit=1, $page = 1, $recursive = null, $extra = array()) {
		$location = 0;
		$start = ($page-1)*$limit;
		if(isset($conditions)){
			$cond = "";
		}
	   	if(isset($conditions['location'])){
	   		$conditions['location'] = Sanitize::clean($conditions['location']);
	   		$cond.= "location = '{$conditions['location']}' ";
			$location = 1;
	   	}
		if(isset($conditions['MONTH(Otg.when)'])&&intval($conditions['MONTH(Otg.when)'])>0){
			$conditions['MONTH(Otg.when)'] = Sanitize::clean($conditions['MONTH(Otg.when)']);

			if($location==1){
				$cond.= "AND MONTH(Otg.when) = '{$conditions['MONTH(Otg.when)']}' ";
	   		}else{
	   			$cond.= "MONTH(Otg.when) = '{$conditions['MONTH(Otg.when)']}' ";
	   		}
		}
		if(strlen($cond)>0){
			$cond = "WHERE ".$cond;
		}
		$sql = "SELECT Otg.*,b.post_id,COUNT(b.id) AS total
				FROM otgs Otg LEFT JOIN 
				otg_answers b ON Otg.id = b.post_id
				{$cond}
				GROUP BY b.post_id
				ORDER BY total DESC LIMIT {$start},{$limit}";
		
		 return $this->query($sql);
	}
	function getTopEvents($total = 2){
		$sql = "SELECT Otg.*,b.post_id,COUNT(b.id) AS total
				FROM otgs Otg LEFT JOIN 
				otg_answers b ON Otg.id = b.post_id
				WHERE Otg.n_status = 1
				GROUP BY b.post_id
				ORDER BY total DESC LIMIT {$total}";
		$rs = $this->query($sql);

		if(is_array($rs)){
			foreach($rs as $n=>$v){
				$rs[$n]['total_reply'] = $rs[$n][0]['total'];
				$user = $this->query("SELECT * FROM logins AS Users 
													WHERE id={$rs[$n]['Otg']['user_id']} LIMIT 1");
				$rs[$n]['Users'] = $user[0]['Users'];
			}
		}
		return $rs;
	}
	function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
	     $sql = "SELECT COUNT(id) AS total FROM (SELECT a.*,b.post_id,COUNT(b.id) AS total
				 FROM otgs a LEFT JOIN 
				 otg_answers b ON a.id = b.post_id
				 GROUP BY b.post_id) c ;";
		  $q = $this->query($sql);
		  return ($q[0][0]['total']);
		  	
	}
	function getRecentPost($total = 3){
		$sql = "SELECT Otg.*
				FROM otgs Otg 
				ORDER BY Otg.id DESC LIMIT {$total}";
				
		 return $this->query($sql);
	}
 }
?>