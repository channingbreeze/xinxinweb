<?php

require_once dirname ( __FILE__ ) . '/../service/userService.class.php';

	if(!(isset($_POST['truename']) && isset($_POST['gender']) && isset($_POST['mobile']) && isset($_POST['qq']))
		|| empty($_POST['truename'])
		|| empty($_POST['mobile'])
		|| empty($_POST['qq'])) {
		echo "empty";
	} else {
		$truename = $_POST['truename'];
		$gender = $_POST['gender'];
		$mobile = $_POST['mobile'];
		$qq = $_POST['qq'];
		session_start();
		$userid=$_SESSION['user']['userid'];
		$userService = new UserService();
		$res = $userService->submitMoreInfo($userid, $truename, $gender, $mobile, $qq);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	}

?>
