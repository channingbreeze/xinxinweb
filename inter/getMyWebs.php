<?php

require_once dirname ( __FILE__ ) . '/../service/websiteService.class.php';

if(!(isset($_POST['userid']))
	|| empty($_POST['userid'])) {
	echo "false";
} else {
	$userid = $_POST['userid'];
	$websiteService = new WebsiteService();
	$arr = $websiteService->getMyWebsiteByUserid($userid);
	echo json_encode($arr);
}

?>
