<?php

function update() {

	$db = new DB;

	$flight_number = httpPost('flight_number');
	$flight_from = httpPost('flight_from');
	$flight_to = httpPost('flight_to');
    $date = httpPost('date');
	$timestamp = strtotime($date);
	$date = date("Y-m-d H:i:s", $timestamp);
    $depart = httpPost('depart');
    $arrive = httpPost('arrive');
	$airline = httpPost('airline');
	$flight_id = httpPost('flight_id');

    $sql =  "UPDATE ";
    $sql .=  "`flight_schedules` ";
	$sql .= "SET ";
	$sql .= "`flight_number` = :flight_number, ";
	$sql .= "`flight_from` = :flight_from, ";
	$sql .= "`flight_to` = :flight_to, ";
	$sql .= "`date` = :date, ";
	$sql .= "`depart` = :depart, ";
	$sql .= "`arrive` = :arrive, ";
	$sql .= "`airline` = :airline ";
	$sql .= "WHERE `flight_id` = :flight_id";
	

	return $db->query($sql, array("flight_number" => $flight_number,
						"flight_from" => $flight_from,
						"flight_to" => $flight_to,
                        "date" => $date,
						"depart" => $depart,
                        "arrive" => $arrive,
                        "airline" => $airline,
                        "flight_id" => $flight_id
						));

}

if(httpGet('action') == 'update' && httpPost('flight_id') != null) {
	if(update()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/flight.schedules.php");
}