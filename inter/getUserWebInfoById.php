<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';
require_once dirname ( __FILE__ ) . '/../service/statusService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {

	if(!(isset($_POST['webid']))
		|| empty($_POST['webid'])) {
		echo "false";
	} else {
		$webid = $_POST['webid'];
		$websiteService = new WebsiteService();
		$arr = $websiteService->getMyWebsiteById($webid);
		
		$statusService = new StatusService();
		$statuses = $statusService->getStatusByWebid($webid);
		$arr[0]['statuses'] = $statuses;
		echo json_encode($arr[0]);
		
	}
	
}

?>
