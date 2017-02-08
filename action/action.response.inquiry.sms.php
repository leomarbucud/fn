<?php

function updateStatus($inquiry_id) {
    $db = new DB();
    return $db->query("UPDATE `inquiries` SET `status` = 'Responded' WHERE `inquiry_id` = :inquiry_id", Array("inquiry_id" => $inquiry_id));
}

function sendSMS($contact, $message) {
	global $config;

    $sms = new SMS;

    $sms->from = '+12168209293';
    $sms->to = $contact;
    $sms->message = $message;
    

    if (!$sms->send()) {
        return false;
    } else {
        return true;
    }

}

$inquiry_id = httpPost('id');

if($inquiry_id) {

	$contact = httpPost('contact');
	$message = httpPost('message');

    $send = sendSMS($contact, $message);

    if($send) {
        updateStatus($inquiry_id);
        $sms_sent = true;
    } else {
        $error_sms = true;
    }

} else {
    header("location: {$config['url']['base_path']}/inquiries.php");
}
