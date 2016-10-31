<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';


header('Content-Type: application/json');

function update() {

	$db = new DB;
	$s = new Session;

	$status_code = httpPost('status_code');
	$booking_id = httpPost('booking_id');

	$sql =  "UPDATE `bookings` ";
	$sql .= "SET ";
	$sql .= "`status_code` = :status_code ";
	$sql .= "WHERE ";
	$sql .= "`booking_id` = :booking_id ";

	$update = $db->query($sql, array(
			"status_code" => $status_code,
			"booking_id" => $booking_id,
		));

	if($update) {
		return true;
	} else {
		return false;
	}

}

if(httpPost('action') == 'update' ) {

	if(update()) {
		$return['status'] = 'success';
	} else {
		$return['status'] = 'failed';
	}

	echo json_encode($return);

}