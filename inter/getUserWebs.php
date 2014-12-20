<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {
	
	if(!isset($_POST['userid'])) {
		echo "false";
	} else {
		
		$userid = $_POST['userid'];
		$websiteService = new WebsiteService();
		$arr = $websiteService->getMyWebsiteByUserid($userid);
		echo json_encode($arr);
		
	}
	
}

?>
