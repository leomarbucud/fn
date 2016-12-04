<?php

function updateStatus($inquiry_id) {
    $db = new DB();
    return $db->query("UPDATE `inquiries` SET `status` = 'Responded' WHERE `inquiry_id` = :inquiry_id", Array("inquiry_id" => $inquiry_id));
}

function sendEmail($email, $subject, $body) {
	global $config;

    $_email = new Email();

    $mail = $_email->mailer; // create a new object

    $mail->SetFrom("noreply@footnote.com");
    $mail->Subject = $subject;

    
    $mail->Body = nl2br($body);
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }

}

$inquiry_id = httpPost('id');

if($inquiry_id) {

	$email = httpPost('email');
	$subject = httpPost('subject');
	$body = httpPost('body');

    $send = sendEmail($email, $subject, $body);

    if($send) {
        updateStatus($inquiry_id);
        $email_sent = true;
    } else {
        $error = true;
    }

} else {
    header("location: {$config['url']['base_path']}/inquiries.php");
}
