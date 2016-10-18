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

if($action == 'view' || $action == 'update') {
    if(!httpGet('type')) {
        header("location: {$config['url']['base_path']}");
    }
    switch (httpGet('type')) {
        case 'post':
            require_once 'action/action.post.php';
            include_once 'include/include.post.php';
            break;
        default:
            break;
    }
} elseif($action == 'edit') {
    require_once 'action/action.post.php';
    include_once 'include/include.post.edit.php';
} elseif($action == 'delete') {
    require_once 'action/action.post.php';
} else {
    header("location: {$config['url']['base_path']}");
}

include_once 'include/include.footer.php';