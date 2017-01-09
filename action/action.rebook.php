<?php

function rebook() {

	global $config;

	$db = new DB;

	$flight_id = httpPost('flight_id');
	$booking_id = httpPost('booking_id');
	$date = httpPost('date');
	

    $sql =  "INSERT INTO ";
    $sql .=  "`rebook` ";
	$sql .= "(";
	$sql .= "`booking_id`, ";
	$sql .= "`flight_id`, ";
	$sql .= "`rebook_amount`, ";
	$sql .= "`rebook_date`, ";
	$sql .= "`date_created` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":booking_id, ";
	$sql .= ":flight_id, ";
	$sql .= ":rebook_amount, ";
	$sql .= ":rebook_date, ";
	$sql .= "now() ";
	$sql .= ")";

	$rebook =  $db->query($sql, array("booking_id" => $booking_id,
						"flight_id" => $flight_id,
						"rebook_amount" => $config['var']['rebook_amount'],
						"rebook_date" => $date
						));

	if($rebook) {
		$status_code = 1;
		
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
	} else {
		return false;
	}

}

if(httpGet('action') == 'rebook') {
	if(rebook()){
		$rebook = true;
		header("location: {$config['url']['base_path']}/bookings.php?rebook=1");
	}
} else {
	header("location: {$config['url']['base_path']}/bookings.php");
}