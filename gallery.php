<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.upload.php';


include_once 'include/include.header.php';

$db = new DB;

if(httpGet('action') == 'save') {
	require_once 'action/action.add.gallery.php';
	include_once 'include/include.admin.gallery.php';
}

if(httpGet('action') == 'add') {
	include_once 'include/include.admin.add.gallery.php';
} elseif(httpGet('action') == 'add_images') {
	include_once 'include/include.admin.add.images.php';
} elseif(httpGet('action') == 'save_images') {
	require_once 'action/action.add.images.php';
	include_once 'include/include.admin.gallery.php';
} elseif(httpGet('action') == 'edit') {
	//require_once 'action/action.edit.gallery.php';
	include_once 'include/include.admin.edit.gallery.php';
} elseif(httpGet('action') == 'update') {
	require_once 'action/action.update.gallery.php';
	include_once 'include/include.admin.gallery.php';
} else {
	include_once 'include/include.admin.gallery.php';
}


include_once 'include/include.footer.php';