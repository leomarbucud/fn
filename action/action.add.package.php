<?php

function save() {

	$db = new DB;

	$name = httpPost('name');
	$place = httpPost('place');
	$details = httpPost('details');
    $price = httpPost('price');
    $person = httpPost('person');
    $hotel = httpPost('hotel');
	$transpo = httpPost('transpo');
    $days = httpPost('days');
    $start = date("Y-m-d H:i:s", strtotime(httpPost('package-start')));
    $end = date("Y-m-d H:i:s", strtotime(httpPost('package-end')));
    $from = httpPost('package_from');
    $to = httpPost('package_to');
    $trip = httpPost('package_trip');

	$sql =  "INSERT INTO `packages` ";
	$sql .= "(`place_id`, `package_name`, `package_price`, `package_days`, `package_details`, `package_person`, `package_hotel`, `package_transportation`, `package_start`, `package_end`, `package_from`, `package_to`, `package_trip`, `package_created`) ";
	$sql .= "VALUES ";
	$sql .= "(:place_id, :name, :price, :days, :details, :person, :hotel, :transpo, :start, :end, :from, :to, :trip, now()) ";

	$db->query($sql, array("place_id" => $place,
							"name" => $name,
							"price" => $price,
                            "days" => $days,
							"details" => $details,
                            "person" => $person,
                            "hotel" => $hotel,
                            "transpo" => $transpo,
                            "start" => $start,
                            "end" => $end,
                            "from" => $from,
                            "to" => $to,
                            "trip" => $trip
							));

}

if(httpGet('action') == 'save' ) {

	save();

}