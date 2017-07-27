<?php
/**
 * a component for user point
 */
class PointComponent extends Component{
	public function addPoint($fb_id,$activityIndex,$ref_id,$point,$history){
		if($fb_id>0){
			$config = Configure::read('UserPoint.points');
			$activity = $config[$activityIndex];
			$data = array(
				'fb_id'=>$fb_id,
				'activity_id'=>$activity['activity_id'],
				'activity_name'=>$activity['activity_name'],
				'score'=>$activity['point'],
				'ref_id'=>$ref_id,
				'submit_date'=>date("Y-m-d H:i:s")
			);
			try{
			$history->query("INSERT IGNORE INTO `djarum`.`user_point_histories` (`activity`, `activity_id`, `score`, `fb_id`, `ref_id`, `submit_date`) 
							VALUES ('{$activity['activity_name']}', {$activity['activity_id']}, {$activity['point']}, 
									{$fb_id}, '{$ref_id}', NOW())");
			}catch(Exception $e){}
			//$history->create($data);
			//$history->save();
			
			$scores = $history->find('all',array('alias'=>'History','conditions'=>array('fb_id'=>$fb_id),
												'fields'=>array('sum(UserPointHistory.score) AS total'))
									);
									
			//CHECK FOR TODAY'S SCORE USER MY ONLY HAVE MAXIMUM OF 30 POINTS PER DAY
			
			$today = $history->find('all',array('alias'=>'History','conditions'=>array('fb_id'=>$fb_id,
												'DATE(submit_date)=DATE(NOW())'),
												'fields'=>array('sum(UserPointHistory.score) AS total'))
									);
			
			if($today[0][0]['total']<30){
				
				$point->query("INSERT INTO user_points(fb_id,score)
							   VALUES({$fb_id},{$scores[0][0]['total']})
							   ON DUPLICATE KEY UPDATE
							   score = VALUES(score);");
			}
		}
	}
	function getPoint($fb_id,$point){
		$info = $point->findByFb_id($fb_id);
		$score = $info['UserPoint']['score'];
		return $score;
	}
}
?>