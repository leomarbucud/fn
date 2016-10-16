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