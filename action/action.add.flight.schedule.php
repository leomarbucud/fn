<?php

function save() {

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

    $sql =  "INSERT INTO ";
    $sql .=  "`flight_schedules` ";
	$sql .= "(";
	$sql .= "`flight_number`, ";
	$sql .= "`flight_from`, ";
	$sql .= "`flight_to`, ";
	$sql .= "`date`, ";
	$sql .= "`depart`, ";
	$sql .= "`arrive`, ";
	$sql .= "`airline` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":flight_number, ";
	$sql .= ":flight_from, ";
	$sql .= ":flight_to, ";
	$sql .= ":date, ";
	$sql .= ":depart, ";
	$sql .= ":arrive, ";
	$sql .= ":airline ";
	$sql .= ")";

	$db->query($sql, array("flight_number" => $flight_number,
						"flight_from" => $flight_from,
						"flight_to" => $flight_to,
                        "date" => $date,
						"depart" => $depart,
                        "arrive" => $arrive,
                        "airline" => $airline
						));

}

if(httpGet('action') == 'save' && httpPost('flight_number') != null) {
	if(save()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/flight.schedules.php");
}