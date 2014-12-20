<?php

require_once dirname ( __FILE__ ) . '/../service/statusService.class.php';

session_start();
if(!isset($_SESSION['user'])) {
	echo "false";
} else if(!isset($_SESSION['user']['is_admin'])) {
	echo "false";
} else {
	if(isset($_POST['content']) && isset($_POST['status_id']) && isset($_POST['website_id'])) {
		$content = nl2br($_POST['content']);
		$websiteId = $_POST['website_id'];
		$statusId = $_POST['status_id'];
		$statusService = new StatusService();
		$res = $statusService->createStatus($websiteId, $content, $statusId+1);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	} else if(isset($_POST['content']) && isset($_POST['status_id'])) {
		$content = nl2br($_POST['content']);
		$statusId = $_POST['status_id'];
		$statusService = new StatusService();
		$res = $statusService->updateStatusById($statusId, $content);
		if($res) {
			echo "true";
		} else {
			echo "false";
		}
	} else {
		echo "false";
	}
}

?>
