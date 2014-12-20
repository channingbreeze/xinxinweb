<?php

require_once dirname ( __FILE__ ) . '/../service/userService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else {
	$userid = $_SESSION['user']['userid'];
	$userService = new UserService();
	$res = $userService->needMoreInfo($userid);
	if($res) {
		echo "true";
	}else {
		echo "false";
	}
}

?>
