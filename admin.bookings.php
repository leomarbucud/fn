<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';

$session = new Session;

if(!$session->_get('id')) {
    header("location: {$config['url']['base_path']}");
}

include_once 'include/include.header.php';

include_once 'include/include.admin.bookings.php';

include_once 'include/include.footer.php';