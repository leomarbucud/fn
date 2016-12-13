<?php

require_once 'config.php';
require_once 'class/class.session.php';

$session = new Session;

setcookie('remember','', time()-3600, $config['url']['base_path']);
session_destroy();

header("location: {$config['url']['base_path']}/");