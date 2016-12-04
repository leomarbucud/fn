<?php

function inquire($name, $email, $contact, $from, $to, $note, $type) {
    $db = new DB;

    $sql =  "INSERT INTO `inquiries` ";
    $sql .= "(`name`,`email`,`contact`,`place_from`,`place_togo`,`additional_note`,`type`) ";
    $sql .= "VALUES(:name, :email, :contact, :from, :to, :note, :type)";

    $inquire =  $db->query($sql,
        Array("name" => $name, "email" => $email, "contact" => $contact, "from" => $from, "to" => $to, "note" => $note, "type" => $type));
    $user_id = $db->lastInsertId();

    return $inquire;
}

function userExist($identification) {
    $db = new DB;
    return $db->single("SELECT COUNT(1) FROM `users` WHERE `username` = :u OR `email` = :e", Array("u"=>$identification, "e" => $identification)) == "0" ? false : true;
}

function sendVerificationMail($username, $email, $hash) {

    global $config;

    $_email = new Email();

    $mail = $_email->mailer; // create a new object

    $mail->SetFrom("noreply@footnote.com");
    $mail->Subject = "Verify Email";

    $body = "Thanks for signing up!<br>";
    $body .= "Your account has been created, you can login after you have activated your account by clicking the url below.<br/>";
    $body .= "Please click this link to activate your account: <a href='{$config['url']['site']}/{$config['url']['base_path']}/verify.php?email={$email}&hash={$hash}'>activate account</a>";
    $mail->Body = $body;
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        $msg =  "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $msg =  "Message has been sent";
    }

    return $msg;
}

if ( !empty($_POST) ) {

    $name = httpPost('name');
    $email = httpPost('email');
    $contact = httpPost('contact');
    $from = httpPost('from');
    $to = httpPost('to');
    $note = httpPost('note');
    $type = httpPost('type');

    $inquire = inquire($name, $email, $contact, $from, $to, $note, $type);

}