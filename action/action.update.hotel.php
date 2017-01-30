<?php

function update() {

	$db = new DB;

	$hotel_id = httpPost('hotel_id');
	$hotel_name = httpPost('hotel_name');
	$hotel_details = httpPost('hotel_details');
	$hotel_link = httpPost('hotel_link');

    $sql =  "UPDATE ";
    $sql .=  "`hotels` ";
	$sql .= "SET ";
	$sql .= "`hotel_name` = :hotel_name, ";
	$sql .= "`hotel_details` = :hotel_details, ";
	$sql .= "`hotel_link` = :hotel_link ";
	$sql .= "WHERE `hotel_id` = :hotel_id";
	

	return $db->query($sql, array("hotel_id" => $hotel_id,
						"hotel_name" => $hotel_name,
						"hotel_details" => $hotel_details,
						"hotel_link" => $hotel_link
						));

}

if(httpGet('action') == 'update' && httpPost('hotel_id') != null) {
	if(update()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/hotels.php");
}