<?php

function save() {

	$db = new DB;

	$name = httpPost('name');
	$place = httpPost('place');
	$details = httpPost('details');
    $price = httpPost('price');
    $person = httpPost('person');
    $accomodation = httpPost('accomodation');
	$transpo = httpPost('transpo');
    $days = httpPost('days');
    $start = date("Y-m-d H:i:s", strtotime(httpPost('package-start')));
    $end = date("Y-m-d H:i:s", strtotime(httpPost('package-end')));
    $from = httpPost('package_from');
    $to = httpPost('package_to');
    $trip = httpPost('package_trip');

	$sql =  "INSERT INTO `packages` ";
	$sql .= "(`place_id`, `package_name`, `package_price`, `package_days`, `package_details`, `package_person`, `package_accomodation`, `package_transportation`, `package_start`, `package_end`, `package_from`, `package_to`, `package_trip`) ";
	$sql .= "VALUES ";
	$sql .= "(:place_id, :name, :price, :days, :details, :person, :accom, :transpo, :start, :end, :from, :to, :trip) ";

	$db->query($sql, array("place_id" => $place,
							"name" => $name,
							"price" => $price,
                            "days" => $days,
							"details" => $details,
                            "person" => $person,
                            "accom" => $accomodation,
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