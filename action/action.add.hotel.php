<?php

function save() {

	$db = new DB;

	$hotel_name = httpPost('hotel_name');
	$hotel_details = httpPost('hotel_details');
	$hotel_link = httpPost('hotel_link');
	

    $sql =  "INSERT INTO ";
    $sql .=  "`hotels` ";
	$sql .= "(";
	$sql .= "`hotel_name`, ";
	$sql .= "`hotel_details`, ";
	$sql .= "`hotel_link`, ";
	$sql .= "`date_created` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":hotel_name, ";
	$sql .= ":hotel_details, ";
	$sql .= ":hotel_link, ";
	$sql .= "now() ";
	$sql .= ")";

	return $db->query($sql, array("hotel_name" => $hotel_name,
						"hotel_details" => $hotel_details,
						"hotel_link" => $hotel_link
						));

}

if(httpGet('action') == 'save') {
	if(save()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/hotels.php");
}