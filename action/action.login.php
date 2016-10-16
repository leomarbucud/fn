<?php

function login($login, $password) {
    global $config;
    $db = new DB;
    $return = Array();

    $cols = $db->row("SELECT * FROM `users` WHERE `username` = :u OR `email` = :e", Array("u" => $login, "e" => $login));

    if(empty($cols)) {
        $return['login'] = false;
    } else {
        $us_id = $cols['id'];
        $us_pass = $cols['password'];

        if(password_verify($password. $config['var']['hash_password'], $us_pass)) {
            $return['login'] = true;
            $return['data'] = $cols;
        } else {
            $return['login'] = false;
        }
    }
    return $return;
}


$login = httpPost('login');
$password = httpPost('password');
$remember = httpPost('remember');

if($login && $password) {
    $result = login($login, $password);

    if($result['login']) {
        if($result['data']['active'] == 0 ) {
            header("location: {$config['url']['base_path']}/login.php?error=nv&username={$login}");
        } else {
            $session = new Session;
            foreach($result['data'] as $key => $value) {
                $session->_set($key, $value);
            }
             if($remember) {
                setcookie('remember', $login, strtotime("now") + (3600 * 24 * 2), $config['url']['base_path']);
            }
            header('location: '.$config['url']['base_path']);
        }
    } else {
        header("location: {$config['url']['base_path']}/login.php?error=login&username={$login}");
    }
}
