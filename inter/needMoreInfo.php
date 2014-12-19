<?php

require_once dirname ( __FILE__ ) . '/../service/userService.class.php';

if(!(isset($_POST['userid']))
	|| empty($_POST['userid'])) {
	echo "false";
} else {
	$userid = $_POST['userid'];
	$userService = new UserService();
	$res = $userService->needMoreInfo($userid);
	if($res) {
		echo "true";
	}else {
		echo "false";
	}
}

?>
