<?php

require_once dirname ( __FILE__ ) . '/../service/userService.class.php';

	if(!(isset($_POST['username']) && isset($_POST['password']))
		|| empty($_POST['username'])
		|| empty($_POST['password'])) {
		echo "false";
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$userService = new UserService();
		$res = $userService->login($username, $password);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	}

?>
