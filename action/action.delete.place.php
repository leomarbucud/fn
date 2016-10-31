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

    $place_id = httpPost('place_id');

	$sql =  "DELETE FROM `places` ";
	$sql .= "WHERE ";
	$sql .= "`place_id` = :place_id";

	return $db->query($sql, array("place_id" => $place_id));

}


if(httpPost('action') == 'delete' && $_POST && $s->_get('level') > 0) {

	if(delete()) {
		$return['status'] = 'success';
	} else {
		$return['status'] = 'failed';
	}
	echo json_encode($return);

}