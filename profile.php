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

$action = httpGet('action');

if($action == 'edit' || $action == 'update') {
    switch (httpGet('type')) {
        case 'info':
            require_once 'action/action.update.profile.php';
            include_once 'include/include.edit.profile.php';
            break;
        case 'security':
            require_once 'action/action.update.profile.php';
            include_once 'include/include.edit.security.php';
            break;
        default:
            
            break;
    }
} else {
    include_once 'include/include.profile.php';
}

include_once 'include/include.footer.php';