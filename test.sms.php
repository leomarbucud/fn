<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.sms.php';

$sms = new SMS;

$sms->from = '+12168209293';
$sms->to = '+639263751877';
$sms->message = "Hi Leomar Bucud!";
$sms->send();