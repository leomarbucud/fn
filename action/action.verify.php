<?php

function verify($email, $hash) {
    $db = new DB();
    return $db->single("SELECT COUNT(1) FROM `users` WHERE `email` = :e AND `hash` = :h AND `active` = 0", Array("e"=>$email, "h" => $hash)) == "0" ? false : true;

}

function activate($email, $hash) {
    $db = new DB();
    return $db->query("UPDATE `users` SET `active` = 1 WHERE `email` = :e AND `hash` = :h AND `active` = 0 ", Array("e"=>$email, "h" => $hash));
}

$email = httpGet('email');
$hash = httpGet('hash');

if($email && $hash) {

    $verify = verify($email,$hash);

    if($verify) {
        activate($email,$hash);
        header("location: ".$config['url']['base_path']."/login.php?action=verified&username={$email}");
    } else {
        header("location: ".$config['url']['base_path']."/login.php?action=av");
    }

} else {
    header("location: ".$config['url']['base_path']);
}
