<?php
/**
 * a model for User Point Backend
 */
 class Point extends AppModel{
 	public $useTable = false; //we dont use schema
 	public $name = 'Point';
	public $paginate = array(
					    'Point'
						);
	// paginate and paginateCount implemented on a behavior.
	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
		$start = ($page-1)*$limit;
	    $sql = "SELECT * FROM logins as Login LEFT JOIN user_points as Point
	    		ON Login.fb_id = Point.fb_id ORDER BY {$order} LIMIT {$start},{$limit}";
		 return $this->query($sql);
	}
	
	public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
	     $sql = "SELECT * FROM logins as Login";
		 return count($this->query($sql));	
	}
 }
?>