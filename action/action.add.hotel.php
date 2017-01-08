<?php

function save() {

	$db = new DB;

	$hotel_name = httpPost('hotel_name');
	$hotel_details = httpPost('hotel_details');
	

    $sql =  "INSERT INTO ";
    $sql .=  "`hotels` ";
	$sql .= "(";
	$sql .= "`hotel_name`, ";
	$sql .= "`hotel_details`, ";
	$sql .= "`date_created` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":hotel_name, ";
	$sql .= ":hotel_details, ";
	$sql .= "now() ";
	$sql .= ")";

	return $db->query($sql, array("hotel_name" => $hotel_name,
						"hotel_details" => $hotel_details
						));

}

if(httpGet('action') == 'save') {
	if(save()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/hotels.php");
}