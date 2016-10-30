<?php

require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';


function approve($post_id) {

	$db = new DB;

	$name = httpPost('name');
    $desc = httpPost('description');


	$sql =  "UPDATE `posts` ";
	$sql .= "SET ";
	$sql .= "`isApproved` = 1 ";
	$sql .= "WHERE ";
	$sql .= "`post_id` = :post_id";

	return $db->query($sql, array("post_id" => $post_id));

}

if(httpGet('action') == 'approve' ) {

	var_dump(approve(httpGet('post')));

}