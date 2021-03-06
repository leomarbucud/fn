<?php

function update() {

	$db = new DB;

	$name = httpPost('name');
	$place = httpPost('place');
	$details = httpPost('details');
    $price = httpPost('price');
    $person = httpPost('person');
    $hotel = httpPost('hotel');
	$transpo = httpPost('transpo');
    $days = httpPost('days');
    $package_id = httpPost('package_id');
    $start = date("Y-m-d H:i:s", strtotime(httpPost('package-start')));
    $end = date("Y-m-d H:i:s", strtotime(httpPost('package-end')));
    $from = httpPost('package_from');
    $to = httpPost('package_to');
    $trip = httpPost('package_trip');

	$sql =  "UPDATE `packages` ";
	$sql .= "SET ";
	$sql .= "`place_id` = :place_id, ";
	$sql .= "`package_name` = :name, ";
	$sql .= "`package_price` = :price, ";
	$sql .= "`package_days` = :days, ";
	$sql .= "`package_details` = :details, ";
	$sql .= "`package_person` = :person, ";
	$sql .= "`package_hotel` = :hotel, ";
	$sql .= "`package_transportation` = :transpo, ";
	$sql .= "`package_start` = :start, ";
	$sql .= "`package_end` = :end, ";
	$sql .= "`package_from` = :from, ";
	$sql .= "`package_to` = :to, ";
	$sql .= "`package_trip` = :trip ";
	$sql .= "WHERE ";
	$sql .= "`package_id` = :package_id";

	return $db->query($sql, array(
							"place_id" => $place,
							"name" => $name,
							"price" => $price,
                            "days" => $days,
							"details" => $details,
                            "person" => $person,
                            "hotel" => $hotel,
                            "transpo" => $transpo,
                            "package_id" => $package_id,
                            "start" => $start,
                            "end" => $end,
                            "from" => $from,
                            "to" => $to,
                            "trip" => $trip
			));

}

if(httpGet('action') == 'update' && $_POST) {

	if(update()) {
		$update = true;
	}

	//var_dump(update());

}