<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.upload.php';


include_once 'include/include.header.php';

if(httpGet('action') == 'save') {
	require_once 'action/action.add.place.php';
	include_once 'include/include.admin.places.php';
} elseif(httpGet('action') == 'update') {
	require_once 'action/action.update.place.php';
	include_once 'include/include.admin.places.php';
}

if(httpGet('action') == 'add') {
	include_once 'include/include.admin.add.place.php';
} elseif (httpGet('action') == 'edit') {
	include_once 'include/include.admin.edit.place.php';
} else {
	include_once 'include/include.admin.places.php';
}


include_once 'include/include.footer.php';