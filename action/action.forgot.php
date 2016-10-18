<?php

function userExist($identification) {
    $db = new DB;
    return $db->single("SELECT COUNT(1) FROM `users` WHERE `username` = :u OR `email` = :e", Array("u"=>$identification, "e" => $identification)) == "0" ? false : true;
}
function getHash($email) {
    $db = new DB;
    $sql = "SELECT hash FROM users WHERE email = :email";
    
    return $db->single($sql, array("email" => $email));
}

function validHash($email, $hash) {
    $db = new DB;
    $sql = "SELECT COUNT(*) FROM users WHERE email = :email AND hash = :hash";
    
    return $db->single($sql, array("email" => $email, "hash" => $hash)) == "0" ? false : true;
}

function sendMail($email, $hash) {

    global $config;

    $_email = new Email();

    $mail = $_email->mailer; // create a new object

    $mail->SetFrom("noreply@footnote.com");
    $mail->Subject = "Forgot Password";

    $body = "Ignore this message if you did not forget your password<br/>";
    $body .= "PLease click the link below to reset your password<br/>";
    $body .= "<a href='{$config['url']['site']}/{$config['url']['base_path']}/forgot.php?email={$email}&hash={$hash}'>Reset password</a>";

    $mail->Body = $body;
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }

}

function resetPassword($email, $hash, $hash_password) {
    $db = new DB;
    $sql =  "UPDATE `users` ";
    $sql .= "SET ";
    $sql .= "`password` = :password ";
    $sql .= "WHERE ";
    $sql .= "`hash` = :hash ";
    $sql .= "AND `email` = :email";

    return $db->query($sql, array("password" => $hash_password,
                            "hash" => $hash,
                            "email" => $email));

}

if ( !empty($_POST) ) {

    
    $email = httpPost('email');
    

    if(userExist($email)) {
        $hash = getHash($email);
        if(sendMail($email, $hash)) {
            $sent = true;
        }
    } else {
       $userExist = true;
    }

}

$email = httpGet('email');
$hash = httpGet('hash');

if($email && $hash) {
    if(validHash($email,$hash)){
        $validHash = true;
    }
}


$email = httpPost('email');
$hash = httpPost('hash');
$password = httpPost('password');

if($email && $hash && $password) {
    $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);
    $reset = resetPassword($email, $hash, $hash_password);
    if($reset) {
        header("location: ".$config['url']['base_path']."/login.php?action=reset&username={$email}");
    }
}

