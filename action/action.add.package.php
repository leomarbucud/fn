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

	$sql =  "INSERT INTO `packages` ";
	$sql .= "(`place_id`, `package_name`, `package_price`, `package_days`, `package_details`, `package_person`, `package_accomodation`, `package_transportation`) ";
	$sql .= "VALUES ";
	$sql .= "(:place_id, :name, :price, :days, :details, :person, :accom, :transpo) ";

	$db->query($sql, array("place_id" => $place,
							"name" => $name,
							"price" => $price,
                            "days" => $days,
							"details" => $details,
                            "person" => $person,
                            "accom" => $accomodation,
                            "transpo" => $transpo
							));

}

if(httpGet('action') == 'save' ) {

	save();

}