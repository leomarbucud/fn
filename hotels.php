<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.upload.php';
require_once 'class/class.email.php';


include_once 'include/include.header.php';

$action = httpGet('action');

if($action == 'add') {
	include_once 'include/include.admin.add.hotel.php';
} elseif($action == 'save') {
	require_once 'action/action.add.hotel.php';
	include_once 'include/include.admin.hotels.php';
} elseif($action == 'edit') {
	include_once 'include/include.admin.edit.hotel.php';
} elseif($action == 'update') {
	require_once 'action/action.update.hotel.php';
	include_once 'include/include.admin.edit.hotel.php';
} else {
	include_once 'include/include.admin.hotels.php';
}

include_once 'include/include.footer.php';