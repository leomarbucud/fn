<?php

function update() {

	$db = new DB;

	$airport_id = httpPost('airport_id');
	$airport_name = httpPost('airport_name');
	$airport_location = httpPost('airport_location');

    $sql =  "UPDATE ";
    $sql .=  "`airports` ";
	$sql .= "SET ";
	$sql .= "`airport_name` = :airport_name, ";
	$sql .= "`airport_location` = :airport_location ";
	$sql .= "WHERE `airport_id` = :airport_id";
	

	return $db->query($sql, array("airport_id" => $airport_id,
						"airport_name" => $airport_name,
						"airport_location" => $airport_location
						));

}

if(httpGet('action') == 'update' && httpPost('airport_id') != null) {
	if(update()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/airports.php");
}