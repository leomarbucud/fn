<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';


header('Content-Type: application/json');

function cancel() {

	$db = new DB;
	$s = new Session;

	$status_code = httpPost('status_code');
	$booking_id = httpPost('booking_id');
	$user_id = $s->_get('id');

	$sql =  "UPDATE `bookings` ";
	$sql .= "SET ";
	$sql .= "`status_code` = :status_code ";
	$sql .= "WHERE ";
	$sql .= "`booking_id` = :booking_id ";
	$sql .= "AND ";
	$sql .= "`user_id` = :user_id";

	$cancel = $db->query($sql, array(
			"status_code" => $status_code,
			"booking_id" => $booking_id,
			"user_id" => $user_id
		));
	if($cancel) {
		return true;
	} else {
		return false;
	}

}

if(httpPost('action') == 'cancel' ) {

	if(cancel()) {
		$return['status'] = 'success';
	} else {
		$return['status'] = 'failed';
	}

	echo json_encode($return);

}