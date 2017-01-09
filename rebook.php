<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.email.php';

include_once 'include/include.header.php';

$action = httpGet('action');

if($action == 'rebook') {
	require_once 'action/action.rebook.php';
}

include_once 'include/include.rebook.form.php';

include_once 'include/include.footer.php';