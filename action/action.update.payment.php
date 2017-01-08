<?php

$db = new DB;
$s = new Session;

$status = httpPost('status');
$booking_id = httpPost('booking_id');
$payment_id = httpGet('payment_id');

$sql =  "UPDATE `payments` ";
$sql .= "SET ";
$sql .= "`payment_status` = 1 ";
$sql .= "WHERE ";
$sql .= "`payment_id` = :payment_id ";

$update = $db->query($sql, array(
		"payment_id" => $payment_id
	));