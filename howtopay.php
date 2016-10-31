<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.upload.php';


include_once 'include/include.header.php';

$action = httpGet('action');

if($action == 'view_details') {
	include_once 'include/include.tour.package.details.php';
} else {
	include_once 'include/include.tour.packages.php';
}

include_once 'include/include.footer.php';