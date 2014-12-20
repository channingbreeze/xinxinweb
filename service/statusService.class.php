<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class StatusService {
	
	// 创建一个网站状态
	public function createStatus($websiteId, $demand, $progress) {
		
		$sql = "insert into xxw_status (website_id, progress, status, content) values (" . $websiteId . "," . $progress . ",1,'" . $demand . "')";
		
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return true;
		} else {
			return false;
		}
		
	}
	
	// 根据webid获取其所有的status
	public function getStatusByWebid($webid) {
		
		$sql = "select * from xxw_status where website_id=" . $webid;
		
		$sqlHelper = new SQLHelper();
		
		$arr = $sqlHelper->execute_dql_array($sql);
		return $arr;
		
	}
	
	//更新一个Status
	public function updateStatusById($id, $content) {
		$sql = "update xxw_status set content='" . $content . "' where id=" . $id;
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return true;
		} else {
			return false;
		}
	}
	
}

?>
