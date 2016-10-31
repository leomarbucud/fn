<?php

function update() {

	$db = new DB;

	$name = httpPost('name');
	$place = httpPost('place');
	$details = httpPost('details');
    $price = httpPost('price');
    $person = httpPost('person');
    $accomodation = httpPost('accomodation');
	$transpo = httpPost('transpo');
    $days = httpPost('days');
    $package_id = httpPost('package_id');

	$sql =  "UPDATE `packages` ";
	$sql .= "SET ";
	$sql .= "`place_id` = :place_id, ";
	$sql .= "`package_name` = :name, ";
	$sql .= "`package_price` = :price, ";
	$sql .= "`package_days` = :days, ";
	$sql .= "`package_details` = :details, ";
	$sql .= "`package_person` = :person, ";
	$sql .= "`package_accomodation` = :accom, ";
	$sql .= "`package_transportation` = :transpo ";
	$sql .= "WHERE ";
	$sql .= "`package_id` = :package_id";

	return $db->query($sql, array(
							"place_id" => $place,
							"name" => $name,
							"price" => $price,
                            "days" => $days,
							"details" => $details,
                            "person" => $person,
                            "accom" => $accomodation,
                            "transpo" => $transpo,
                            "package_id" => $package_id
			));

}

if(httpGet('action') == 'update' && $_POST) {

	if(update()) {
		$update = true;
	}

	//var_dump(update());

}