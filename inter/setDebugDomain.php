<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {
	
	if(!isset($_POST['debug_domain']) || !isset($_POST['websiteId'])) {
		echo "false";
	} else {
		$debugDomain = $_POST['debug_domain'];
		$websiteId = $_POST['websiteId'];
		$websiteService = new WebsiteService();
		$res = $websiteService->updateDebugDomain($debugDomain, $websiteId);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	}
	
}

?>
