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
	include_once 'include/include.admin.add.flight.schedule.php';
} elseif($action == 'save') {
	require_once 'action/action.add.flight.schedule.php';
	include_once 'include/include.admin.flight.schedules.php';
} elseif($action == 'send_email') {
	require_once 'action/action.response.inquiry.php';
	include_once 'include/include.admin.inquiries.php';
} else {
	include_once 'include/include.admin.flight.schedules.php';
}

include_once 'include/include.footer.php';