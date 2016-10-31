<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';

header('Content-Type: application/json');

$s = new Session;

function delete() {

	$db = new DB;

    $gallery_id = httpPost('gallery_id');

	$sql =  "DELETE FROM `galleries` ";
	$sql .= "WHERE ";
	$sql .= "`gallery_id` = :gallery_id";

	return $db->query($sql, array("gallery_id" => $gallery_id));

}


if(httpPost('action') == 'delete' && $s->_get('level') > 0) {

	if(delete()) {
		$return['status'] = 'success';
	} else {
		$return['status'] = 'failed';
	}
	echo json_encode($return);

}