<?php

require_once 'class/class.session.php';

require_once 'function/function.http.php';

$session = new Session;

if($session->_get('id')) {
    include 'home.php';
} else {
    if(httpGet('register')) {
        include 'register.php';
    } else {
        include 'login.php';
    }
}