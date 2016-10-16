<?php

$s = new Session;

function updateProfile($info) {

    $db = new DB;
    $sql =  "UPDATE `user_details` ";
    $sql .= "SET ";
    $sql .= "`firstname` = :firstname, "; 
    $sql .= "`lastname` = :lastname, "; 
    $sql .= "`birthdate` = :birthdate, ";
    $sql .= "`address` = :address, ";
    $sql .= "`gender` = :gender, ";
    $sql .= "`bio` = :bio ";
    $sql .= "WHERE `user_id` = :user_id";

    return $db->query($sql, $info);
}

function updateEmail($userId, $email) {
    $s = new Session;
    $db = new DB;
    $sql =  "UPDATE `users` ";
    $sql .= "SET ";
    $sql .= "`email` = :email "; 
    $sql .= "WHERE `id` = :user_id";

    return $db->query($sql, array("email" => $email, "user_id" => $userId));
}

function updateSession() {
    $s = new Session;
    $db = new DB;
    $sql =  "SELECT ";
    $sql .= "u.username, ";
    $sql .= "u.password, ";
    $sql .= "u.level, ";
    $sql .= "ud.user_id, ";
    $sql .= "ud.lastname, ";
    $sql .= "ud.firstname, ";
    $sql .= "ud.middlename, ";
    $sql .= "ud.address, ";
    $sql .= "ud.birthdate, ";
    $sql .= "ud.gender, ";
    $sql .= "ud.bio, ";
    $sql .= "ud.profile ";
    $sql .= "FROM ";
    $sql .= "`users` as u ";
    $sql .= "INNER JOIN ";
    $sql .= "`user_details` as ud ";
    $sql .= "ON u.id = ud.user_id ";
    $sql .= "WHERE u.id = :id";
    $data = $db->row($sql, Array("id" => $s->_get('id')));
    
	$s->_set('user', $data);
    $s->_set('email', httpPost('email'));
}

function updateSecurity($info) {
    $db = new DB;
    return $db->query("UPDATE `users` SET 
                    `password` = :password
                WHERE `id` = :id", $info);
}

$action = httpGet('action');
$type = httpGet('type');

if($action == 'update' && $type == 'info' && $_POST) {

    $info = array(
        "firstname" => httpPost('firstname'),
        "lastname" => httpPost('lastname'),
        "birthdate" => httpPost('birthdate'),
        "address" => httpPost('address'),
        "gender" => httpPost('gender'),
        "bio" => httpPost('bio'),
        "user_id" => $s->_get('id')
    );

    updateProfile($info);
    updateEmail($s->_get('id'), httpPost('email'));
    updateSession();
    $save = true;
} elseif ($action == 'update' && $type == 'security' && $_POST) {
    $password_c = httpPost('password_c');
    $password = httpPost('password');

    $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);

    $info = Array(
        "password" => $hash_password,
        "id" => $s->_get('id')
    );

    if (password_verify($password_c. $config['var']['hash_password'], $s->_get('password'))) {
        $updateSecurity = updateSecurity($info);
        if($updateSecurity){
            $save = true;
            updateSession();
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}