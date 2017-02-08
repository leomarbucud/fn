<?php

$s = new Session;

function updateUser($info) {

    $db = new DB;
    $sql =  "UPDATE `user_details` ";
    $sql .= "SET ";
    $sql .= "`firstname` = :firstname, "; 
    $sql .= "`lastname` = :lastname, "; 
    $sql .= "`birthdate` = :birthdate, ";
    $sql .= "`address` = :address, ";
    $sql .= "`gender` = :gender, ";
    $sql .= "`contact` = :contact, ";
    $sql .= "`bio` = :bio ";
    $sql .= "WHERE `user_id` = :user_id";

    return $db->query($sql, $info);
}

function updateLogin($userId, $email, $username, $active) {
    $s = new Session;
    $db = new DB;
    $sql =  "UPDATE `users` ";
    $sql .= "SET ";
    $sql .= "`email` = :email, "; 
    $sql .= "`username` = :username, ";
    $sql .= "`active` = :active ";
    $sql .= "WHERE `id` = :user_id";

    return $db->query($sql, array("email" => $email, "username" => $username, "user_id" => $userId, "active" => $active));
}

function updateSecurity($userId, $password) {
    $db = new DB;
    return $db->query("UPDATE `users` SET 
                    `password` = :password
                WHERE `id` = :id", array("id" => $userId, "password" => $password));
}
function deleteUser($userId) {

    $db = new DB;
    $sql1 =  "DELETE FROM `user_details` ";
    $sql1 .= "WHERE `user_id` = :user_id";

    $sql2 =  "DELETE FROM `users` ";
    $sql2 .= "WHERE `id` = :user_id";

    return $db->query($sql1, array("user_id" => $userId)) && $db->query($sql2, array("user_id" => $userId));
}

function save($username,$email,$hash_password,$hash,$info) {
    $db = new DB;

    $sql =  "INSERT INTO `users` ";
    $sql .= "(`username`, `password`,`email`,`hash`,`created`) ";
    $sql .= "VALUES(:username, :password, :email, :hash, now())";

    $register =  $db->query($sql,
        Array("username" => $username, "password" => $hash_password, "email" => $email,"hash" => $hash));
    $user_id = $db->lastInsertId();

    $sql =  "INSERT INTO `user_details` ";
    $sql .= "(`user_id`, `lastname`, `firstname`, `birthdate`, `address`, `gender`, `bio`) ";
    $sql .= "VALUES (:userid, :lastname, :firstname, :birthdate, :address, :gender, :bio)";
    $info['userid'] = $user_id;
    $db->query($sql, $info);

    return $register;
}

function userExist($identification) {
    $db = new DB;
    return $db->single("SELECT COUNT(1) FROM `users` WHERE `username` = :u OR `email` = :e", Array("u"=>$identification, "e" => $identification)) == "0" ? false : true;
}

$action = httpGet('action');
$type = httpGet('type');

if($action == 'update' && $type == 'user' && $_POST) {

    $info = array(
        "firstname" => httpPost('firstname'),
        "lastname" => httpPost('lastname'),
        "birthdate" => httpPost('birthdate'),
        "address" => httpPost('address'),
        "gender" => httpPost('gender'),
        "bio" => httpPost('bio'),
        "contact" => httpPost('contact'),
        "user_id" => httpPost('user_id')
    );

    if(httpPost('active')) {
        $active = "1";
    } else {
        $active = "0";
    }

    updateUser($info);
    updateLogin(httpPost('user_id'), httpPost('email'), httpPost('username'), $active);
    if(httpPost('password') != '') {
        $password = httpPost('password');
        $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);
        updateSecurity(httpPost('user_id'), $hash_password);
    }
    $save = true;
} elseif($action == 'delete' && $type == 'user' && httpGet('confirm') == 'yes' ) {
    deleteUser(httpGet('id'));
    $delete = true;
} elseif($action == 'save' && $type == 'user' && $_POST) {
    
    $info = array(
        "firstname" => httpPost('firstname'),
        "lastname" => httpPost('lastname'),
        "birthdate" => httpPost('birthdate'),
        "address" => httpPost('address'),
        "gender" => httpPost('gender'),
        "bio" => httpPost('bio')
    );

    if(httpPost('active')) {
        $active = "1";
    } else {
        $active = "0";
    }

    $username = httpPost('username');
    $email = httpPost('email');
    $password = httpPost('password');
    $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);

    if(userExist($username)) {
        header("location: ".$config['url']['base_path']."/register.php?error=register&username={$login}&email={$email}");
    } else {
        $hash = md5( rand(0,1000) );
        $register = save($username,$email,$hash_password,$hash, $info);
        if($register) {
            //sendVerificationMail($username, $email, $hash);
            //header("location: ".$config['url']['base_path']."/login.php?action=jr&username={$login}");
        } else {
            //header("location: ".$config['url']['base_path']."/register.php?error=register&username={$login}&email={$email}");
        }
    }
}
// } elseif ($action == 'update' && $type == 'security' && $_POST) {
//     $password_c = httpPost('password_c');
//     $password = httpPost('password');

//     $hash_password = password_hash($password. $config['var']['hash_password'], PASSWORD_DEFAULT);

//     $info = Array(
//         "password" => $hash_password,
//         "id" => $s->_get('id')
//     );

//     if (password_verify($password_c. $config['var']['hash_password'], $s->_get('password'))) {
//         $updateSecurity = updateSecurity($info);
//         if($updateSecurity){
//             $save = true;
//             updateSession();
//         } else {
//             $error = true;
//         }
//     } else {
//         $error = true;
//     }
// }