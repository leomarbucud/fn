<?php

function save() {

	global $db;

	$name = httpPost('name');
    $desc = httpPost('description');


	$sql =  "INSERT INTO `galleries` ";
	$sql .= "(`gallery_name`, `gallery_description`)";
	$sql .= "VALUES ";
	$sql .= "(:name, :desc) ";

	$db->query($sql, array("name" => $name, "desc" => $desc));

}

if(httpPost('action') == 'save' ) {
    save();
}