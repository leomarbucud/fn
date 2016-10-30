<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';

$session = new Session;

if(!$session->_get('id')) {
    //header("location: {$config['url']['base_path']}");
} else {
    // get user details
    if(!$session->_get('user')){
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
        $data = $db->row($sql, Array("id" => $session->_get('id')));

        $session->_set('user', $data);
    }

}

include_once 'include/include.header.php';

include_once 'include/include.home.php';

include_once 'include/include.footer.php';