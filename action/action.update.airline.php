<?php

function update() {

	$db = new DB;

	$airline_id = httpPost('airline_id');
	$airline_name = httpPost('airline_name');
	$airline_details = httpPost('airline_details');

    $sql =  "UPDATE ";
    $sql .=  "`airlines` ";
	$sql .= "SET ";
	$sql .= "`airline_name` = :airline_name, ";
	$sql .= "`airline_details` = :airline_details ";
	$sql .= "WHERE `airline_id` = :airline_id";
	

	return $db->query($sql, array("airline_id" => $airline_id,
						"airline_name" => $airline_name,
						"airline_details" => $airline_details
						));

}

if(httpGet('action') == 'update' && httpPost('airline_id') != null) {
	if(update()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/airlines.php");
}