<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class WebsiteService {
	
	// 获取一个用户的所有网站
	public function getMyWebsiteByUserid($userid) {
		
		$sql = "select * from xxw_website where user_id=" . $userid;
		
		$sqlHelper = new SQLHelper();
		$arr = $sqlHelper->execute_dql_array($sql);
		return $arr;
		
	}
	
	// 创建一个网站，返回网站id
	public function createWebsite($userid, $websiteName) {
		
		$sql = "insert into xxw_website (user_id, webname) values (" . $userid . ",'" . $websiteName . "')";
		
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return $sqlHelper->getLastInsertedId();
		} else {
			return 0;
		}
		
	}
	
	// 根据webid获取网站信息
	public function getMyWebsiteById($webid) {
		
		$sql = "select * from xxw_website where id=" . $webid;
		
		$sqlHelper = new SQLHelper();
		
		$arr = $sqlHelper->execute_dql_array($sql);
		return $arr;
		
	}
	
	//更新一个网站的域名
	public function updateDebugDomain($debugDomain, $websiteId) {
		$sql = "update xxw_website set debug_domain='" . $debugDomain . "' where id=" . $websiteId;
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	//更新一个网站的密码
	public function updateDebugDomainPassword($debugDomainPassword, $websiteId) {
		$sql = "update xxw_website set debug_domain_password='" . $debugDomainPassword . "' where id=" . $websiteId;
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
