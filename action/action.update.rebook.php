<?php

$db = new DB;
$s = new Session;

$status = httpPost('status');
$booking_id = httpPost('booking_id');
$rebook_id = httpGet('rebook_id');

$sql =  "UPDATE `rebook` ";
$sql .= "SET ";
$sql .= "`rebook_status` = 1 ";
$sql .= "WHERE ";
$sql .= "`rebook_id` = :rebook_id ";

$update_rebook_payment = $db->query($sql, array(
		"rebook_id" => $rebook_id
	));