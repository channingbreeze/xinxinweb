<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';
require_once dirname ( __FILE__ ) . '/../service/statusService.class.php';
require_once dirname ( __FILE__ ) . '/../service/mailService.class.php';

if(!(isset($_POST['website_name']) && isset($_POST['demand']))
	|| empty($_POST['website_name'])
	|| empty($_POST['demand'])) {
	echo "empty";
} else {
	$websiteName = $_POST['website_name'];
	$demand = nl2br($_POST['demand']);
	session_start();
	$userid=$_SESSION['user']['userid'];
	$websiteService = new WebsiteService();
	$websiteId = $websiteService->createWebsite($userid, $websiteName);
	if(!$websiteId) {
		echo "false";
	} else {
		$statusService = new StatusService();
		$res = $statusService->createStatus($websiteId, $demand, 1);
		if($res) {
			$mailService = new MailService();
			$mailService->sendToAdminEmail($_SESSION['user']['username']);
			$mailService->sendToUserEmail($_SESSION['user']['username']);
			echo "true";
		} else {
			echo "false";
		}
	}
}

?>
