<?php

function register($username,$email,$hash_password,$hash) {
    $db = new DB;

    $sql =  "INSERT INTO `users` ";
    $sql .= "(`username`, `password`,`email`,`hash`) ";
    $sql .= "VALUES(:username, :password, :email, :hash)";

    $register =  $db->query($sql,
        Array("username" => $username, "password" => $hash_password, "email" => $email,"hash" => $hash));
    $user_id = $db->lastInsertId();

    $sql =  "INSERT INTO `user_details` ";
    $sql .= "(`user_id`) VALUES (:userid)";
    $db->query($sql, Array("userid"=>$user_id));

    return $register;
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

    $username = httpPost('username');
    $email = httpPost('email');
    $password = httpPost('password');
    $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);

    if(userExist($username)) {
        header("location: ".$config['url']['base_path']."/register.php?error=register&username={$login}&email={$email}");
    } else {
        $hash = md5( rand(0,1000) );
        $register = register($username,$email,$hash_password,$hash);
        if($register) {
            sendVerificationMail($username, $email, $hash);
            header("location: ".$config['url']['base_path']."/login.php?action=jr&username={$login}");
        } else {
            header("location: ".$config['url']['base_path']."/register.php?error=register&username={$login}&email={$email}");
        }
    }

}