<?php

require_once dirname ( __FILE__ ) . '/../tools/SQLHelper.class.php';

class UserService {
	
	private $userPerPage = 10;
	
	// 用户登录验证
	public function login($username, $password) {
		
		$sql = "select * from xxw_user where username='" . $username . "'";
		
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dql_array($sql);
		if(count($res) == 0) {
			return false;
		}
		if(md5($password) == $res[0]['passwd']) {
				
			$arr = array();
			$arr['username'] = $res[0]['username'];
			$arr['userid'] = $res[0]['id'];
			$arr['is_admin'] = $res[0]['is_admin'];
			
			// 存Session
			session_start();
				
			$_SESSION['user'] = $arr;
				
			return true;
				
		} else {
			return false;
		}
		
	}
	
	// 用户注册
	public function register($username, $password) {
		
		$sql = "insert into xxw_user (username, passwd) values ('" . $username . "', md5('" . $password . "'))";
		
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		
		if($res == 1) {
			
			$arr = array();
			$arr['username'] = $username;
			$arr['userid'] = $sqlHelper->getLastInsertedId();
			
			// 存Session
			session_start();
			
			$_SESSION['user'] = $arr;
		
			return true;
			
		} else {
			return false;
		}
	}
	
	// 是否需要补充用户信息
	public function needMoreInfo($userid) {
		
		$sql = "select * from xxw_user where id=" . $userid;
		
		$sqlHelper = new SQLHelper();
		$arr = $sqlHelper->execute_dql_array($sql);
		
		if( !isset($arr) || count($arr) == 0 ) {
			return false;
		} else {
			if(isset($arr[0]['truename'])
				&& !empty($arr[0]['truename'])) {
				return false;
			} else {
				return true;
			}
		}
		
	}
	
	// 补充用户信息
	public function submitMoreInfo($userid, $truename, $gender, $mobile, $qq) {
		
		$sql = "update xxw_user set truename='" . $truename . "',gender=" . $gender . ",mobile='" . $mobile . "',qq='" . $qq . "' where id='" . $userid . "'";
		
		$sqlHelper = new SQLHelper();
		$res = $sqlHelper->execute_dqm($sql);
		if($res == 1) {
			return true;
		} else {
			return false;
		}
		
	}
	
	// 获取用户Page数
	public function getUserListPageNum() {
		
		$sql = "select count(id) as count from xxw_user";
		$sqlHelper = new SQLHelper();
		
		$arr = $sqlHelper->execute_dql_array($sql);

		$totalUserCount = $arr[0]['count'];
		if($totalUserCount % $this->userPerPage) {
			$totalPage = $totalUserCount / $this->userPerPage;
		} else {
			$totalPage = $totalUserCount / $this->userPerPage + 1;
		}
		return $totalPage;
		
	}
	
	// 获取一页用户
	public function getUserByPage($curPage) {
		
		$sql = "select * from xxw_user limit " . ($curPage - 1) * $this->userPerPage . "," . $this->userPerPage;
		$sqlHelper = new SQLHelper();
		
		$res = $sqlHelper->execute_dql_array($sql);
		
		return $res;
		
	}
	
}

?>
