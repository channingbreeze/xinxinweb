<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else {
	$userid = $_SESSION['user']['userid'];
	$websiteService = new WebsiteService();
	$arr = $websiteService->getMyWebsiteByUserid($userid);
	echo json_encode($arr);
}

?>
