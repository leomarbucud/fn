<?php

function save() {

	$db = new DB;

	$airport_name = httpPost('airport_name');
	$airport_location = httpPost('airport_location');
	

    $sql =  "INSERT INTO ";
    $sql .=  "`airports` ";
	$sql .= "(";
	$sql .= "`airport_name`, ";
	$sql .= "`airport_location` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":airport_name, ";
	$sql .= ":airport_location ";
	$sql .= ")";

	return $db->query($sql, array("airport_name" => $airport_name,
						"airport_location" => $airport_location
						));

}

if(httpGet('action') == 'save') {
	if(save()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/airports.php");
}