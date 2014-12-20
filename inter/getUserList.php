<?php

require_once dirname ( __FILE__ ) . '/../service/userService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {
	
	if(!isset($_POST['curPage'])) {
		$curPage = 1;
	} else {
		$curPage = $_POST['curPage'];
	}
	
	$userService = new UserService();
	$res = array();
	$res['totalPage'] = $userService->getUserListPageNum();
	$res['curPage'] = $curPage;
	
	$userList = $userService->getUserByPage($curPage);
	$res['userList'] = $userList;
	
	echo json_encode($res);
	
}

?>
