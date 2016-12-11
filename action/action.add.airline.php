<?php

function save() {

	$db = new DB;

	$airline_name = httpPost('airline_name');
	$airline_details = httpPost('airline_details');
	

    $sql =  "INSERT INTO ";
    $sql .=  "`airlines` ";
	$sql .= "(";
	$sql .= "`airline_name`, ";
	$sql .= "`airline_details` ";
	$sql .= ")";
	$sql .= "VALUES ";
	$sql .= "(";
	$sql .= ":airline_name, ";
	$sql .= ":airline_details ";
	$sql .= ")";

	return $db->query($sql, array("airline_name" => $airline_name,
						"airline_details" => $airline_details
						));

}

if(httpGet('action') == 'save') {
	if(save()){
		$save = true;
	}
} else {
	header("location: {$config['url']['base_path']}/airlines.php");
}