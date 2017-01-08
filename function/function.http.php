<?php

function httpGet($name) {

    if($_GET) {
        if(isset($_GET[$name])) {
            return $_GET[$name];
        } else {
            return null;
        }
    } else {
        return null;
    }

}

function httpPost($name) {

    if($_POST) {
        if(isset($_POST[$name])) {
            return $_POST[$name];
        } else {
            return null;
        }
    } else {
        return null;
    }

}

function timeDiff($firstTime,$lastTime) {
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);
    $day = strtotime("00:00:00");
    $h = strtotime("01");

    if($firstTime <= $lastTime) {
        $timeDiff = $lastTime - $firstTime;   
    } else {
        $timeDiff = $day - ($firstTime + $lastTime);
    }

    return $timeDiff;
}