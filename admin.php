<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';

$session = new Session;

if(!$session->_get('id') || !$session->_get('level') == 1) {
    header("location: {$config['url']['base_path']}");
}

include_once 'include/include.header.php';

$action = httpGet('action');

if($action == 'view' || $action == 'update') {
    switch (httpGet('type')) {
        case 'users':
            require_once 'action/action.admin.update.users.php';
            include_once 'include/include.admin.users.php';
            break;
        case 'user':
            require_once 'action/action.admin.update.users.php';
            include_once 'include/include.admin.view.user.php';
            break;
        default:
            break;
    }
} elseif($action == 'edit') {
     switch (httpGet('type')) {
        case 'user':
            require_once 'action/action.admin.update.users.php';
            include_once 'include/include.admin.edit.user.php';
            break;
        default:
            
            break;
    }
} elseif($action == 'delete') {
     switch (httpGet('type')) {
        case 'user':
            require_once 'action/action.admin.update.users.php';
            include_once 'include/include.admin.delete.user.php';
            break;
        default:
            
            break;
    }
} elseif($action == 'add' || $action == 'save') {
     switch (httpGet('type')) {
        case 'user':
            require_once 'action/action.admin.update.users.php';
            include_once 'include/include.admin.add.user.php';
            break;
        default:
            
            break;
    }
} else {
   include_once 'include/include.admin.users.php';
}

include_once 'include/include.footer.php';