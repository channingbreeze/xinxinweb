<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {
	$debugDomainPassword = $_POST['debug_domain_password'];
	$websiteId = $_POST['websiteId'];
	$websiteService = new WebsiteService();
	$res = $websiteService->updateDebugDomainPassword($debugDomainPassword, $websiteId);
	if($res) {
		echo "true";
	} else {
		echo "false";
	}
}

?>
