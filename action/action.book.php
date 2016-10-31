<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';

if(httpPost('action') == 'book') {

	$db = new DB;
	$s = new Session;

	$user_id = $s->_get('id');
	$package_id = httpPost('package_id');
	$total = str_replace(',','',httpPost('total'));
	$price = httpPost('price');
	$note = httpPost('note');
	$person = httpPost('person');
	$date = httpPost('date');
	$timestamp = strtotime($date);
	$date = date("Y-m-d H:i:s", $timestamp);

	$sql =  "INSERT INTO `bookings` (";
	$sql .= "`package_id`, ";
	$sql .= "`user_id`, ";
	$sql .= "`note`, ";
	$sql .= "`date_of_booking` ";
	$sql .= ") VALUES (";
	$sql .= ":package_id, ";
	$sql .= ":user_id, ";
	$sql .= ":note, ";
	$sql .= ":date_of_booking ";
	$sql .= ")";

	$book = $db->query($sql, array(
			"package_id" => $package_id,
			"user_id" => $user_id,
			"note" => $note,
			"date_of_booking" => $date
		));

	$booking_id = $db->lastInsertId();

	$sql =  "INSERT INTO `payments` (";
	$sql .= "`booking_id`, ";
	$sql .= "`payment_amount`, ";
	$sql .= "`payment_quantity`, ";
	$sql .= "`payment_total` ";
	$sql .= ") VALUES (";
	$sql .= ":booking_id, ";
	$sql .= ":payment_amount, ";
	$sql .= ":payment_quantity, ";
	$sql .= ":payment_total ";
	$sql .= ")";

	$payment = $db->query($sql, array(
			"booking_id" => $booking_id,
			"payment_amount" => $price,
			"payment_quantity" => $person,
			"payment_total" => $total
		));

	if($book && $payment) {
		$return['status'] = 'success';
		$return['message'] = 'Transactional successfully process!';
	} else {
		$return['status'] = 'failed';
		$return['message'] = 'An error occurred';
	}
	header('Content-Type: application/json');
	echo json_encode($return);
}